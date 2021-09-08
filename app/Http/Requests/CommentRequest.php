<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Auth;

class CommentRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $rules =  [
            'body' => 'required'
        ];

        $user = Auth::user();
        if(!$user){
            $rules['email'] = 'required|email';
            $rules['name'] = 'required';

        }
        return $rules;
    }
    public function messages()
    {
        return [
            'body.required' => 'Can\'t submit empty comment',
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required'
        ];
    }

}
