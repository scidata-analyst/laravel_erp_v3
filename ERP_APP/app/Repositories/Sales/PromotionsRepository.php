<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Promotions;

class PromotionsRepository
{
    public function all()
    {
        return Promotions::query()->get();
    }

    public function find(int $id)
    {
        return Promotions::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Promotions::query()->create($data);
    }

    public function update(int $id, array $data)
    {
        $record = $this->find($id);
        $record->update($data);

        return $record->refresh();
    }

    public function delete(int $id): bool
    {
        return (bool) $this->find($id)->delete();
    }
}
