<?php

namespace App\Http\Requests\Documents;

use Illuminate\Foundation\Http\FormRequest;

class DocLibraryRequest extends FormRequest
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
                'category' => 'nullable|string',
                'status' => 'nullable|string|in:Draft,Active,Archived',
                'search' => 'nullable|string'
            ];
        }

        return [
            'title' => 'required_without_all:name,document_name,file_name|string|max:255',
            'name' => 'required_without_all:title,document_name,file_name|string|max:255',
            'document_name' => 'required_without_all:title,name,file_name|string|max:255',
            'file_name' => 'nullable|string|max:255',
            'file_type' => 'required|string|max:100',
            'file_path' => 'required',
            'file_size' => 'nullable|integer|min:0',
            'category' => 'nullable|string',
            'version' => 'nullable|string|max:50',
            'uploaded_by' => 'nullable|integer',
            'description' => 'nullable|string',
            'notes' => 'nullable|string',
            'status' => 'nullable|string|max:50',
        ];
    }
}
