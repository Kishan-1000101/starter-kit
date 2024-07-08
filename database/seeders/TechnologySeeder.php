<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fttx = DB::table('technologies')->insertGetId([
            'name' => 'FTTX',
            'code' => 'FTTX',
        ]);
        DB::table('technologies')->insert([
            'name' => 'FTTO',
            'code' => 'FTTO',
            'parent'=>$fttx
        ]);
        DB::table('technologies')->insert([
            'name' => 'FTTH',
            'code' => 'FTTH',
            'parent'=>$fttx
        ]);
        DB::table('technologies')->insert([
            'name' => 'FTTB',
            'code' => 'FTTB',
            'parent'=>$fttx
        ]);
        
        $broadband=DB::table('technologies')->insertGetId([
            'name' => 'BroadBand',
            'code' => 'BroadBand',
        ]);
        DB::table('technologies')->insert([
            'name' => 'ADSL',
            'code' => 'ADSL',
            'parent'=>$broadband
        ]);
        DB::table('technologies')->insert([
            'name' => 'BitStream',            
            'code' => 'BitStream',            
            'parent'=>$broadband
        ]);
        DB::table('technologies')->insert([
            'name' => 'VDSL',            
            'code' => 'VDSL',            
            'parent'=>$broadband
        ]);

        DB::table('technologies')->insert([
            'name' => 'EFM',
            'code' => 'EFM',
        ]);
        DB::table('technologies')->insert([
            'name' => 'SDSL',
            'code' => 'SDSL',
        ]);
        DB::table('technologies')->insert([
            'name' => 'WaveLength',
            'code' => 'WaveLength',
        ]);
    }
}
