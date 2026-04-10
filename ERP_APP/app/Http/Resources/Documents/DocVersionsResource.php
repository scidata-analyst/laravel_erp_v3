<?php

namespace App\Http\Resources\Documents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocVersionsResource extends JsonResource
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
            'document_id' => $this->document_id,
            'new_version' => $this->new_version,
            'change_type' => $this->change_type,
            'change_summary' => $this->change_summary,
            'changed_by_user_id' => $this->changed_by_user_id,
            'approver_id' => $this->approver_id,
            'file_path' => $this->file_path,
            'created_at' => $this->created_at?->toIso8601String(),
            'updated_at' => $this->updated_at?->toIso8601String(),
        ];
    }
}
