<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Turn;
use App\Models\Worktime;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Illuminate\Support\Arr;

class TurnController extends Controller
{   
    
    public function takeTurn(Request $request)
    {
        return view("turn.takeTurn");
    }
    public function trackTurnPost(Request $request)
    {   
        $Turn=Turn::where('tracking_code',$request->get('tracking_code'))->first();
        $Time=Worktime::find($Turn->worktime_id);
        return compact('Turn','Time');
        // return view("turn.takeTurn",compact('turn','time'));
    }
    public function trackTurn()
    {
        return view("turn.trackTurn");
    }
    public function createTurn (Request $request)
    {
        $random=rand(1000000,9999999);
        
        $service=Service::find($request->get('services_id'));
        $worktime=Worktime::find($request->get('worktime_id'));
        
        
        $worktime->capacity-= $service->time;
        $worktime->save();
        // Worktime::where(['id',])->update(['capacity'=>  ]);
        // $

        $create=Arr::add($request->all(),"tracking_code",$random);
        // dd($create) ;
        // dd($create);
        Turn::create($create);
       
        
       return redirect()->route('User.show',['User'=>$request->get('user_id')]);
        // return view("turn.trackTurn");
    }
    
}
