<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
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
//            'file' => 'mimetypes:image/jpeg,image/png'
        ];
    }

    public function messages()
    {
        return [
//            'files.*.mimes' => 'Allowed file types: .jpg, .jpeg, .png,',
        ];
    }
}