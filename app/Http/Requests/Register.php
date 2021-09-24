<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class Register extends FormRequest
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

        $rules = [

            'password' => 'required|confirmed|min:6',
            'name' => 'required|alpha|unique:users,name',
            'email' => 'required|email|unique:users,email',
        ];

        return $rules;
    }

    public function messages(){
        return [
            'name.required' => 'Profile name is required',
            'password.required' => 'Password is required',
            'email.required' => 'Email is required.',
            'name.alpha' => 'Profile name can only contain letters'
        ];
    }

}
