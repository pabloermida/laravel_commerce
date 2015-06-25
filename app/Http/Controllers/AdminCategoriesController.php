<?php

namespace CodeCommerce\Http\Controllers;

use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;
use CodeCommerce\Category;

class AdminCategoriesController extends Controller
{
    private $categories;

    public function __construct(Category $category)
    {
        $this->categories = $category;
    }

    public function index()
    {
        $categories = $this->categories->all();
        return view('category', compact('categories'));
    }

    public function create()
    {
        return "Create Category";
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $category = $this->categoryModel->fill($input);
        $category->save();
        return redirect('categories');
    }

    public function show($id)
    {
        return "Show Category " . $id;
    }

    public function update($id)
    {
        return "Update Category " . $id;
    }

    public function destroy($id)
    {
        return "Delete Category " . $id;
    }

}
