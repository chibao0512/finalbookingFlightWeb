<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransportRequest extends FormRequest
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
            'flight_id' => 'required',
            'transport_id' => 'required',
            'transport_key' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'flight_id.required' => 'Data cannot be empty',
            'transport_id.required' => 'Data cannot be empty',
            'transport_key.required' => 'Data cannot be empty',
        ];
    }
}
