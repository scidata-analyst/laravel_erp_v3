<?php

namespace App\Repositories\Reports;

use App\Interfaces\Reports\ForecastingInterface;
use App\Models\Reports\Forecasting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ForecastingRepository implements ForecastingInterface
{
    public function all(): Collection
    {
        return Forecasting::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Forecasting::paginate($perPage);
    }

    public function create(array $data): Forecasting
    {
        return Forecasting::create($data);
    }

    public function read(int $id): ?Forecasting
    {
        return Forecasting::find($id);
    }

    public function update(int $id, array $data): bool
    {
        $forecast = $this->read($id);
        return $forecast ? $forecast->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $forecast = $this->read($id);
        return $forecast ? $forecast->delete() : false;
    }

    public function getByType(string $type): Collection
    {
        return Forecasting::where('forecast_type', $type)->get();
    }

    public function runForecast(int $id): bool
    {
        $forecast = $this->read($id);
        if (!$forecast) return false;

        // Mocking forecast run (in real world, this would call an AI/ML service)
        return $forecast->update([
            'status' => 'Completed',
            'last_run_at' => now(),
            'forecast_results' => [
                'predicted_value' => rand(10000, 50000),
                'confidence_score' => 0.85
            ]
        ]);
    }
}