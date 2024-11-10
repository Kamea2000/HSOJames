<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Product;
use Inertia\Inertia;

class DashboardController extends Controller
{

    public function index()
    {
        $patients = Patient::all(); // Retrieve all patients
        $products  = Product::all(); // Retrieve all products
        $totalPatients = Patient::count(); // Count the total patients
        $totalProducts = Product::count(); // Count the total products
    

    
        return Inertia::render('RawDashboard', [
            'patients' => $patients,
            'products' => $products,
            'totalPatients' => $totalPatients,
            'totalProducts' => $totalProducts,
        ]);
    }
    
}
