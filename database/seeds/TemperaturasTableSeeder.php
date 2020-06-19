<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemperaturasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('temperaturas')->insert([
            'dia'=>1,
            'tempMax'=>31,
            'tempMin'=>29
        ]);
        DB::table('temperaturas')->insert([
            'dia'=>2,
            'tempMax'=>31,
            'tempMin'=>29
        ]);
        DB::table('temperaturas')->insert([
            'dia'=>3,
            'tempMax'=>29,
            'tempMin'=>27
        ]);
        DB::table('temperaturas')->insert([
            'dia'=>4,
            'tempMax'=>28,
            'tempMin'=>26
        ]);
        DB::table('temperaturas')->insert([
            'dia'=>7,
            'tempMax'=>27,
            'tempMin'=>25
        ]);
        DB::table('temperaturas')->insert([
            'dia'=>14,
            'tempMax'=>21,
            'tempMin'=>19
        ]);
        
    }
}
