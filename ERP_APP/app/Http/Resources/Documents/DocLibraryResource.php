<?php

namespace App\Http\Resources\Documents;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocLibraryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'name' => $this->name,
            'document_name' => $this->title,
            'file_type' => $this->file_type,
            'file_path' => $this->file_path,
            'file_size' => $this->file_size,
            'category' => $this->category,
            'version' => $this->version,
            'description' => $this->description,
            'notes' => $this->notes,
            'uploaded_by' => $this->uploaded_by,
            'status' => $this->status,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
