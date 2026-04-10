<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Document.
 */
class DocLibraryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_name' => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:50'],
            'related_to' => ['required', 'string', 'max:100'],
            'version' => ['required', 'string', 'max:20'],
            'access_level' => ['required', 'string', 'max:20'],
            'file_path' => ['required', 'string', 'max:500'],
            'notes' => ['nullable', 'string'],
            'uploaded_by_user_id' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_name.required' => 'The document name is required.',
            'document_type.required' => 'The document type is required.',
            'related_to.required' => 'The related module is required.',
            'version.required' => 'The version is required.',
            'access_level.required' => 'The access level is required.',
            'file_path.required' => 'The file path is required.',
        ];
    }
}