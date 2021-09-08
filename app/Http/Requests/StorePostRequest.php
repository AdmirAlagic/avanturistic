<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'lat' => 'required',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'lat.required' => 'Location is required.',
            'lng.required' => 'Location is required.',
            'image.required' => 'At least one photo is required.',
        ];
    }
}
