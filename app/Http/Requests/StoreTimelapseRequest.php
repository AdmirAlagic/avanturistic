<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTimelapseRequest extends FormRequest
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
            'paths' => 'required|array|min:3',
            'audio' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'paths.required' => 'Please select at least 3 photos.',
            'paths.array' => 'Please select at least 3 photos.',
            'paths.min' => 'Please select at least 3 photos.',
            'audio.required' => 'Please select music.',
             
        ];
    }
}
