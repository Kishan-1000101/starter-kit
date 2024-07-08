<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Segmentation;
use Illuminate\Support\Facades\DB;

class SegmentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('segmentations')->insert([
            ['name' => 'Segmentation 1', 'price_rule' => json_encode(['rule' => 'value']), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Segmentation 2', 'price_rule' => json_encode(['rule' => 'value']), 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Segmentation 3', 'price_rule' => json_encode(['rule' => 'value']), 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
