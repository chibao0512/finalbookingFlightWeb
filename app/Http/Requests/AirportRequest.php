<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AirportRequest extends FormRequest
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
            'location_id' => 'required',
            'code_no' => 'required | max:191 | unique:airports,code_no,'.$this->id,
            'name' => 'required | max:191 | unique:airports,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'location_id.required' => 'Dữ liệu không thể để trống',
            'name.required' => 'Dữ liệu không thể để trống',
            'name.unique' => 'Dữ liệu đã bị trùng',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'code_no.required' => 'Dữ liệu không thể để trống',
            'code_no.unique' => 'Dữ liệu đã bị trùng',
            'code_no.max' => 'Vượt quá số ký tự cho phép',
        ];
    }
}
