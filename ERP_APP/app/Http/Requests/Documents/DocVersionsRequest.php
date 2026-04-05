<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class DocVersionsRequest extends FormRequest
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
                'doc_library_id' => 'nullable|integer|exists:doc_libraries,id',
                'search' => 'nullable|string'
            ];
        }

        return [
            'doc_library_id' => 'required_without:document_id|integer|exists:doc_libraries,id',
            'document_id' => 'required_without:doc_library_id|integer|exists:doc_libraries,id',
            'version_number' => 'required|string',
            'change_type' => 'nullable|string|max:100',
            'file_path' => 'required',
            'file_size' => 'nullable|integer|min:0',
            'changes_description' => 'nullable|string',
            'changes' => 'nullable|string',
            'change_log' => 'nullable|string',
            'created_by' => 'nullable|integer',
            'approved_by' => 'nullable|integer',
        ];
    }
}
