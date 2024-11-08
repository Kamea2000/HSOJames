<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Return all categories
        return Inertia::render('Frontend/Product/Index', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'name' => 'required|string|max:255', // Ensure the category name is required and a string
        ]);

        // Create and store the new category in the database
        $category = Category::create([
            'name' => $validated['name'], // Insert the validated category name
        ]);

        // Return a response back to the frontend (Inertia)
        return redirect()->route('products.index')->with('message', 'Category Added successfully');
    }
}
