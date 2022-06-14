<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turn extends Model
{
    use HasFactory;

    protected $fillable=['tracking_code','user_id','services_id','worktime_id'];

    public function worktime()
    {
        return $this->hasOne(Worktime::class);
    }
    
}
