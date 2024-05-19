<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookTicketRequest extends FormRequest
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
            'name_contact' => 'required | max:191',
            'phone_contact' => 'required|regex:/^0[0-9]{9}$/',
            'email_contact' => ['nullable', 'email'],
            'adult_genders.*' => 'required',
            'adult_names.*' => 'required',
            'adult_cards.*' => 'required',
            'adult_birthday.*' => 'required',
            'baby_genders.*' => 'required',
            'baby_names.*' => 'required',
            'baby_birthday.*' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_contact.required' => 'Data cannot be empty',
            'name_contact.max' => 'Exceeded the allowed number of characters',

            'phone_contact.required' => 'no Emtpy',
            'phone_contact.regex' => 'Invalid format allowed',
            'email_contact.email' => 'Invalid format allowed',


        ];
    }
}
