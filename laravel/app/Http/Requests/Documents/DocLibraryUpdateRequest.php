<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Document.
 */
class DocLibraryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_name' => ['sometimes', 'string', 'max:255'],
            'document_type' => ['sometimes', 'string', 'max:50'],
            'related_to' => ['sometimes', 'string', 'max:100'],
            'version' => ['sometimes', 'string', 'max:20'],
            'access_level' => ['sometimes', 'string', 'max:20'],
            'file_path' => ['sometimes', 'string', 'max:500'],
            'notes' => ['nullable', 'string'],
            'uploaded_by_user_id' => ['nullable', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [];
    }
}