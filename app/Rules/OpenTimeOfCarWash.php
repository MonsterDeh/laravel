<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class OpenTimeOfCarWash implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private Carbon $hour)
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
        $hour=(Carbon::now())->setTime($this->hour->hour,$this->hour->minute) ;
        if(
            $hour->lessThan((Carbon::now())->setHour(9))
            or
            $hour->greaterThan((Carbon::now())->setHour(21))
        )
        return false;
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'We are close';
    }
}
