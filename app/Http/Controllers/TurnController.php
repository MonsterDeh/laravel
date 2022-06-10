<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class TurnController extends Controller
{
    public function takeTurn()
    {
        return view("turn.takeTurn");
    }
    public function trackTurn()
    {
        return view("turn.trackTurn");
    }
    public function createTurn (Request $request)
    {
        $round=rand(1000000,9999999);
        $create=Arr::add($request->all(),"tracking_code",$round);
        // dd($create);
        Turn::create($create);
        echo 'hello';
        
        // return view("turn.trackTurn");
    }
}
