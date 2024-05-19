<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInfoAccountRequest extends FormRequest
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
            //
            'name'  => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone'  => 'required|regex:/^0[0-9]{9}$/',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter your full name',
            'email.required' => 'Please enter your login email',
            'email.unique' => 'Login email cannot be duplicated',
            'email.max' => 'Email exceeds the allowed number of characters',
            'phone.required' => 'Please enter a contact phone number',
            'phone.regex' => 'Incorrect data format',
            'phone.unique' => 'Phone numbers are not allowed to be duplicates',

        ];
    }
}
