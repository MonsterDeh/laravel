<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use App\Models\Service;
use App\Models\User;
use App\Models\Worktime;
use Illuminate\Http\Request;

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


        \App\Models\MyUser::create($request->all());
        $user=\App\Models\MyUser::where('phone',$request->all()['phone'])->get();
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
        
        $User=MyUser::find($id);
        $Services=Service::all(); 
        $Worktime=(isset($_GET['day']))? 
            Worktime::hasCapacity()->where('day','=',(new Worktime)->dayToInt(strtolower($_GET['day'])))->get() : 
            Worktime::hasCapacity()->get()
        ;
        // if((isset($_GET['day']))){
        //     // dd($_GET['day']);
        //     dd($Worktime);
        // }
        return view('dashboard',compact('User','Services','Worktime'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //TODO  To  insert middle table
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
