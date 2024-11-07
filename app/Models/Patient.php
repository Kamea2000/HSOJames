<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';
    protected $fillable = [
        'first_name', 
        'last_name', 
        'gender', 
        'email', 
        'phone', 
        'occupation', 
        'date_of_birth', 
        'address'
    ];

    // Optionally, you can also define any other relevant properties such as casts if necessary
}

