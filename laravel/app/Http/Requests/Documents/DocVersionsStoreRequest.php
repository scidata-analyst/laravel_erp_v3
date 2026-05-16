<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for creating a new Document Version.
 */
class DocVersionsStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => ['required', 'integer', 'exists:document_library,id'],
            'new_version' => ['required', 'string', 'max:20'],
            'change_type' => ['required', 'string', 'max:50'],
            'change_summary' => ['required', 'string'],
            'changed_by_user_id' => ['nullable', 'integer'],
            'approver_id' => ['nullable', 'integer'],
            'file_path' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.required' => 'The document is required.',
            'document_id.exists' => 'The selected document is invalid.',
            'new_version.required' => 'The version is required.',
            'change_type.required' => 'The change type is required.',
            'change_summary.required' => 'The change summary is required.',
            'file_path.required' => 'The file path is required.',
        ];
    }
}