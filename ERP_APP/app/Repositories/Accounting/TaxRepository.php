<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\Tax;

/**
 * Class TaxRepository
 *
 * Repository for managing Tax resources.
 * Provides CRUD operations with database queries.
 */
class TaxRepository
{
    /**
     * @var Tax
     */
    protected $model;

    /**
     * TaxRepository constructor.
     *
     * @param Tax $model
     */
    public function __construct(Tax $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Tax records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Tax resources.
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
     * Store a newly created Tax resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\Tax
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Tax resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\Tax
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Tax resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\Tax
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Tax resource from storage.
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