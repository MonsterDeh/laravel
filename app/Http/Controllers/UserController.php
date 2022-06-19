<?php

namespace App\Http\Controllers;

use App\Http\Requests\AUserWantUseMySiteRequest;
use App\Http\Requests\DestroyTurnRequest;
use App\Http\Requests\UpdateMyUserSiteRequest;
use App\Models\MyUser;
use App\Models\Service;
use App\Models\Turn;
use App\Models\Worktime;
use App\Rules\ItIsNotBetweenTime;
use App\Rules\NoEarlyDate;
use App\Rules\OpenTimeOfCarWash;
use App\Rules\TooLateItIsPast;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;
use Carbon\Carbon;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function index()
    {

        view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
    //  * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     */
    public function store(AUserWantUseMySiteRequest $request)
    {   
        
        // dd($request->all());
        // return$request->all();

        MyUser::create($request->all());
        $user=MyUser::where('phone',$request->all()['phone'])->get();
        // dd($user);
       return redirect()->route('User.show',['User'=>$user[0]['id'],200]);
      
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * 
     */
    public function show($id)
    {   
        
        $User=MyUser::findOrFail($id);
        $Services=Service::all(); 
        $Orders= Turn::where([['user_id',$id],['status','0']])->get();
    //    dd($Orders);
        
        Worktime::hasCapacity()->get();

        return view('dashboard',compact('User','Services','Orders',));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $date = Carbon::parse($request->get('day').' '.$request->get('Hour'));
        // $service
        // dd(request()->all());
        $validate= $request->validate(
            [
                "day"=>[
                (new ItIsNotBetweenTime(new Turn,$date,new Service)),
                (new TooLateItIsPast($date)),
                (new NoEarlyDate)],
                "Hour"=>[(new OpenTimeOfCarWash($date))] ,
                'service'=>'required'
                
            ]
        );



        
        // dd($validate);
        $turn=Turn::query()->where('tracking_code',$request->get('tracking_code'));
        // $service=$turn->service;
        // dd($turn->);
        $turn->update(
            [
                'date'=>$validate['day'],
                'start'=>$validate['Hour'],
                'end'=>$date->addMinute(Service::find($validate['service'])->time) ,
            ]
        );
       
        return back(201)->with('success','update is successful');
        //    dd($Worktime);
        // $Dates=['turn_id'=>$turn->id,'user_id'=>$turn->user_id];
        // return view('turn.form' ,compact('Worktime','Dates'));
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
    //  * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Turn=Turn::find($request->get('oldTurn_id'));

        $Turn->worktime->capacity+=$Turn->services->time;
        $Turn->worktime->save();

        $Turn=Turn::find($request->get('oldTurn_id'));
        $Turn->worktime_id=$request->get('newWorktim_id');
        $Turn->save();
        
        $Turn->worktime->capacity-=$Turn->services->time;
        $Turn->worktime->save();
       
        
        // dd($Turn,$Turn->services->time);

        return redirect()->route('User.show',['User'=>$id]) ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyTurnRequest $request,$id)
    {
        // dd($request->all());
        // $Turn=Turn::find($request->get('tracking_code'));
        // $worktime=Worktime::find($Turn->worktime_id );
        // $worktime->capacity+=Service::find($Turn->services_id)->time;
        // $worktime->save();
        
        Turn::query()->where('tracking_code',$request->get('tracking_code'))->delete();
        return redirect()->route("User.show",['User' => $id])->with('success','delete is successful');
    }
    public function worktime(Request $request,$id)
    {
        // return$request->all();  
        
        $date = Carbon::parse($request->get('day').' '.$request->get('Hour'));

        
       $validate= $request->validate([

            "day"=>[
                (new ItIsNotBetweenTime(new Turn,$date,new Service)),
                (new TooLateItIsPast($date)),
                (new NoEarlyDate)],
            "Hour"=>[(new OpenTimeOfCarWash($date))] ,
            "service"=>['numeric']
        ]);



        // dd($id,$request->all());
       
        
        // dd($date->minute);
        // dd($request->all(),$request->get('day').' '.$request->get('Hour'),$date->toDateTime(),);
        $service=Service::find( $request->get('service'));
        // dd($request->all());
      
        
        // $Worktime=Worktime::
        //     hasCapacity()->
        //     whereDay($request->all()['day'])->
        //     where("capacity",'>=',$service->time)->
        //     get();
        // dd($request->all(),$date->copy()->addMinute($service->time)->format('H:i'),$service->time);
        $random=rand(1000000,9999999);
        
        // $create=Arr::add($request->all(),"tracking_code",$random);
        // $update=[
                
        //     ];
            
        Turn::query()->create([

            "tracking_code"=>$random,
            'date'=>$request->get('day'),
            'start'=>$request->get('Hour'),
            'end'=>$date->copy()->addMinute($service->time)->format('H:i'),
            'services_id'=>$request->get('service'),
            'user_id'=>$request->get('id')

        ]);

        //  dd($service);
        
       
        // $Dates=['user_id'=>$id,'services_id'=>$request->all()['service']];
    //    return view('form',compact('Worktime','Dates'));
        return  to_route('User.show',$request->get('id'),201);
        
    }

    public function updateMyUserSite(UpdateMyUserSiteRequest $request)
    {
      $user= MyUser::find(auth()->id());
      $user->update($request->all());
        if($user->is_profile_complete==0){
            $user->is_profile_complete=1;
            $user->is_register=1;
            $user->save();
        }
       
       return back(201)->with('success','You update Successfully');
    }
}
