<?php

namespace App\Repositories\Reports;

use App\Models\Reports\Forecasting;

class ForecastingRepository
{
    public function all()
    {
        return Forecasting::query()->get();
    }

    public function find(int $id)
    {
        return Forecasting::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Forecasting::query()->create($data);
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
