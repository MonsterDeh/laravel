<?php

namespace App\Http\Controllers;

use App\Models\Turn;
use Illuminate\Http\Request;

class TurnController extends Controller
{
    public function takeTurn()
    {
        return view("takeTurn");
    }
    public function trackTurn()
    {
        return view("trackTurn");
    }
}
