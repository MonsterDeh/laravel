<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MyUser;
use App\Models\Service;
use App\Models\Turn;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function dashboard(Request $request )
  {

    $flag=0;
    if(session()->exists('Search_status') && session()->exists('Search_date')&& !( session('Search_date')==false ||  session('Search_date')==null) )
    {
      if(session('Search_status')==1 or session('Search_status')==0) 
      {
        $Service=Service::withCount(['Turn'=>function(Builder $query){
            $query->where([
                ['date',session('Search_date')],
                ['status',session('Search_status')]
            ]);
        }])->get();
        $Turn=Turn::where([
                ['date',session('Search_date')],
                ['status',session('Search_status')]
            ])->paginate(10);
      }else{
        $Service=Service::withCount(['Turn'=>function(Builder $query){
            $query->where([
                ['date',session('Search_date')],
            ]);
        }])->get();
        $Turn=Turn::where('date',session('Search_date'))->paginate(10);
      }

    }elseif(session()->exists('Search_status') && ( session('Search_date')==false ||  session('Search_date')==null))
    {
        if(session('Search_status')==1 or session('Search_status')==0) 
        {
          $Service=Service::withCount(['Turn'=>function(Builder $query){
              $query->where([
                
                  ['status',session('Search_status')]  
              ]);
          }])->get();
          $Turn=Turn::where('status',session('Search_status'))->paginate(10);
          
          
          
        }else{
          $Service=Service::withCount(['Turn'])->get();
          $Turn=Turn::paginate(10);

        }
    }else
    {
      $Service=Service::withCount('Turn')->get();
      $Turn=Turn::paginate(10);
    }
        
      // Turn::query()->paginate(10);
        
    return  view('admin.dashboard',compact('Turn','Service',));
    return [session()->all(),$Service];
    
  }
}
