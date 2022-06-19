<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminMaineRequest;
use App\Http\Requests\Admin\AdminTheTaskIsDoneRequest;
use App\Models\MyUser;
use App\Models\Service;
use App\Models\Turn;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function dashboard(AdminMaineRequest $request )
  {

    $flag=0;
    $Users=null;
    $Turn=null;
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
        
        if(session('one_user')==0 or !session()->exists('one_user') )
        {
            $Turn=Turn::where([
              ['date',session('Search_date')],
              ['status',session('Search_status')]
          ])->paginate(10);
        }else
        {
          $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q)
          {
            $q->where([
              ['date',session('Search_date')],
              ['status',session('Search_status')]
            ]);
          
           $q->where(function ($query2){
              $date=Carbon::now();
              
              $query2->whereMonth('date',$date->month);
  
              $query2->orWhere(function($query3) use($date){
                  $query3->whereMonth('date',$date->subMonth(1)->month);
              });
  
              $query2->orWhere(function($query4) use($date){
                  $query4->whereMonth('date',$date->subMonth(2)->month);
              });
            });
          }
          ])->paginate(10);
        }
      }else{
        $Service=Service::withCount(['Turn'=>function(Builder $query){
            $query->where([
                ['date',session('Search_date')],
            ]);
        }])->get();
        
        if(session('one_user')==0 or !session()->exists('one_user') )
        {
            $Turn=Turn::where([
              ['date',session('Search_date')],
            
          ])->paginate(10);
        }else
        {
          $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q)
          {
            $q->where([
              ['date',session('Search_date')],
             
            ]);
          
           $q->where(function ($query2){
              $date=Carbon::now();
              
              $query2->whereMonth('date',$date->month);
  
              $query2->orWhere(function($query3) use($date){
                  $query3->whereMonth('date',$date->subMonth(1)->month);
              });
  
              $query2->orWhere(function($query4) use($date){
                  $query4->whereMonth('date',$date->subMonth(2)->month);
              });
            });
          }
          ])->paginate(10);
        }
        
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
          if(session('one_user')==0 or !session()->exists('one_user') )
          {
              $Turn=Turn::where([
               
                ['status',session('Search_status')]
            ])->paginate(10);
          }else
          {
            $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q)
            {
              $q->where([
               
                ['status',session('Search_status')]
              ]);
            
             $q->where(function ($query2){
                $date=Carbon::now();
                
                $query2->whereMonth('date',$date->month);
    
                $query2->orWhere(function($query3) use($date){
                    $query3->whereMonth('date',$date->subMonth(1)->month);
                });
    
                $query2->orWhere(function($query4) use($date){
                    $query4->whereMonth('date',$date->subMonth(2)->month);
                });
              });
            }
            ])->paginate(10);
          }
          
          
          
        }else{
          $Service=Service::withCount(['Turn'])->get();
          if(session('one_user')==0 or !session()->exists('one_user'))
          {
            $Turn=Turn::paginate(10);

          }else{
            $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q){
              $q->where(function ($query2) {
                  $date=Carbon::now();
                  $query2->whereMonth('date',$date->month);
      
                  $query2->orWhere(function($query3) use($date){
                      $query3->whereMonth('date',$date->subMonth(1)->month);
                  });
      
                  $query2->orWhere(function($query4) use($date){
                      $query4->whereMonth('date',$date->subMonth(2)->month);
                  });
            } );
            }])->paginate(10);
          }
          
        }
    }else
    {
      $Service=Service::withCount('Turn')->get();
      if(session('one_user')==0 or !session()->exists('one_user'))
          {
            $Turn=Turn::paginate(10);

          }else{
            $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q){
              $q->where(function ($query2) {
                  $date=Carbon::now();
                  $query2->whereMonth('date',$date->month);
      
                  $query2->orWhere(function($query3) use($date){
                      $query3->whereMonth('date',$date->subMonth(1)->month);
                  });
      
                  $query2->orWhere(function($query4) use($date){
                      $query4->whereMonth('date',$date->subMonth(2)->month);
                  });
            } );
            }])->paginate(10);
          }
    }
        
      
      if($Users==null)
      $Users=MyUser::withCount(['turns',"turns as threeMonth"=>function (Builder $q){
        $q->where(function ($query2) {
            $date=Carbon::now();
            $query2->whereMonth('date',$date->month);

            $query2->orWhere(function($query3) use($date){
                $query3->whereMonth('date',$date->subMonth(1)->month);
            });

            $query2->orWhere(function($query4) use($date){
                $query4->whereMonth('date',$date->subMonth(2)->month);
            });
      } );
      }])->get();
      
        // dd(
        //   $Users,
        //   $Turn,
        //   // $Users->find($Turn->last()->user_id)->threeMonth
        // );
    return  view('admin.dashboard',compact('Turn','Service','Users'));
    // return [session()->all(),$Service];
    
  }

  public function DoneTurn(AdminTheTaskIsDoneRequest $request)
  {
     $turn= Turn::query()->where('tracking_code',$request->get('tracking_code'))->first();
     if($turn->status==0){
       $turn->status=1;
       
      }else{

        $turn->status=0;
     }
     dd($turn);
     $turn->save; 
     return back();
  }
}
