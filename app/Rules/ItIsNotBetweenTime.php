<?php

namespace App\Rules;

use App\Models\Service;
use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class ItIsNotBetweenTime implements Rule
{
    private string $massage;
    /**
     * Create a new rule instance.
     *@param Model $Model where you want check time exist 
     * @return void
     */
    public function __construct(private Turn $Model,private Carbon $dateAndHour,private Service $service)
    {
        $this->massage= 'This Time is full ';
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

       
        $Turn=$this->Model;
        $date=$this->dateAndHour;
       $turn= $Turn->where('date',$date->toDateString())->get();
        $hour=(Carbon::now()->setTime($date->hour,$date->minute) )  ;
        // dd($turn);
        // dd
        // (
        //     // $turn->toArray(),
        //     $hour,
        //     Carbon::parse($turn[1]->end),
        //     Carbon::parse($turn[1]->start),
        //     (Carbon::parse($turn[0]->start))->lessThanOrEqualTo(Carbon::parse($turn[0]->end)),
        //     (
        //         ($hour)->lessThan(Carbon::parse($turn[0]->end))
        //         and
        //         ($hour)->greaterThan(Carbon::parse($turn[0]->start))
        //     )

        // );


        if(count($turn)==0 ){
            return true;
        }   
         //TODO  inn bazeh ro  [ ( ) ] =>false darad  in ha ro nadarad  ( [ ) ] or  [  ( ] )
        foreach($turn as $item){
            if(request()->has('tracking_code')){
                if($item->tracking_code==request()->get('tracking_code'))
                continue;
            }
            if
            (
                ($hour)->lessThan(Carbon::parse($item->end))
                and
                ($hour)->greaterThan(Carbon::parse($item->start))
            )
            {
                $this->massage= 'Date: '.$item->date. ' Time:'.$item->start.'-'.$item->end.'is full';
                return false;
            }else
            {   
                $time=$this->service->query()->find(request()->get('service'))->time;
                $hourEnd=$hour->copy()->addMinutes($time);

                if
                (
                    ($hourEnd)->lessThan(Carbon::parse($item->end))
                    and
                    ($hourEnd)->greaterThan(Carbon::parse($item->start))
                )
                {
                    $this->massage= 'Date: '.$item->date. ' Time:'.$item->start.'-'.$item->end.'is full';
                    return false;
                }
        }   }

        return true;


    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->massage;
    }
    
}
