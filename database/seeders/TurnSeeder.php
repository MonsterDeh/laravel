<?php

namespace Database\Seeders;

use App\Models\Turn;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TurnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Turn::create([
            [
                'tracking_code'=>'3691879',
                'user_id'=>1,
                'services_id'=>3,
                'worktime_id'=>1,
                'Turn_id'=>2,
                
            ],
            
            
            
        ]); 
        Turn::create([
           
            [
                'tracking_code'=>'',
                'user_id'=>1,
                'services_id'=>3,
                'worktime_id'=>2,
                'Turn_id'=>"",
                
            ],
            
            
        ]); 
    }
}
