<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Product;

class AdminProductsController extends Controller
{
    private $products;

    public function __construct(Product $product)
    {
        $this->products = $product;
    }

    public function index()
    {
        $products = $this->products->all();
        return view('product', compact('products'));
    }

    public function create()
    {
        return "Create Product";
    }

    public function show($id)
    {
        return "Show Product " . $id;
    }

    public function update($id)
    {
        return "Update Product " . $id;
    }

    public function destroy($id)
    {
        return "Delete Product " . $id;
    }
}
