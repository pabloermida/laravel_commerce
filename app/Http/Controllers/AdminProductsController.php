<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use CodeCommerce\ProductImage;
use CodeCommerce\Tag;
use CodeCommerce\Http\Requests\ProductImageRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AdminProductsController extends Controller
{
    private $productModel;
    private $tagModel;

    public function __construct(Product $product, Tag $tag)
    {
        $this->productModel = $product;
        $this->tagModel = $tag;
    }

    public function index()
    {
        $products = $this->productModel->paginate(100);
        return view('products.index', compact('products'));
    }

    public function create(Category $category)
    {
        $categories = $category->lists('name', 'id');
        return view('products.create', compact('categories'));
    }

    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();
        $product = $this->productModel->fill($input);
        $product->save();

        $tagIds = $this->tagModel->saveTags($request->input('tags'));
        $product->tags()->sync($tagIds);

        return redirect()->route('products');
    }

    public function edit($id, Category $category)
    {
        $categories = $category->lists('name', 'id');
        $product = $this->productModel->find($id);
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $product = $this->productModel->find($id)->update($request->all());
        $tagIds = $this->tagModel->saveTags($request->input('tags'));
        $product = $this->productModel->find($id);
        $product->tags()->sync($tagIds);
        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $this->productModel->find($id)->destroyImages();
        $this->productModel->find($id)->delete();
        return redirect()->route('products');
    }

    public function images($id)
    {
        $product = $this->productModel->find($id);
        return view('products.images', compact('product'));
    }

    public function createImage($id)
    {
        $product = $this->productModel->find($id);
        return view('products.create_image', compact('product'));
    }

    public function storeImage(ProductImageRequest $request, $id, ProductImage $productImage)
    {
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();

        $image = $productImage::create(['product_id'=>$id, 'extension'=>$extension]);

        //Storage::disk('s3')->put($image->id . '.' . $extension, File::get($file));
        Storage::disk('public_local')->put($image->id . '.' . $extension, File::get($file));

        return redirect()->route('products.images', ['id'=>$id]);
    }

    public function destroyImage(ProductImage $productImage, $id)
    {
        $image = $productImage->find($id);
        /*
        if (Storage::disk('s3')->exists($image->id . '.' . $image->extension)) {
            Storage::disk('s3')->delete($image->id . '.' . $image->extension);
        }
        */
        if (file_exists(public_path() . '/uploads/' . $image->id . '.' . $image->extension)) {
            Storage::disk('public_local')->delete($image->id . '.' . $image->extension);
        }

        $product = $image->product;
        $image->delete();

        return redirect()->route('products.images', ['id'=>$product->id]);
    }

}
