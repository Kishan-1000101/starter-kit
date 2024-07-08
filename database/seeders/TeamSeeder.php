<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'Global Admin', 
            'personal_team' => 0,
        ]);
        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'LuxNetwork', 
            'personal_team' => 0,
        ]);
        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'Customer', 
            'personal_team' => 0,
        ]);
    }
}
