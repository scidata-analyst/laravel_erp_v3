<?php

namespace App\Repositories\QualityControl;

use App\Models\QualityControl\Compliance;

/**
 * Class ComplianceRepository
 *
 * Repository for managing Compliance resources.
 * Provides CRUD operations with database queries.
 */
class ComplianceRepository
{
    /**
     * @var Compliance
     */
    protected $model;

    /**
     * ComplianceRepository constructor.
     *
     * @param Compliance $model
     */
    public function __construct(Compliance $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Compliance records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Compliance resources.
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
     * Store a newly created Compliance resource in storage.
     *
     * @param array $data
     * @return \App\Models\QualityControl\Compliance
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     * @return \App\Models\QualityControl\Compliance
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Compliance resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\QualityControl\Compliance
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Compliance resource from storage.
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