<?php

namespace App\Repositories\Ecommerce;

use App\Interfaces\Ecommerce\OnlineChannelsInterface;
use App\Models\Ecommerce\OnlineChannels;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OnlineChannelsRepository implements OnlineChannelsInterface
{
    public function all(): Collection
    {
        return OnlineChannels::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return OnlineChannels::paginate($perPage);
    }

    public function create(array $data): OnlineChannels
    {
        return OnlineChannels::create($data);
    }

    public function read(int $id): ?OnlineChannels
    {
        return OnlineChannels::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $channel = $this->read($id);
        return $channel ? $channel->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $channel = $this->read($id);
        return $channel ? $channel->delete() : false;
    }

    public function getActiveChannels(): Collection
    {
        return OnlineChannels::where('status', 'Active')->get();
    }
}