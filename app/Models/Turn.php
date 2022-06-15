<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable=['tracking_code','user_id','services_id','worktime_id','Turn_id'];

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
    
}
