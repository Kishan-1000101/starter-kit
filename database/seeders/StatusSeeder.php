<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    public function run()
    {
        // Seed statuses
        Status::create([
            'name' => 'Pending',
            'color' => '#FFA500',
            'grouping_key' => '*',
            'priority' => 3,
        ]);

        Status::create([
            'name' => 'Completed',
            'color' => '#008000',
            'grouping_key' => '*',
            'priority' => 1,
        ]);

        // Add more statuses as needed
    }
}
