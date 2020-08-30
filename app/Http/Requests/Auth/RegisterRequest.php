<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['string', 'required'],
            'username' => ['alpha_num', 'required', 'min:4', 'max:25', 'unique:users,username'],
            'phone' => ['string', 'required', 'unique:users,phone'],
            'password' => ['alpha_num', 'min:6']
        ];
    }
}
