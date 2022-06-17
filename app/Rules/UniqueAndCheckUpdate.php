<?php

namespace App\Rules;

use App\Models\MyUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class UniqueAndCheckUpdate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private MyUser $Model)
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
        $model=$this->Model;
        $user=$model->where($attribute,$value)->get();
        if(count($user)>1)
        return false ;

        $user=$user->first();
        
        if(request()->get('email')==$user->email or request()->get('phone')==$user->phone)
        return true;
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The This phone number is wrong.';
    }
}
