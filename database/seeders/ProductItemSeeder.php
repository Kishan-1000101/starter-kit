<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductItemSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_items')->insert([
            ['product_id' => 1, 'item_id' => 1, 'item_value' => json_encode(['key' => 'value'])],
            ['product_id' => 2, 'item_id' => 1, 'item_value' => json_encode(['key' => 'value'])],
            ['product_id' => 1, 'item_id' => 2, 'item_value' => json_encode(['key' => 'value'])],
            // Add more seed data as needed
        ]);
    }
}

