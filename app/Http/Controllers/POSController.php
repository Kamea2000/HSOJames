<?php

namespace App\Http\Controllers;
use Inertia\Inertia;

use Illuminate\Http\Request;

class POSController extends Controller
{
    public function index()
    {
        return Inertia::render('Frontend/POS/Index'); // This should match the Vue component path
    }
}
