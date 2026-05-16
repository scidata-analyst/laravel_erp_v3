<?php

namespace App\Http\Resources\QualityControl;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplianceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'standard_regulation' => $this->standard_regulation,
            'scope' => $this->scope,
            'audit_date' => $this->audit_date,
            'next_audit_date' => $this->next_audit_date,
            'auditor' => $this->auditor,
            'findings_notes' => $this->findings_notes,
            'status' => $this->status,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
