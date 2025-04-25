<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => 'nullable|string|max:255',
            'surname' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'father_name' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
            'marital_status' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'agent_id' => 'nullable|integer',
            'university' => 'array',
            'start_date' => 'array',
            'end_date' => 'array',
            'experience_company' => 'array',
            'position' => 'array',
            'experience_start_date' => 'array',
            'experience_end_date' => 'array',
            'language' => 'array',
            'level' => 'array',
            'program_name' => 'array',
            'country' => 'array',
            'city' => 'array',
            'program_date' => 'array',
            'file' => 'array',
            'file_title' => 'array',
        ];
    }
}
