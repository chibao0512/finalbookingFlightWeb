<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
            'gender' => 'required',
            'birthday' => 'required',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Data is not allowed to be empty.',
            'email.required' => 'Data cannot be empty.',
            'email.unique' => 'Data cannot be duplicated',
            'email.max' => 'Data exceeds the allowed number of characters',
            'password.required' => 'Data is not allowed to be empty.',
            'password_confirm.required' => 'Data is not allowed to be empty.',
            'password_confirm.same' => 'Passwords do not match',
            'gender.required' => 'Data cannot be blank.',
            'birthday.required' => 'Data cannot be empty.',
        ];
    }
}
