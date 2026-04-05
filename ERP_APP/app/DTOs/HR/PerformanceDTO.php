<?php

namespace App\DTOs\HR;

class PerformanceDTO
{
    public function __construct(
        public readonly int $employee_id,
        public readonly string $review_date,
        public readonly ?string $reviewer = null,
        public readonly ?int $reviewer_id = null,
        public readonly string $overall_rating = '',
        public readonly ?string $reviewer_comments = null,
        public readonly ?string $status = 'completed',
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            employee_id: (int) $data['employee_id'],
            review_date: $data['review_date'],
            reviewer: $data['reviewer'] ?? null,
            reviewer_id: isset($data['reviewer_id']) ? (int) $data['reviewer_id'] : null,
            overall_rating: (string) ($data['overall_rating'] ?? $data['rating']),
            reviewer_comments: $data['reviewer_comments'] ?? $data['comments'] ?? null,
            status: $data['status'] ?? 'completed',
        );
    }

    public function toArray(): array
    {
        return [
            'employee_id' => $this->employee_id,
            'review_date' => $this->review_date,
            'reviewer' => $this->reviewer,
            'reviewer_id' => $this->reviewer_id,
            'overall_rating' => $this->overall_rating,
            'reviewer_comments' => $this->reviewer_comments,
            'status' => $this->status,
        ];
    }
}
