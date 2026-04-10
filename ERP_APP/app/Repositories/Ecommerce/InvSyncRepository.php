<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\InvSync;

/**
 * Class InvSyncRepository
 *
 * Repository for managing InvSync resources.
 * Provides CRUD operations with database queries.
 */
class InvSyncRepository
{
    /**
     * @var InvSync
     */
    protected $model;

    /**
     * InvSyncRepository constructor.
     *
     * @param InvSync $model
     */
    public function __construct(InvSync $model)
    {
        $this->model = $model;
    }

    /**
     * Display all InvSync records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of InvSync resources.
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
            $query->where('channel_name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created InvSync resource in storage.
     *
     * @param array $data
     * @return \App\Models\Ecommerce\InvSync
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     * @return \App\Models\Ecommerce\InvSync
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Ecommerce\InvSync
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified InvSync resource from storage.
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