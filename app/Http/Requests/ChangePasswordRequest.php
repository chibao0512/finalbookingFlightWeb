<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ChangePassword;

class ChangePasswordRequest extends FormRequest
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
            'c_password' => ['required', new ChangePassword],
            'password' => ['required'],
            'password_confirm' => ['required', 'same:password']
        ];
    }

    public function messages()
    {
        return [
            'c_password.required' => 'Vui lòng nhập mật khẩu hiện tại',
            'password.required' => 'Vui lòng nhập vào mật khẩu mới',
            'password_confirm.required' => 'Vui lòng nhập lại mật khẩu',
            'password_confirm.same' => 'Mật khẩu không trùng khớp',

        ];
    }
}
