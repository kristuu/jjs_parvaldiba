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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'person_code' => ['required', 'string', 'min:11', 'max:11'],
            'name' => ['required', 'string', 'max:60'],
            'surname' => ['required', 'string', 'max:60'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', 'email', 'unique:users'],
//            'password' => 'required|string|max:255',
            'phone' => ['required', 'integer', 'min_digits:8', 'max_digits:8'],
            'iban_code' => ['required', 'string', 'max:64']
        ];
    }
}
