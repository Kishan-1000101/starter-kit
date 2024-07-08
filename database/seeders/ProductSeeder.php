<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Product 1',
            'description' => 'Description for product 1',
            'category_id' => 1, // Ensure this matches an existing category_id
            'comment' => 'Comment for product 1',
        ]);

        Product::create([
            'name' => 'Product 2',
            'description' => 'Description for product 2',
            'category_id' => 2, // Ensure this matches an existing category_id
            'comment' => 'Comment for product 2',
        ]);
    }
}
