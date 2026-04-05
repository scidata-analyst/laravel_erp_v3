<?php

namespace App\Http\Resources\QualityControl;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComplianceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'report_number' => $this->report_number,
            'compliance_type' => $this->compliance_type,
            'standard_reference' => $this->standard_reference,
            'standard_name' => $this->standard_reference,
            'version' => $this->compliance_type,
            'audit_date' => $this->audit_date,
            'auditor_id' => $this->auditor_id,
            'findings' => $this->findings,
            'risk_level' => $this->risk_level,
            'corrective_actions' => $this->corrective_actions,
            'due_date' => $this->due_date,
            'expiry_date' => $this->due_date,
            'completion_date' => $this->completion_date,
            'status' => match ($this->status) {
                'completed' => 'Compliant',
                'in_progress' => 'Non-Compliant',
                default => 'Pending',
            },
            'notes' => $this->notes,
            'description' => $this->notes,
            'risk' => $this->risk_level,
            'attachments' => $this->attachments,
            'auditor' => new \App\Http\Resources\HR\EmployeesResource($this->whenLoaded('auditor')),
            'related_defects' => DefectsResource::collection($this->whenLoaded('relatedDefects')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
