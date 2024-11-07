<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    use HasFactory;

    protected $fillable = ['name'];

}
