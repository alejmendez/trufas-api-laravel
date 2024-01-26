<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:250',
            'last_name' => 'required|min:3|max:250',
            'email' => 'required|email|unique:users,email',
            'dni' => 'required|min:8|max:12',
            'phone' => 'required|min:11|max:20',
            'password' => ['required', Password::min(6)],
        ];
    }
}
