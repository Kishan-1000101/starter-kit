<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PriceMeta;

class PriceMetaSeeder extends Seeder
{
    public function run()
    {
        PriceMeta::create([
            'name' => 'USD',
            'full_name' => 'United States Dollar',
            'display_order' => 1,
            'devise_symbole' => '$',
            'devise_name' => 'USD',
            'devise_rate' => 1.00,
            'devise_rule' => json_encode(['rule' => 'example']),
        ]);

        PriceMeta::create([
            'name' => 'EUR',
            'full_name' => 'Euro',
            'display_order' => 2,
            'devise_symbole' => '€',
            'devise_name' => 'EUR',
            'devise_rate' => 0.85,
            'devise_rule' => json_encode(['rule' => 'example']),
        ]);
    }
}
