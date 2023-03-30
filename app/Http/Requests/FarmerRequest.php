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
            // 'mobile' => 'required|integer|min:11|max:11',
            'profession' => 'required|min:5|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',

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
      'image.integer' => "Maximum file size to image is 2MB (2048 KB)",
      'mobile.required' => "Must be Mobile Number. Ex: 01700000000,01600000000",

    ];
    }
}
