<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateInforProfileRequest extends FormRequest
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
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone' => ['required'],
            'landline_telephone' => ['required'],
            'department_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter first and middle name',
            'last_name.required' => 'Please enter a name',
            'email.required' => 'Please enter email',
            'email.email' => 'Email format is incorrect',
            'email.unique' => 'Email address has been duplicated',
            'phone.required' => 'Please enter a phone number',
            'landline_telephone.required' => 'Please enter an extension number',
            'department_id.required' => 'Please select your current department',
        ];
    }
}
