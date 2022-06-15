<?php

namespace App\Models;

use App\Models\Scopes\CapacityWorktimeScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Worktime extends Model
{
    protected $append=['Time'];
    use HasFactory;
   protected $fillable=['capacity'];
   protected $table="worktime";

   protected function getTimeAttribute(){
    return $this->start.'-'.$this->end;
   }
    protected function day(): Attribute
    {
        return Attribute::make(
            get: fn ($value)  => ucfirst($this->intToDay($value)),
            set: fn ($value)  => $this->dayToInt(strtolower($value))
        );
    }
    public   function dayToInt($day){
       return match($day){
            'saturday'=>0,
            'sunday'=>1,
            'monday'=>2,
            'tuesday'=>3,
            'wednesday'=>4,
            'thursday'=>5,
            'friday'=>6,
        };
    }
    public function intToDay($int){
        return  match($int){
            0=>'saturday',
            1=>'sunday',
            2=>'monday',
            3=>'tuesday',
            4=>'Wednesday',
            5=>'Thursday',
            6=>'Friday',
        };
    }

    // protected static function booted()
    // {
    //     static::addGlobalScope(new CapacityWorktimeScope);
    // }

    public function scopeHasCapacity($query)
    {
        $query->where([['capacity','>',0]]);
    }
    public function scopeWhereDay($query,$day)
    {
        $query->where('day','=',$this->dayToInt(strtolower($day)));
    }

    public function turn()
    {
        return $this->hasMany(Turn::class);
    }
    
}
