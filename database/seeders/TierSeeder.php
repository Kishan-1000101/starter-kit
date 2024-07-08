<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tier;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tier::create([
            'segmentation_id' => 1,
            'tier_id' => 1,
            'tier_type_id' => 1,
            'tierable_type' => 'App\\Models\\Supplier',
            'tierable_id' => 1
        ]);

        Tier::create([
            'segmentation_id' => 2,
            'tier_id' => 2,
            'tier_type_id' => 2,
            'tierable_type' => 'App\\Models\\Customer',
            'tierable_id' => 2
        ]);

        // Add more initial data as needed
    }
}
