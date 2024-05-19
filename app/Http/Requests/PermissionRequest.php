<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => 'required | max:191 | unique:permissions,name,'.$this->id,
            'description' => ['nullable', 'max:150'],
            'group_permission_id' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter a permission name',
            'name.unique' => 'Permission names cannot be the same',
            'name.max' => 'The permission name exceeds the allowed number of characters',
            'description.max' => 'Description exceeds the allowed number of characters',
            'group_permission_id.required' => 'Please select a permission group',
        ];
    }
}
