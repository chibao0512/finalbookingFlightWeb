<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UserRequest extends FormRequest
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
            'name'  => 'required|max:191',
            'email' => 'required|email|max:191|unique:users,email,'.$this->id,
            'role'  => 'required',
            'phone'  => 'required',
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
        if ($request->submit !== 'update') {
            $validate['password'] = 'required | max:191 ';
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'name.required' => 'Data is not allowed to be empty.',
            'email.required' => 'Data cannot be empty.',
            'email.unique' => 'Email already exists.',
            'aliases.required' => 'Data cannot be empty.',
            'email.max' => 'Invalid format allowed.',
            'password.required' => 'Please enter your login password',
            'role.required' => 'Please select user role',
            'images.image' => 'Please enter the correct image file format',
            'images.mimes' => 'Please enter the correct image file format',
            'branch_id.required' => 'Please select user branch',
        ];
    }
}
