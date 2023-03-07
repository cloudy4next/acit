<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FarmerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|min:5|max:255',
            'address' => 'required|min:5|max:255',
            'mobile' => 'required|min:5|max:255',
            'profession' => 'required|min:5|max:255',
            'image' => 'required|max:2048|mimes:jpeg,png,jpg,gif',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
    return [
      'image.required' => "You must use the 'Choose file' button to select which file you wish to upload",
      'image.max' => "Maximum file size to image is 2MB (2048 KB). If you are uploading a photo, try to reduce its resolution to make it under 2MB"
    ];
    }
}
