<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'passport_number' => 'nullable|string|max:255',
            'identity_number' => 'nullable|string|max:255',
            'citizenship' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'mother_name' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'email' => 'nullable|unique:users,email',
            'password' => 'nullable',
            'agent_id' => 'nullable|integer',
            'image' => 'nullable'
        ];
    }
}
