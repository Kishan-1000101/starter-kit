<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class TierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('tier_types')->insert([
            'name' => 'Suplier',
        ]);
        DB::table('tier_types')->insert([
            'name' => 'Customer',
        ]);
        DB::table('tier_types')->insert([
            'name' => 'Employed',
        ]);
        DB::table('tier_types')->insert([
            'name' => 'Provider',
        ]);
    }
}
