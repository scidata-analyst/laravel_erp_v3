<?php

namespace App\Repositories\Reports;

use App\Models\Reports\Forecasting;
use App\Interfaces\Reports\ForecastingInterface;

/**
 * Class ForecastingRepository
 *
 * Repository for managing Forecasting resources.
 * Provides CRUD operations with database queries.
 */
class ForecastingRepository implements ForecastingInterface
{
    /**
     * @var Forecasting
     */
    protected $model;

    /**
     * ForecastingRepository constructor.
     *
     * @param Forecasting $model
     */
    public function __construct(Forecasting $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Forecasting records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Forecasting resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        $query = $this->model->query();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Forecasting resource in storage.
     *
     * @param array $data
     * @return \App\Models\Reports\Forecasting
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     * @return \App\Models\Reports\Forecasting
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Reports\Forecasting
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        $record = $this->model->findOrFail($id);
        return $record->delete();
    }
}