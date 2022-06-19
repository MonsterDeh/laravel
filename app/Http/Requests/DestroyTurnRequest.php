<?php

namespace App\Http\Requests;

use App\Rules\isTooLateToTakeBake;
use App\Rules\IsTooLateToTakeBakeWithTracking_code ;
use Illuminate\Foundation\Http\FormRequest;

class DestroyTurnRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'tracking_code'=>[(new IsTooLateToTakeBakeWithTracking_code())]
        ];
    }
}
