<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'lxn_id' => '1234567890',
                'street' => 'Main Street',
                'street_no' => '123',
                'building' => 'Building A',
                'floor' => '3rd Floor',
                'apartment' => 'Apt 301',
                'district' => 'Downtown',
                'zip_code' => '12345',
                'city' => 'Cityville',
                'country_alpha3' => 'USA',
                'latitude' => 407128,
                'longitude' => -740060,
            ],
            [
                'lxn_id' => null,
                'street' => 'Broadway',
                'street_no' => '456',
                'building' => null,
                'floor' => null,
                'apartment' => null,
                'district' => 'Midtown',
                'zip_code' => '54321',
                'city' => 'Citytown',
                'country_alpha3' => 'AUS',
                'latitude' => 407580,
                'longitude' => -739855,
            ],
            // Add more dummy data as needed
        ];

        foreach ($data as $item) {
            Address::create($item);
        }
    }
}

