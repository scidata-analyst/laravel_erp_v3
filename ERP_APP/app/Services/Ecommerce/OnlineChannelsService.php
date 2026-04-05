<?php

namespace App\Services\Ecommerce;

use App\Interfaces\Ecommerce\OnlineChannelsInterface;
use App\DTOs\Ecommerce\OnlineChannelsDTO;
use App\Models\Ecommerce\OnlineChannels;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class OnlineChannelsService
{
    public function __construct(
        protected OnlineChannelsInterface $repository
    ) {}

    public function getChannels(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function addChannel(OnlineChannelsDTO $dto): OnlineChannels
    {
        return $this->repository->create($dto->toArray());
    }

    public function getChannelById(int $id): ?OnlineChannels
    {
        return $this->repository->read($id);
    }

    public function getActiveSalesChannels(): Collection
    {
        return $this->repository->getActiveChannels();
    }

    public function updateChannel(int $id, OnlineChannelsDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteChannel(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
