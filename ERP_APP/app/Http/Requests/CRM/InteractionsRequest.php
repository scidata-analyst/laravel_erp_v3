<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class InteractionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('get')) {
            return [
                'per_page' => 'nullable|integer|min:1|max:100',
                'lead_id' => 'nullable|exists:leads,id',
                'interaction_type' => 'nullable|in:Call,Email,Meeting,Note,Follow-up'
            ];
        }

        return [
            'lead_id' => 'required|exists:leads,id',
            'interaction_type' => 'required|in:Call,Email,Meeting,Note,Follow-up',
            'interaction_date' => 'required|date',
            'subject' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'next_action' => 'nullable|string|max:500',
            'next_action_date' => 'nullable|date',
            'assigned_to' => 'nullable|exists:users,id',
            'status' => 'required|in:completed,pending,scheduled'
        ];
    }

    public function messages(): array
    {
        return [
            'lead_id.required' => 'Lead ID is required',
            'lead_id.exists' => 'Selected lead does not exist',
            'interaction_type.required' => 'Interaction type is required',
            'interaction_type.in' => 'Interaction type must be one of: Call, Email, Meeting, Note, Follow-up',
            'interaction_date.required' => 'Interaction date is required',
            'interaction_date.date' => 'Interaction date must be a valid date',
            'subject.required' => 'Subject is required',
            'description.required' => 'Description is required',
            'next_action_date.date' => 'Next action date must be a valid date',
            'status.required' => 'Status is required',
            'status.in' => 'Status must be one of: completed, pending, scheduled'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }
}
