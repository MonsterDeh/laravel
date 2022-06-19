<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;
    protected $appends = ['time'];
    protected $fillable=[
        'tracking_code',
        'user_id',
        'services_id',
        'worktime_id',
        'Turn_id',
        'start',
        'end',
        'date',
        'status',
        
    ];
    protected $append=['Total_price'];
    protected $hidden=[];

    public function worktime()
    {
        return $this->belongsTo(Worktime::class);
    }
    public function services()
    {
        return $this->belongsTo(Service::class);//->withDefault();
    }
    public function user()
    {
        return $this->belongsTo(MyUser::class);
    }
    public function scopeWherePrice($query)
    {
        $query->where([['status','=',1]]);
    }
    protected function time(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes){
                return $attributes['start'].'-'.$attributes['end'];

            } ,
        );
    }
    public function scopeWhereThreeMonth($query)
    {
        
        $query->where(function ($query2) {
            $date=Carbon::now();
            $query2->whereMonth('date',$date->month);

            $query2->orWhere(function($query3) use($date){
                $query3->whereMonth('date',$date->subMonth(1)->month);
            });

            $query2->orWhere(function($query4) use($date){
                $query4->whereMonth('date',$date->subMonth(2)->month);
            });

        } );
    }

    
    
    
}
