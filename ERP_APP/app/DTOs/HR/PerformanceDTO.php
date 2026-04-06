<?php

namespace App\DTOs\HR;

class PerformanceDTO
{
    public readonly int $employee_id;
    public readonly string $review_date;
    public readonly ?string $reviewer;
    public readonly ?int $reviewer_id;
    public readonly string $overall_rating;
    public readonly ?string $reviewer_comments;
    public readonly ?string $status;

    public function __construct(array $data)
    {
        $this->employee_id = (int)($data['employee_id'] ?? 0);
        $this->review_date = $data['review_date'] ?? '';
        $this->reviewer = $data['reviewer'] ?? null;
        $this->reviewer_id = isset($data['reviewer_id']) ? (int)$data['reviewer_id'] : null;
        $this->overall_rating = (string)($data['overall_rating'] ?? $data['rating'] ?? '');
        $this->reviewer_comments = $data['reviewer_comments'] ?? $data['comments'] ?? null;
        $this->status = strtolower((string)($data['status'] ?? 'completed'));
    }
}