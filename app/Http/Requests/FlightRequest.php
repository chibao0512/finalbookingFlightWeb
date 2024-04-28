<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightRequest extends FormRequest
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
            'code_no' => 'required | max:191 | unique:planes,code_no,'.$this->id,
            'plane_id' => 'required',
            'start_location_id' => 'required',
            'start_airport_id' => 'required',
            'end_location_id' => 'required',
            'end_airport_id' => 'required',
            'start_day' => 'required',
            'end_day' => 'required|after:start_day',
            'price' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code_no.required' => 'Dữ liệu không thể để trống',
            'code_no.unique' => 'Dữ liệu đã bị trùng',
            'code_no.max' => 'Vượt quá số ký tự cho phép',
            'plane_id.required' => 'Dữ liệu không thể để trống',
            'start_location_id.required' => 'Dữ liệu không thể để trống',
            'start_airport_id.required' => 'Dữ liệu không thể để trống',
            'end_location_id.required' => 'Dữ liệu không thể để trống',
            'end_airport_id.required' => 'Dữ liệu không thể để trống',
            'start_day.required' => 'Dữ liệu không thể để trống',
            'end_day.required' => 'Dữ liệu không thể để trống',
            'price.required' => 'Dữ liệu không thể để trống',
            'price_vip.required' => 'Dữ liệu không thể để trống',
            'status.required' => 'Dữ liệu không thể để trống',
            'end_day.after' => 'Ngày về phải lớn hơn ngày đi',
        ];
    }
}
