<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name'=>'Wash basin',
                'price'=>25000,
                'time'=>15,
                'description'=>"Wash outside of car"
            ],
            [
                'name'=>'Internal cleaning',
                'price'=>30000,
                'time'=>20,
                'description'=>"Wash inside of car"
            ],
            [
                'name'=>'Zero washing',
                'price'=>25000,
                'time'=>15,
                'description'=>"Wash everywhere"
            ]
        ]);
    }
}
