<?php

namespace App\Rules;

use App\Models\Turn;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class NoEarlyDate implements Rule
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
        Carbon::parse($value);
        if((Carbon::parse($value))->lessThan(Carbon::now())){
            return false;
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
        return ' You must chose from today or the future .';
    }
}
