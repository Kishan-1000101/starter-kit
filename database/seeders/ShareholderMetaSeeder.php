<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShareholderMeta;


class ShareholderMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create dummy data
        ShareholderMeta::create([
            'name' => 'Meta 1',
            'comment' => 'This is meta 1',
        ]);

        ShareholderMeta::create([
            'name' => 'Meta 2',
            'comment' => 'This is meta 2',
        ]);

        // Add more records as needed
    }
}

