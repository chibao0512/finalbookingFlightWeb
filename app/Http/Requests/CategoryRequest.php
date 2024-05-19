<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required | max:191 | unique:categories,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Data cannot be empty',
            'name.unique' => 'Data has been duplicated',
            'name.max' => 'Exceeded the allowed number of characters',
        ];
    }
}
