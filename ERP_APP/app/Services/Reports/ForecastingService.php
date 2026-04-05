<?php

namespace App\Services\Reports;

use App\Interfaces\Reports\ForecastingInterface;
use App\DTOs\Reports\ForecastingDTO;
use App\Models\Reports\Forecasting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ForecastingService
{
    public function __construct(
        protected ForecastingInterface $repository
    ) {}

    public function getForecasts(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function setupForecast(ForecastingDTO $dto): Forecasting
    {
        return $this->repository->create($dto->toArray());
    }

    public function getForecastById(int $id): ?Forecasting
    {
        return $this->repository->read($id);
    }

    public function generateForecast(int $id): bool
    {
        return $this->repository->runForecast($id);
    }

    public function updateForecast(int $id, ForecastingDTO $dto): bool
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function deleteForecast(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
