<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Leads;

/**
 * Class LeadsRepository
 *
 * Repository for managing Leads resources.
 * Provides CRUD operations with database queries.
 */
class LeadsRepository
{
    /**
     * @var Leads
     */
    protected $model;

    /**
     * LeadsRepository constructor.
     *
     * @param Leads $model
     */
    public function __construct(Leads $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Leads records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Leads resources.
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
     * Store a newly created Leads resource in storage.
     *
     * @param array $data
     * @return \App\Models\CRM\Leads
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Leads resource.
     *
     * @param int $id
     * @return \App\Models\CRM\Leads
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Leads resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\CRM\Leads
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Leads resource from storage.
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