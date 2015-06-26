<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    private $productModel;

    public function __construct(Product $product)
    {
        $this->productModel = $product;
    }

    public function index()
    {
        $products = $this->productModel->all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Requests\ProductRequest $request)
    {
        $input = $request->all();
        $category = $this->productModel->fill($input);
        $category->save();
        return redirect()->route('products');
    }

    public function edit($id)
    {
        $product = $this->productModel->find($id);
        return view('products.edit', compact('product'));
    }

    public function update(Requests\ProductRequest $request, $id)
    {
        $product = $this->productModel->find($id)->update($request->all());
        return redirect()->route('products');
    }

    public function destroy($id)
    {
        $this->productModel->find($id)->delete();
        return redirect()->route('products');
    }
}
