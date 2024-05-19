<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlaneRequest extends FormRequest
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
            'name' => 'required | max:191 | unique:planes,name,'.$this->id,
            'airline_company_id' => 'required',
            'number_seats' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Data cannot be empty',
            'name.unique' => 'Data has been duplicated',
            'name.max' => 'Exceeded the allowed number of characters',
            'code_no.required' => 'Data cannot be empty',
            'code_no.unique' => 'Data has been duplicated',
            'code_no.max' => 'Exceeded the allowed number of characters',
            'airline_company_id.required' => 'Data cannot be empty',
            'number_seats.required' => 'Data cannot be empty',
        ];
    }
}
