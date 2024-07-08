<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic items',
            'parent_id' => null,
        ]);

        Category::create([
            'name' => 'Laptops',
            'description' => 'All kinds of laptops',
            'parent_id' => 1, // Assuming 1 is the ID of 'Electronics'
        ]);
    }
}
