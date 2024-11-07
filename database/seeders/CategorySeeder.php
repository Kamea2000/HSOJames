<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    Category::create(['name' => 'Category 1']);
    Category::create(['name' => 'Category 2']);
    // Add more categories as needed
}
}
