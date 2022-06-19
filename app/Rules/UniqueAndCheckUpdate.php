<?php

namespace App\Rules;

use App\Models\MyUser;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\Model;

class UniqueAndCheckUpdate implements Rule
{
    private array $exception;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(private MyUser $Model,private array $exceptionForAcceptZeroModelInDatabase=[])
    {
        $this->exception= $exceptionForAcceptZeroModelInDatabase;
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

        if(in_array($attribute,$this->exception))
        {
            if(count($user)>1  )
            return false ;
            
            $user=auth()->user();
        }else{
            
            if(count($user)!=1  )
            return false ;

            $user=$user->first();
        }

        if(request()->get('email')==$user?->email or request()->get('phone')==$user?->phone){
            
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The This :attribute number is wrong.';
    }
}
