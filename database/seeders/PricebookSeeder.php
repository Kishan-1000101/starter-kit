<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pricebook;
use App\Models\Segmentation;
use Illuminate\Support\Facades\DB;

class PricebookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assuming the segmentations already exist and we want to link the pricebooks to these segmentations
        $segmentation = Segmentation::first();

        DB::table('pricebooks')->insert([
            ['name' => 'Pricebook 1', 'version' => 'v1', 'segmentation_id' => $segmentation->id, 'comment' => 'First pricebook', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pricebook 2', 'version' => 'v1', 'segmentation_id' => $segmentation->id, 'comment' => 'Second pricebook', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pricebook 3', 'version' => 'v1', 'segmentation_id' => $segmentation->id, 'comment' => 'Third pricebook', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
