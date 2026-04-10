<?php

namespace App\Http\Requests\QualityControl;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Form request for validating QC Checklist data.
 *
 * Validates fields based on the QcChecklists model fillable attributes:
 * - product_batch_work_order: required, string, max 100
 * - inspector_id: required, exists in users table (foreign key relationship)
 * - inspection_type: required, string, max 50
 * - inspection_date: required, date
 * - sample_size: nullable, integer, min 1
 * - checklist_items_notes: nullable, string, max 1000
 * - status: nullable, string, max 50
 */
class QcChecklistsRequest extends FormRequest
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
        // Get the QC checklist ID for unique validation on updates
        $checklistId = $this->route('qc_checklist');

        return [
            // Product/Batch/Work Order: required, string, max 100 characters
            'product_batch_work_order' => ['required', 'string', 'max:100'],

            // Inspector: required, must exist in users table
            'inspector_id' => ['required', 'exists:App\Models\UsersRoles\User,id'],

            // Inspection type: required, string, max 50 characters (e.g., incoming, in_process, final)
            'inspection_type' => ['required', 'string', 'max:50'],

            // Inspection date: required, must be a valid date
            'inspection_date' => ['required', 'date'],

            // Sample size: optional, integer, must be at least 1
            'sample_size' => ['nullable', 'integer', 'min:1'],

            // Checklist items/notes: optional, string, max 1000 characters
            'checklist_items_notes' => ['nullable', 'string', 'max:1000'],

            // Status: optional, string, max 50 characters (e.g., pending, passed, failed)
            'status' => ['nullable', 'string', 'max:50'],
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
            'product_batch_work_order.required' => 'The product/batch/work order is required.',
            'product_batch_work_order.max' => 'Product/batch/work order must not exceed 100 characters.',
            'inspector_id.required' => 'Please select an inspector.',
            'inspector_id.exists' => 'The selected inspector does not exist.',
            'inspection_type.required' => 'The inspection type is required.',
            'inspection_type.max' => 'Inspection type must not exceed 50 characters.',
            'inspection_date.required' => 'The inspection date is required.',
            'inspection_date.date' => 'Please enter a valid date.',
            'sample_size.integer' => 'Sample size must be an integer.',
            'sample_size.min' => 'Sample size must be at least 1.',
            'checklist_items_notes.max' => 'Checklist items/notes must not exceed 1000 characters.',
            'status.max' => 'Status must not exceed 50 characters.',
        ];
    }
}
