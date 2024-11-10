<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    // TransactionController.php

    public function store(Request $request)
    {
        // Validate request data
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'total' => 'required|numeric|min:0',
            'discount_amount' => 'required|numeric|min:0',
            'cart_items' => 'required|array',
        ]);
    
        // Create a new transaction in the database
        $transaction = Transaction::create([
            'customer_name' => $validated['customer_name'],
            'total' => $validated['total'],
            'discount_amount' => $validated['discount_amount'],
            'cart_items' => json_encode($validated['cart_items']), // Storing cart items as JSON
        ]);
    
        // Share flash message with Inertia
        session()->flash('message', 'Transaction successfully processed!');
    
        // Return Inertia response (you might want to reload the page or handle it differently)
        return Inertia::render('Frontend/POS/Index', [
            'cartItems' => [], // Clear the cart or pass it back as necessary
        ]);
    }
    

}
