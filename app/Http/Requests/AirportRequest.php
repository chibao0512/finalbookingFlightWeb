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
            'location_id.required' => 'Data cannot be empty',
            'name.required' => 'Data cannot be empty',
            'name.unique' => 'Data has been duplicated',
            'name.max' => 'Exceeded the allowed number of characters',
            'code_no.required' => 'Data cannot be empty',
            'code_no.unique' => 'Data has been duplicated',
            'code_no.max' => 'Exceeded the allowed number of characters',
        ];
    }
}
