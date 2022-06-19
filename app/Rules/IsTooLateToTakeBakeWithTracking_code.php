<?php

namespace App\Rules;

use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class IsTooLateToTakeBakeWithTracking_code implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
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
        $date=Turn::query()->where($attribute,$value)->first()->date;
        $time=Carbon::now();

        // dd(
        //     $date,
        //     $time,   
        //     $time->copy()->parse($date),
        //     $time->diffInDays($time->copy()->parse($date),false)>1 ,
        //     $time->lessThan($time->copy()->parse($date)),
          
        // );

        if($time->diffInDays($time->copy()->parse($date),false)>1 and $time->lessThan($time->copy()->parse($date)) )
        return true;

        return false;
        // dd($date);

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'It is Too Late To TakeBake .';
    }
}
