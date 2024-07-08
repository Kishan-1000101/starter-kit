<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductReferenceSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_references')->insert([
            ['product_id' => 1, 'reference_id' => 1],
            ['product_id' => 1, 'reference_id' => 2],
            ['product_id' => 2, 'reference_id' => 1],
            // Add more seed data as needed
        ]);
    }
}

