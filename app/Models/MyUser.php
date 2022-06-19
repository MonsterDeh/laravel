<?php

namespace App\Models;

use App\Support\Address;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;   
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MyUser extends Authenticatable
{

    use HasFactory;
     // protected $guarded=[''];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'car_type',
    //     'national_code',
    //     'plaque',
    //     'email',
    //     // "family_name"
    // ];
    protected $guarded=[
        'id',
        'remember_token',
        'created_at',
        'is_admin',
        'is_profile_complete',
        'is_register',
    ];
    // protected $appends = ['threeMonth'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
    // protected function name(): Attribute
    // {   
    //     // dd($this);
    //     return Attribute::make(
    //         set: fn ($value,$attributes) => $value.''.$attributes['family_name'],
    //     );
    // }
    public function turns()
    {
      return  $this->hasMany(Turn::class,'user_id','id');
    }

    // protected function name(): Attribute
    // {   
    //     return Attribute::make(
    //         set: fn ($value, $attributes)  =>dd($value,$attributes)// $value." ".$attributes['family_name']
        
    //     );
    // }

    // public function setNameAttribute($value)
    // {
       
    //     $this->name .=' '.$this->family_name ;
    // }

    //TODO: Bug  I can not make Mutators
    // protected function name(): Attribute
    // {   
    //     return Attribute::make(
            
    //         set: fn ($value,$attributes) => $value.''.$attributes['family_name'],
    //     );
    // }
    // protected function threeMonth(): Attribute
    // {   
    //     return Attribute::make(
            
    //         get: function ($value,$attributes){
    //             $this::withCount(["turns as threeMonth"=>function (Builder $q){
    //                         $q->where(function ($query2) {
    //                             $date=Carbon::now();
    //                             $query2->whereMonth('date',$date->month);
                    
    //                             $query2->orWhere(function($query3) use($date){
    //                                 $query3->whereMonth('date',$date->subMonth(1)->month);
    //                             });
                    
    //                             $query2->orWhere(function($query4) use($date){
    //                                 $query4->whereMonth('date',$date->subMonth(2)->month);
    //                             });
                    
    //                         } );
    //                     }])->get();
    //         },
    //     );
    // }


    // public function howManyInThreeMonth()
    // {   
        
    //     // $this->query()->withCount(
    //     //   ['turns as howManyInThreeMonth'=>
    //     //       function(Builder $query)
    //     //       {
    //     //           $query->WhereThreeMonth();
    //     //       }
    //     //   ])->get();
            
    //     // $this->query()->where(DB::RAW('month(created_at)'), $months)
    //     // ->get(); 
    //     // DB::table($this->table)->select()->;
    //     $date=Carbon::now();
    //     $months=[
    //         $date->month,
    //         $date->copy()->subMonth(1)->month,
    //         $date->copy()->subMonth(2)->month,
    //     ];
    //         $this->query()->withCount(['turns'=>function(Builder $qeury1) use($months){
    //             $qeury1->where(DB::RAW('month(date)'), $months)
    //             ->get();
    //         }]);
            
            
        
    // }
    
}
