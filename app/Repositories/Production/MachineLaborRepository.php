<?php

namespace App\Repositories\Production;

use App\Models\Production\MachineLabor;
use App\Interfaces\Production\MachineLaborInterface;

/**
 * Class MachineLaborRepository
 *
 * Repository for managing MachineLabor resources.
 * Provides CRUD operations with database queries.
 */
class MachineLaborRepository implements MachineLaborInterface
{
    /**
     * @var MachineLabor
     */
    protected $model;

    /**
     * MachineLaborRepository constructor.
     *
     * @param MachineLabor $model
     */
    public function __construct(MachineLabor $model)
    {
        $this->model = $model;
    }

    /**
     * Display all MachineLabor records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of MachineLabor resources.
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
     * Store a newly created MachineLabor resource in storage.
     *
     * @param array $data
     * @return \App\Models\Production\MachineLabor
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified MachineLabor resource.
     *
     * @param int $id
     * @return \App\Models\Production\MachineLabor
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified MachineLabor resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Production\MachineLabor
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified MachineLabor resource from storage.
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