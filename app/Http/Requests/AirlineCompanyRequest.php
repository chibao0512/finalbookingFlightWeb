<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirlineCompanyRequest extends FormRequest
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
            'code_no' => 'required | max:191 | unique:airline_companies,code_no,'.$this->id,
            'name' => 'required | max:191 | unique:airline_companies,name,'.$this->id,
            'images'  => 'nullable|image|mimes:jpeg,jpg,png,web,webp|max:10240',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Dữ liệu không thể để trống',
            'name.unique' => 'Dữ liệu đã bị trùng',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'code_no.required' => 'Dữ liệu không thể để trống',
            'code_no.unique' => 'Dữ liệu đã bị trùng',
            'code_no.max' => 'Vượt quá số ký tự cho phép',
            'images.image' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.mimes' => 'Vui lòng nhập đúng định dạng file ảnh',
            'images.max' => 'Vượt quá kích thước cho phép',
        ];
    }
}
