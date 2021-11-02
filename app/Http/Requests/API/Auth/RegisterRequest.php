<?php

namespace App\Http\Requests\API\Auth;

use App\Traits\API\ApiFormValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest {

    use ApiFormValidationTrait;

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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'tac' => 'required'
        ];
    }
}
