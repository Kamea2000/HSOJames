<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Product;

class CategoryController extends Controller
{
    // Display a listing of the resource
    public function index()
{
    // Fetch products with their associated category
    $products = Product::with('category')->get();

    return view('your-view-name', compact('products'));
}
    // Show the form for creating a new category
    public function create()
    {
    // Fetch categories from the database
    $categories = Category::all();

    return Inertia::render('Frontend/Product/Index', [
        'categories' => $categories
    ]);
    }
    // Store a newly created category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Create the category
        Category::create(['name' => $request->name]);

        // Optionally, return a redirect or response
        return redirect()->route('products.index')->with('message', 'Category added successfully!');
    }

    // Show the form for editing the specified category
    public function edit(Category $category)
    {
        return Inertia::render('Categories/Edit', [
            'category' => $category,
        ]);
    }

    // Update the specified category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('flash.message', 'Category updated successfully!');
    }

    // Remove the specified category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('flash.message', 'Category deleted successfully!');
    }
}
