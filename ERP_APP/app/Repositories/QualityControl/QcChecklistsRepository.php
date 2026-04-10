<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\QcChecklists;
use App\Interfaces\QualityControl\QcChecklistsInterface;

/**
 * Class QcChecklistsRepository
 *
 * Repository for managing QcChecklists resources.
 * Provides CRUD operations with database queries.
 */
class QcChecklistsRepository implements QcChecklistsInterface
{
    /**
     * @var QcChecklists
     */
    protected $model;

    /**
     * QcChecklistsRepository constructor.
     *
     * @param QcChecklists $model
     */
    public function __construct(QcChecklists $model)
    {
        $this->model = $model;
    }

    /**
     * Display all QcChecklists records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of QcChecklists resources.
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
     * Store a newly created QcChecklists resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified QcChecklists resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified QcChecklists resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\QcChecklists
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified QcChecklists resource from storage.
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