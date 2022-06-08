<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my_users')->insert([
            [
                'name'=>'amir',
                'phone'=>'09123456789',
                'national_code'=>'0123456789',
                'car_type'=>'Monsterdeh',
                'plaque'=>"sad52Car"
            ],
            [
                'name'=>'amirAli',
                'phone'=>'09123456787',
                'national_code'=>'0123456787',
                'car_type'=>'pekan',
                'plaque'=>"hello51Car"
            ],
            
            
        ]);
    }
}
