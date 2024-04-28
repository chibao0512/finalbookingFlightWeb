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
            'name.required' => 'Dữ liệu không được phép để trống.',
            'email.required' => 'Dữ liệu không được phép để trống.',
            'email.unique' => 'Email đã tồn tại.',
            'aliases.required' => 'Dữ liệu không được phép để trống.',
            'email.max' => 'Không đúng định dạng cho phép.',
            'password.required' => 'Vui lòng nhập mật khẩu đăng nhập',
            'role.required' => 'Vui lòng chọn vai trò của người dùng',
            'images.image'  => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes'  => 'Vui lòng nhập đúng định dạng file ảnh',
            'branch_id.required' => 'Vui lòng chọn chi cục của người dùng',
        ];
    }
}
