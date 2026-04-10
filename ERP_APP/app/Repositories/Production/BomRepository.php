<?php

namespace App\Repositories\Production;

use App\Models\Production\Bom;

/**
 * Class BomRepository
 *
 * Repository for managing Bom resources.
 * Provides CRUD operations with database queries.
 */
class BomRepository
{
    /**
     * @var Bom
     */
    protected $model;

    /**
     * BomRepository constructor.
     *
     * @param Bom $model
     */
    public function __construct(Bom $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Bom records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Bom resources.
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
     * Store a newly created Bom resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\Bom
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     * @return \App\Models\Production\Bom
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Bom resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Production\Bom
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Bom resource from storage.
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