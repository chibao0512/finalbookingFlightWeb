<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ChangePassword;

class ForgotPasswordRequest  extends FormRequest
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
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter email',
            'email.email' => 'Email is not well formatted',
        ];
    }
}
