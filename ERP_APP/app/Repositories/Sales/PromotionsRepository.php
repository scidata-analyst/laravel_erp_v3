<?php

namespace App\Repositories\Sales;

use App\Interfaces\Sales\PromotionsInterface;
use App\Models\Sales\Promotions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PromotionsRepository implements PromotionsInterface
{
    public function all(): Collection
    {
        return Promotions::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Promotions::paginate($perPage);
    }

    public function create(array $data): Promotions
    {
        return Promotions::create($data);
    }

    public function read(int $id): ?Promotions
    {
        return Promotions::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $promotion = $this->read($id);
        return $promotion ? $promotion->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $promotion = $this->read($id);
        return $promotion ? $promotion->delete() : false;
    }

    public function getActivePromotions(): Collection
    {
        return Promotions::where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();
    }
}