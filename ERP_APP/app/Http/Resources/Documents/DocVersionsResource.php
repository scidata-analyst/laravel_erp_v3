<?php

namespace App\Http\Resources\Documents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocVersionsResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'doc_library_id' => $this->doc_library_id,
            'document_id' => $this->document_id,
            'version_number' => $this->version_number,
            'change_type' => $this->change_type,
            'file_path' => $this->file_path,
            'file_size' => $this->file_size,
            'changes_description' => $this->changes_description,
            'changes' => $this->changes,
            'change_log' => $this->changes,
            'is_current' => $this->is_current,
            'approval_status' => $this->approval_status,
            'created_by' => $this->created_by,
            'approved_by' => $this->approved_by,
            'approval_date' => $this->approval_date,
            'document' => new DocLibraryResource($this->whenLoaded('document')),
            'created_by_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('createdBy')),
            'approved_by_user' => new \App\Http\Resources\UsersRoles\UsersResource($this->whenLoaded('approvedBy')),
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
