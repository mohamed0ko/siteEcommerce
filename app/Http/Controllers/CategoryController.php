<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(6);
        return view('backend.Categories.index', compact('categories'));
    }
    public function create(Request $request)
    {
        return view('backend.Categories.create');
    }
    public function store(CategoriesRequest $request)
    {
        $formFileds = $request->validated();
        Category::create($formFileds);

        return view('backend.Categories.create')->with('success', 'Category create successfully');
    }
    public function edit(Category $category)
    {
        return view('backend.Categories.edit', compact('category'));
    }
    public function update(CategoriesRequest $request, Category $category)
    {
        $forms = $request->validated();
        $category->update($forms);

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category delete successfully');
    }
}
