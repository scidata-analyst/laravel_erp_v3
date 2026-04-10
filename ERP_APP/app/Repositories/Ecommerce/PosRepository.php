<?php

namespace App\Repositories\Ecommerce;

use App\Models\Ecommerce\Pos;

/**
 * Class PosRepository
 *
 * Repository for managing Pos resources.
 * Provides CRUD operations with database queries.
 */
class PosRepository
{
    /**
     * @var Pos
     */
    protected $model;

    /**
     * PosRepository constructor.
     *
     * @param Pos $model
     */
    public function __construct(Pos $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Pos records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Pos resources.
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
     * Store a newly created Pos resource in storage.
     *
     * @param array $data
     * @return \App\Models\Ecommerce\Pos
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     * @return \App\Models\Ecommerce\Pos
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Pos resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Ecommerce\Pos
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Pos resource from storage.
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