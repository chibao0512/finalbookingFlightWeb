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
            'code_no.required' => 'Data cannot be empty',
            'code_no.unique' => 'Data has been duplicated',
            'code_no.max' => 'Exceeded the allowed number of characters',
            'plane_id.required' => 'Data cannot be empty',
            'start_location_id.required' => 'Data cannot be empty',
            'start_airport_id.required' => 'Data cannot be empty',
            'end_location_id.required' => 'Data cannot be empty',
            'end_airport_id.required' => 'Data cannot be empty',
            'start_day.required' => 'Data cannot be empty',
            'end_day.required' => 'Data cannot be empty',
            'price.required' => 'Data cannot be empty',
            'price_vip.required' => 'Data cannot be empty',
            'status.required' => 'Data cannot be empty',
            'end_day.after' => 'Return date must be greater than departure date',
        ];
    }
}
