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
            'name.required' => 'Data cannot be empty',
            'name.unique' => 'Data has been duplicated',
            'name.max' => 'Exceeded the allowed number of characters',
            'category_id.required' => 'Data cannot be empty',
            'description.max' => 'Exceeded the allowed number of characters',
            'images.image' => 'Please enter the correct image file format',
            'images.mimes' => 'Please enter the correct image file format',
        ];
    }
}
