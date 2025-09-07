<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'package_type_id' => 'required|exists:package_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1',
            'available_slots' => 'required|integer|min:0|lte:capacity',
            'inclusions' => 'nullable|array',
            'exclusions' => 'nullable|array',
            'status' => 'required|in:active,inactive,completed',
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
            'package_type_id.required' => 'Package type is required.',
            'package_type_id.exists' => 'Selected package type is invalid.',
            'name.required' => 'Package name is required.',
            'price.required' => 'Package price is required.',
            'price.numeric' => 'Package price must be a valid number.',
            'end_date.after' => 'End date must be after start date.',
            'available_slots.lte' => 'Available slots cannot exceed capacity.',
        ];
    }
}