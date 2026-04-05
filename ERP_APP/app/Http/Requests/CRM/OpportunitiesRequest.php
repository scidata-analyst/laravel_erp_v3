<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

class OpportunitiesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'opportunity_name' => 'required|string|max:255',
            'lead_id' => 'required|integer|exists:leads,id',
            'amount' => 'required|numeric|min:0',
            'stage' => 'required|string|in:Discovery,Proposal,Negotiation,Won,Lost',
            'probability' => 'required|numeric|min:0|max:100',
            'expected_close_date' => 'nullable|date',
        ];
    }
}
