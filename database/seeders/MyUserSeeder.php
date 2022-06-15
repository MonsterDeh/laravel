<?php

namespace Database\Seeders;

use App\Models\MyUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MyUser::factory(5)->create(); 
        // MyUser::factory(5)->configure; 


        // DB::table('my_users')->insert([
        //     [
        //         'name'=>'amir',
        //         'phone'=>'09123456789',
        //         'national_code'=>'0123456789',
        //         'car_type'=>'Monsterdeh',
        //         'plaque'=>"sad52Car"
        //     ],
        //     [
        //         'name'=>'amirAli',
        //         'phone'=>'09123456787',
        //         'national_code'=>'0123456787',
        //         'car_type'=>'pekan',
        //         'plaque'=>"hello51Car"
        //     ],
            
            
        // ]);
    }
}
