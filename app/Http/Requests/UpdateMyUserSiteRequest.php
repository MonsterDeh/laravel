<?php

namespace App\Http\Requests;

use App\Models\MyUser;
use App\Rules\UniqueAndCheckUpdate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMyUserSiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (auth()->check() );
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
            "phone"=>[new UniqueAndCheckUpdate(new MyUser),] /* 'unique:App\Models\MyUser'*/,
            "car_type"=>'string',
            "plaque"=>''
        ];
    }
}
