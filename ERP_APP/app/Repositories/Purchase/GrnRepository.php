<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\Grn;

/**
 * Class GrnRepository
 *
 * Repository for managing Grn resources.
 * Provides CRUD operations with database queries.
 */
class GrnRepository
{
    /**
     * @var Grn
     */
    protected $model;

    /**
     * GrnRepository constructor.
     *
     * @param Grn $model
     */
    public function __construct(Grn $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Grn records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Grn resources.
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
            $query->where('grn_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Grn resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\Grn
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\Grn
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\Grn
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Grn resource from storage.
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