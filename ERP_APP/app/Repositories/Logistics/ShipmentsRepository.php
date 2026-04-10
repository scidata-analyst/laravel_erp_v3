<?php

namespace App\Repositories\Logistics;

use App\Models\Logistics\Shipments;

/**
 * Class ShipmentsRepository
 *
 * Repository for managing Shipments resources.
 * Provides CRUD operations with database queries.
 */
class ShipmentsRepository
{
    /**
     * @var Shipments
     */
    protected $model;

    /**
     * ShipmentsRepository constructor.
     *
     * @param Shipments $model
     */
    public function __construct(Shipments $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Shipments records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Shipments resources.
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
            $query->where('tracking_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Shipments resource in storage.
     *
     * @param array $data
     * @return \App\Models\Logistics\Shipments
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Shipments resource.
     *
     * @param int $id
     * @return \App\Models\Logistics\Shipments
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Shipments resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Logistics\Shipments
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Shipments resource from storage.
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