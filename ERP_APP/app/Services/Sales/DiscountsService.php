<?php

namespace App\Services\Sales;

use App\Interfaces\Sales\DiscountsInterface;
use App\DTOs\Sales\DiscountsDTO;
use App\Models\Sales\Discounts;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DiscountsService
{
    public function __construct(
        protected DiscountsInterface $repository
    ) {}

    public function getDiscounts(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createDiscount(DiscountsDTO $dto): Discounts
    {
        return $this->repository->create($dto->toArray());
    }

    public function getDiscountById(int $id): ?Discounts
    {
        return $this->repository->read($id);
    }

    public function updateDiscount(int $id, DiscountsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteDiscount(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function validateDiscount(string $code, float $orderAmount): array
    {
        $discount = $this->repository->findByCode($code);
        if (!$discount) {
            return ['valid' => false, 'message' => 'Invalid discount code'];
        }

        if ($discount->status !== 'active') {
            return ['valid' => false, 'message' => 'Discount code is inactive'];
        }

        if ($discount->start_date && now()->lt($discount->start_date)) {
            return ['valid' => false, 'message' => 'Discount code is not yet active'];
        }

        if ($discount->end_date && now()->gt($discount->end_date)) {
            return ['valid' => false, 'message' => 'Discount code has expired'];
        }

        return ['valid' => true, 'discount' => $discount];
    }
}
