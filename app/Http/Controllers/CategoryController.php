<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        // Return all categories
        return Inertia::render('Frontend/Product/Index', [
            'categories' => Category::all(),
        ]);
    }
}
