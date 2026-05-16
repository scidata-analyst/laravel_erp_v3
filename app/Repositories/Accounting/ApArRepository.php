<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\ApAr;
use App\Interfaces\Accounting\ApArInterface;

/**
 * Class ApArRepository
 *
 * Repository for managing ApAr resources.
 * Provides CRUD operations with database queries.
 */
class ApArRepository implements ApArInterface
{
    /**
     * @var ApAr
     */
    protected $model;

    /**
     * ApArRepository constructor.
     *
     * @param ApAr $model
     */
    public function __construct(ApAr $model)
    {
        $this->model = $model;
    }

    /**
     * Display all ApAr records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of ApAr resources.
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
            $query->where('party_name', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created ApAr resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\ApAr
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified ApAr resource from storage.
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
