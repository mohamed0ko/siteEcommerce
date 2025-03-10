<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('backend.Product.index', compact('products'));
    }

    public function show(Product $product)
    {


        return view('backend.Product.show', compact('product',));
    }

    public function create()
    {
        $categoties = Category::all();
        $colors = Color::all();



        return view('backend.Product.create', compact('categoties', 'colors'));
    }
    public function store(ProductRequest $request)
    {

        $validatedData = $request->validated();


        $imagePaths = [];
        if ($request->hasFile('imagepath')) {
            foreach ($request->file('imagepath') as $image) {
                $path = $image->store('product', 'public');
                $imagePaths[] = $path;
            }
        }

        // Save image paths as JSON
        $validatedData['imagepath'] = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);
        $validatedData['size'] = json_encode($request->input('size', []));
        $product = Product::create($validatedData);

        if ($request->has('color_id')) {
            $product->colors()->sync($request->input('color_id')); // sync color ids
        }


        return redirect()->back()->with('success', 'Product created successfully with images and sizes.');
    }

    public function edit(Product $product)
    {
        $categoties = Category::all();
        $colors = Color::all();
        return view('backend.Product.edit', compact('product', 'categoties', 'colors'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        // Validate input
        $validatedData = $request->validated();

        // Handle image updates
        $imagePaths = json_decode($product->imagepath, true) ?? [];

        if ($request->hasFile('imagepath')) {
            // Optionally delete old images
            foreach ($imagePaths as $oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
            $imagePaths = [];
            foreach ($request->file('imagepath') as $image) {
                $path = $image->store('product', 'public');
                $imagePaths[] = $path;
            }
        }

        // Update image paths as JSON
        $validatedData['imagepath'] = !empty($imagePaths) ? json_encode($imagePaths) : json_encode([]);

        // Update the product attributes
        $product->update($validatedData);

        // Sync the selected colors
        if ($request->has('color_id')) {
            $product->colors()->sync($request->input('color_id'));
        }

        // Redirect with success message
        return to_route('backend.Product.index')->with('success', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('success', 'Product delete successfully');
    }
}
