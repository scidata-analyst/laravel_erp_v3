<?php

namespace App\Services\Sales;

use App\Interfaces\Sales\PromotionsInterface;
use App\DTOs\Sales\PromotionsDTO;
use App\Models\Sales\Promotions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PromotionsService
{
    public function __construct(
        protected PromotionsInterface $repository
    ) {}

    public function getPromotions(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function createPromotion(PromotionsDTO $dto): Promotions
    {
        return $this->repository->create($dto->toArray());
    }

    public function getPromotionById(int $id): ?Promotions
    {
        return $this->repository->read($id);
    }

    public function updatePromotion(int $id, PromotionsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deletePromotion(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getActivePromotions(): Collection
    {
        return $this->repository->getActivePromotions();
    }
}
