<?php
// app/Models/Transaction.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'total', 'discount_amount', 'cart_items',
    ];

    protected $casts = [
        'cart_items' => 'array',  // Automatically cast the cart_items column to an array
    ];
}
