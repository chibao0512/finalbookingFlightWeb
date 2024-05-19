<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
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
        $validate = [
//            'name'  => 'required|max:191',
//            'phone'  => 'required|regex:/^0[0-9]{9}$/|unique:users,phone,'.$this->id,
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter account name',
            'email.unique' => 'Account name cannot be duplicated',
            'email.max' => 'Account name exceeds the allowed number of characters',
            'images.image' => 'Please enter the correct image file format',
            'images.mimes' => 'Please enter the correct image file format',
            'phone.required' => 'Please enter a phone number',
            'phone.regex' => 'Incorrect data format',
            'phone.unique' => 'Phone numbers are not allowed to be duplicates',
        ];
    }
}
