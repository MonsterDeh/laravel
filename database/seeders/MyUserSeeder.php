<?php

namespace Database\Seeders;

use App\Models\MyUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MyUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        MyUser::query()->insert([
            'name'=>'admin' ,
            'phone'=>'09876543210 ',
            'national_code'=>'123Admin',
            'car_type'=>'car',
            'email'=>'admin@admin.com',
            'plaque'=>'98',
            'is_admin'=>true,
            'password'=>Hash::make("123")
        ]);
        MyUser::factory(10)->create(); 
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
