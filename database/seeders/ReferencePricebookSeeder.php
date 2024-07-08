<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferencePricebookSeeder extends Seeder
{
    public function run()
    {
        DB::table('reference_pricebooks')->insert([
            ['pricebook_id' => 1, 'reference_id' => 1],
            ['pricebook_id' => 1, 'reference_id' => 2],
            ['pricebook_id' => 2, 'reference_id' => 1],
            // Add more seed data as needed
        ]);
    }
}

