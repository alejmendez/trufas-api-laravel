<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantRequest extends FormRequest
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
            'name' => 'required|max:250',
            'type' => 'required|max:250',
            'age' => 'required|max:250',
            'location' => 'required|max:250',
            'location_xy' => 'required|max:250',
            'planned_at' => 'required|max:250',
            'manager' => 'required|max:250',
            'code' => 'required|max:250',
        ];
    }
}
