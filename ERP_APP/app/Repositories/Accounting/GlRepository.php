<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\Gl;
use App\Interfaces\Accounting\GlInterface;

/**
 * Class GlRepository
 *
 * Repository for managing Gl resources.
 * Provides CRUD operations with database queries.
 */
class GlRepository implements GlInterface
{
    /**
     * @var Gl
     */
    protected $model;

    /**
     * GlRepository constructor.
     *
     * @param Gl $model
     */
    public function __construct(Gl $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Gl records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Gl resources.
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
     * Store a newly created Gl resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\Gl
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\Gl
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Gl resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\Gl
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Gl resource from storage.
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