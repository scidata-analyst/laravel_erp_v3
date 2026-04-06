<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

class OnlineChannelsRepository
{
    public function all()
    {
        return OnlineChannels::query()->get();
    }

    public function find(int $id)
    {
        return OnlineChannels::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return OnlineChannels::query()->create($data);
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
