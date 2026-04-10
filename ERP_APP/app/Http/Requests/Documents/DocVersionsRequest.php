<?php

namespace App\Http\Requests\Documents;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Document Version data.
 *
 * Validates fields based on the DocVersions model fillable attributes:
 * - document_id: required, exists in document_library table (foreign key relationship)
 * - new_version: required, string, max 20
 * - change_type: nullable, string, max 50
 * - change_summary: nullable, string, max 500
 * - changed_by_user_id: nullable, exists in users table (foreign key relationship)
 * - approver_id: nullable, exists in users table (foreign key relationship)
 * - file_path: nullable, string, max 500
 */
class DocVersionsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Get the version ID for unique validation on updates
        $versionId = $this->route('doc_version');

        return [
            // Document: required, must exist in document_library table
            'document_id' => ['required', 'exists:App\Models\Documents\DocLibrary,id'],

            // New version: required, string, max 20 characters (e.g., v1.1, v2.0)
            'new_version' => ['required', 'string', 'max:20'],

            // Change type: optional, string, max 50 characters (e.g., major, minor, patch)
            'change_type' => ['nullable', 'string', 'max:50'],

            // Change summary: optional, string, max 500 characters
            'change_summary' => ['nullable', 'string', 'max:500'],

            // Changed by user: optional, must exist in users table
            'changed_by_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // Approver: optional, must exist in users table
            'approver_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],

            // File path: optional, string, max 500 characters
            'file_path' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'document_id.required' => 'Please select a document.',
            'document_id.exists' => 'The selected document does not exist.',
            'new_version.required' => 'The new version is required.',
            'new_version.max' => 'New version must not exceed 20 characters.',
            'change_type.max' => 'Change type must not exceed 50 characters.',
            'change_summary.max' => 'Change summary must not exceed 500 characters.',
            'changed_by_user_id.exists' => 'The selected user does not exist.',
            'approver_id.exists' => 'The selected approver does not exist.',
            'file_path.max' => 'File path must not exceed 500 characters.',
        ];
    }
}
