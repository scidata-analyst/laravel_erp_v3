<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\Defects;

/**
 * Class DefectsRepository
 *
 * Repository for managing Defects resources.
 * Provides CRUD operations with database queries.
 */
class DefectsRepository
{
    /**
     * @var Defects
     */
    protected $model;

    /**
     * DefectsRepository constructor.
     *
     * @param Defects $model
     */
    public function __construct(Defects $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Defects records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Defects resources.
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
            $query->where('description', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Defects resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\Defects
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Defects resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\Defects
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Defects resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\Defects
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Defects resource from storage.
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