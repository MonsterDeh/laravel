<?php

namespace App\Rules;

use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class ItIsNotBetweenTime implements Rule
{
    /**
     * Create a new rule instance.
     *@param Model $Model where you want check time exist 
     * @return void
     */
    public function __construct(private Turn $Model,private Carbon $dateAndHour)
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {   
        // dd($attribute,$value);
        // dd($this->Model,$this->date);
        $Turn=$this->Model;
        $date=$this->dateAndHour;
        // dd($date->toDateString());
       $turn= $Turn->where('date',$date->toDateString())->get();
        $hour=(Carbon::now()->setTime($date->hour,$date->minute) )  ;
        // dd($turn);
        // dd(
        //     $turn->toArray(),
        //     (Carbon::parse($turn[0]->start))->lessThanOrEqualTo(Carbon::parse($turn[0]->end)),
            

        // );


        if(count($turn)==0 ){
            return true;
        }   
         //TODO  inn bazeh ro  [ ( ) ] =>false darad  in ha ro nadarad  ( [ ) ] or  [  ( ] )
        foreach($turn as $item){
            if(
                ($hour)->lessThan(Carbon::parse($turn[0]->end))
                and
                ($hour)->greaterThan(Carbon::parse($turn[0]->start))
            )
            {
                return false;
            }
        }
        return true;


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This Time is full ';
    }
}
