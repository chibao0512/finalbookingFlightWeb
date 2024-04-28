<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
            'name' => 'required | max:191 | unique:articles,name,'.$this->id,
            'category_id' => 'required',
            'description' => ['nullable'],
            'images'  => 'nullable|image|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Dữ liệu không thể để trống',
            'name.unique' => 'Dữ liệu đã bị trùng',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'category_id.required' => 'Dữ liệu không thể để trống',
            'description.max' => 'Vượt quá số ký tự cho phép',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
        ];
    }
}
