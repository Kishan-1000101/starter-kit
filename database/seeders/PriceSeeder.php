<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Price;

class PriceSeeder extends Seeder
{
    public function run()
    {
        Price::create([
            'segmentation_id' => 1,
            'base_amount' => 100.00,
            'price_meta_id' => 1,
        ]);

        Price::create([
            'segmentation_id' => 2,
            'base_amount' => 200.00,
            'price_meta_id' => 2,
        ]);
    }
}

