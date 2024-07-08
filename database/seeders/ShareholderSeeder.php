<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ShareholderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define dummy data with unique shareholder_id and id
        $shareholders = [
            [
                'shareholder_id' => 1,
                'tier_id' => 1,
                'start' => Carbon::now(),
                'end' => Carbon::now()->addHour(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [   
                'shareholder_id' => 2,
                'tier_id' => 2,
                'start' => Carbon::now()->addHour(),
                'end' => Carbon::now()->addHours(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // Add more dummy data as needed
        ];

        // Insert data into the shareholders table
        DB::table('shareholders')->insert($shareholders);
    }
}