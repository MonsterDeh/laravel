<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorktimeSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        for ($day=0; $day < 7; $day++) { 
            for ($hour=9; $hour <21 ; $hour++) { 
                
                DB::table('worktime')->insert([ 
                    'day'=>$day,
                    'start'=>$hour,
                    'end'=> $hour+1,
                    
                ]);
               
            }
        }
    }
}
