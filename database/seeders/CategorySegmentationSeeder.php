<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Segmentation;

class CategorySegmentationSeeder extends Seeder
{
    /*public function run()
    {
        $category = Category::create([
            'name' => 'Category 1',
            'description' => 'Description for Category 1',
        ]);

        $segmentation = Segmentation::create([
            'name' => 'Segmentation 1',
            'price_rule' => json_encode(['rule' => 'example rule']),
        ]);

        $category->segmentations()->attach($segmentation);
    }*/

    public function run()
    {
        DB::table('category_segmentation')->insert([
            ['category_id' => 1, 'segmentation_id' => 1],
            ['category_id' => 1, 'segmentation_id' => 2],
            ['category_id' => 2, 'segmentation_id' => 1],
            // Add more seed data as needed
        ]);
    }
}
