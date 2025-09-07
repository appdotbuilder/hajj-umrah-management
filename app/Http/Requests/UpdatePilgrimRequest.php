<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePilgrimRequest extends FormRequest
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
        $pilgrim = $this->route('pilgrim');
        
        return [
            'full_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('pilgrims', 'email')->ignore($pilgrim->id)
            ],
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'passport_number' => [
                'required',
                'string',
                Rule::unique('pilgrims', 'passport_number')->ignore($pilgrim->id)
            ],
            'passport_expiry' => 'required|date|after:today',
            'nationality' => 'required|string|max:100',
            'address' => 'required|string',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            'medical_conditions' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Full name is required.',
            'email.required' => 'Email address is required.',
            'email.unique' => 'This email is already registered to another pilgrim.',
            'passport_number.required' => 'Passport number is required.',
            'passport_number.unique' => 'This passport number is already registered to another pilgrim.',
            'passport_expiry.after' => 'Passport expiry date must be in the future.',
            'birth_date.before' => 'Birth date must be in the past.',
        ];
    }
}