<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'person_code' => ['required', 'string', 'min:11', 'max:11'],
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['required', 'string', 'max:60'],
            'birthdate' => ['required', 'date'],
            'phone' => ['required', 'integer', 'min_digits:8', 'max_digits:8'],
            'iban_code' => ['required', 'string', 'max:64']
        ];

        if ($this->method() == 'PUT') {
            $rules['email'] = [
                'required',
                'email'
            ];
        } else {
            $rules['email'] = ['required', 'email', 'unique:users'];
        }

        return $rules;
    }

}
