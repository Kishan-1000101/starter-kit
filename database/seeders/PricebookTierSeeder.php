<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricebook;
use App\Models\Tier;
use App\Models\PricebookTier;

class PricebookTierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pricebook = Pricebook::first();
        $tier = Tier::first();

        PricebookTier::create([
            'pricebook_id' => $pricebook->id,
            'tier_id' => $tier->id,
            'start' => now(),
            'end' => now()->addYear(),
        ]);
    }
}
