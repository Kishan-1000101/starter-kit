<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reference;

class ReferenceSeeder extends Seeder
{
    public function run()
    {
        Reference::create([
            'code' => 'REF001',
            'description' => 'Reference description 1',
            'category_id' => 1, // Ensure this matches an existing category_id
        ]);

        Reference::create([
            'code' => 'REF002',
            'description' => 'Reference description 2',
            'category_id' => 2, // Ensure this matches an existing category_id
        ]);
    }
}
