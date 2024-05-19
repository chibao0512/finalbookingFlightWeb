<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Lang;
use App\Rules\OldPermission;

class RolesRequest extends FormRequest
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
            'name' => 'required | max:150 | unique:roles,name,'.$this->id,
            'description' => ['nullable', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter role name',
            'name.unique' => 'Role name cannot be duplicated',
            'name.max' => 'Role name exceeds the allowed number of characters',
            'description.max' => 'Description exceeds the allowed number of characters',
        ];
    }
}
