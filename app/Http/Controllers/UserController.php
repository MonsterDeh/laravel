<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use App\Models\Service;
use App\Models\Turn;
use App\Models\Worktime;
use Illuminate\Http\Request;
use Illuminate\Queue\Worker;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        view('dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
    public function store(Request $request)
    {   
        
        // dd($request->all());
            //------------bug------------//
        // User::create($request->all());
        // dd(User::all());
        // redirect()->route('User.show');
        //------------------------//
        //------------bug2------------//
        // $a=$request->all();
        // unset($a['_token']);
        // $user=new User;
        // foreach($a  as $atr=>$value){
        //     $user->$atr=$value;
        // //   echo" $atr=$value";
        // }
        // dd($user);
        // $user->save();
        //------------------------//
        //------------bug3------------//
        // $a=$request->all();
        // $user=new User;
        // $user->name=$a['name']." ".$a['family_name'];
        // // $user->family_name=$a['family_name'];
        // $user->national_code=$a['national_code'];
        // $user->phone=$a['phone'];
        // $user->car_type=$a['car_type'];
        // $user->plaque=$a['plaque'];
        // //  dd($user);
        // $user->save();
        //------------------------//


        MyUser::create($request->all());
        $user=MyUser::where('phone',$request->all()['phone'])->get();
        // dd($user);
       return redirect()->route('User.show',['User'=>$user[0]['id'],200]);
        // echo 'hekko';
        

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
        // dd($request);
        $turn=Turn::find($request->get('tracking_code'));
        
        // dd($turn->worktime  );
        $oldWorktime=$turn->worktime; 
        $service=Service::find($turn->services_id);
        
        // dd($oldWorktime->day);
        // dd($id,$request->all(),$turn,$service);

        $Worktime=Worktime::
        hasCapacity()->
            whereDay($oldWorktime->day)->
            where([
                ["capacity",'>=',$service->time],
                ['id' ,'!=',$turn->worktime_id]
            ])->
            get()
        ;
       
        
        //    dd($Worktime);
        $Dates=['turn_id'=>$turn->id,'user_id'=>$turn->user_id];
        return view('turn.form' ,compact('Worktime','Dates'));
     
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
    public function destroy(Request $request,$id)
    {
        // dd($request->all());
        $Turn=Turn::find($request->get('tracking_code'));
        $worktime=Worktime::find($Turn->worktime_id );
        $worktime->capacity+=Service::find($Turn->services_id)->time;
        $worktime->save();

        Turn::destroy($request->get('tracking_code'));
        return redirect()->route("User.show",['User' => $id]);
    }
    public function worktime(Request $request,$id)
    {
        // dd($id,$request->all());
        $service=Service::find( $request->get('service'));
        // dd($request->all());
        $Worktime=Worktime::
            hasCapacity()->
            whereDay($request->all()['day'])->
            where("capacity",'>=',$service->time)->
            get();
        //  dd($service);
        
       
        $Dates=['user_id'=>$id,'services_id'=>$request->all()['service']];
       return view('form',compact('Worktime','Dates'));
        
    }
}
