<?php

namespace App\Http\Requests\Documents;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating Document Library data.
 *
 * Validates fields based on the DocLibrary model fillable attributes:
 * - document_name: required, string, max 255
 * - document_type: nullable, string, max 100
 * - related_to: nullable, string, max 100
 * - version: nullable, string, max 20
 * - access_level: nullable, string, max 50
 * - file_path: nullable, string, max 500
 * - notes: nullable, string, max 500
 * - uploaded_by_user_id: nullable, exists in users table (foreign key relationship)
 */
class DocLibraryRequest extends FormRequest
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
        // Get the document ID for unique validation on updates
        $docId = $this->route('doc_library');

        return [
            // Document name: required, string, max 255 characters
            'document_name' => ['required', 'string', 'max:255'],

            // Document type: optional, string, max 100 characters (e.g., pdf, excel, word)
            'document_type' => ['nullable', 'string', 'max:100'],

            // Related to: optional, string, max 100 characters (e.g., project, product)
            'related_to' => ['nullable', 'string', 'max:100'],

            // Version: optional, string, max 20 characters (e.g., v1.0, v2.1)
            'version' => ['nullable', 'string', 'max:20'],

            // Access level: optional, string, max 50 characters (e.g., public, private, restricted)
            'access_level' => ['nullable', 'string', 'max:50'],

            // File path: optional, string, max 500 characters
            'file_path' => ['nullable', 'string', 'max:500'],

            // Notes: optional, string, max 500 characters
            'notes' => ['nullable', 'string', 'max:500'],

            // Uploaded by user: optional, must exist in users table
            'uploaded_by_user_id' => ['nullable', 'exists:App\Models\UsersRoles\User,id'],
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
            'document_name.required' => 'The document name is required.',
            'document_name.max' => 'Document name must not exceed 255 characters.',
            'document_type.max' => 'Document type must not exceed 100 characters.',
            'related_to.max' => 'Related to must not exceed 100 characters.',
            'version.max' => 'Version must not exceed 20 characters.',
            'access_level.max' => 'Access level must not exceed 50 characters.',
            'file_path.max' => 'File path must not exceed 500 characters.',
            'notes.max' => 'Notes must not exceed 500 characters.',
            'uploaded_by_user_id.exists' => 'The selected user does not exist.',
        ];
    }
}
