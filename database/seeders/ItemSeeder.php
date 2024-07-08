<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run()
    {
        // Define sample items data
        $items = [
            [
                'name' => 'Item 1',
                'display_name' => 'Item One',
                'type' => 'string',
                'input_type' => 'text',
                'values' => null,
                'rules' => null,
                'disabled' => 0,
                'prefix' => null,
                'suffix' => null,
                'groupingKey' => '*',
                'parent' => null,
            ],
            [
                'name' => 'Item 2',
                'display_name' => 'Item Two',
                'type' => 'integer',
                'input_type' => 'number',
                'values' => null,
                'rules' => null,
                'disabled' => 0,
                'prefix' => null,
                'suffix' => null,
                'groupingKey' => '*',
                'parent' => null,
            ],
            // Add more items as needed
        ];

        // Insert data into the items table using Eloquent
        foreach ($items as $itemData) {
            Item::create($itemData);
        }
    }
}