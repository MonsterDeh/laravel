<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AUserWantUseMySiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        //TODO find way for user and UserSite to deferent canListToDo
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            
            "name"=>'required|min:3|max:100',
            "family_name"=>'required|min:3|max:100',
            "national_code"=>'numeric',
            "phone"=>'unique:App\Models\MyUser',
            "car_type"=>'string',
            "plaque"=>''

        ];
    }
}
