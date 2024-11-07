<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Category;
use Illuminate\Routing\Controller;

class POSController extends Controller
{
    // This is the main page that renders the POS view with products and categories
    public function index()
    {
        // Fetch products and categories from the database
        $products = Product::all();
        $categories = Category::all();

        // Return Inertia view for the POS page with data
        return Inertia::render('Frontend/POS/Index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    // This is for fetching products in a raw JSON format (e.g., for AJAX)
    public function getProducts()
    {
        return response()->json(Product::all());
    }

    // This is for fetching categories in a raw JSON format (e.g., for AJAX)
    public function getCategories()
    {
        return response()->json(Category::all());
    }

    // This shows a single product details (for product detail page)
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return Inertia::render('Frontend/POS/Show', [
            'product' => $product,
        ]);
    }
}
