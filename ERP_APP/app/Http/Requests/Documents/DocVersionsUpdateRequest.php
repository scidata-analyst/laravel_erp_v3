<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for updating an existing Document Version.
 */
class DocVersionsUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_id' => ['sometimes', 'integer', 'exists:document_library,id'],
            'new_version' => ['sometimes', 'string', 'max:20'],
            'change_type' => ['sometimes', 'string', 'max:50'],
            'change_summary' => ['sometimes', 'string'],
            'changed_by_user_id' => ['nullable', 'integer'],
            'approver_id' => ['nullable', 'integer'],
            'file_path' => ['sometimes', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'document_id.exists' => 'The selected document is invalid.',
        ];
    }
}