<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'login' => ['required', 'min:3', 'unique:users,login'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'same:password'],
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'birthDate' => ['required', 'date:Y-m-d'],
        ];
    }
}
