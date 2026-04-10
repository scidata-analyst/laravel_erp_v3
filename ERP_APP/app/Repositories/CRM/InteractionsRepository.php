<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Interactions;

/**
 * Class InteractionsRepository
 *
 * Repository for managing Interactions resources.
 * Provides CRUD operations with database queries.
 */
class InteractionsRepository
{
    /**
     * @var Interactions
     */
    protected $model;

    /**
     * InteractionsRepository constructor.
     *
     * @param Interactions $model
     */
    public function __construct(Interactions $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Interactions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Interactions resources.
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
            $query->where('subject', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Interactions resource in storage.
     *
     * @param array $data
     * @return \App\Models\CRM\Interactions
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     * @return \App\Models\CRM\Interactions
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\CRM\Interactions
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Interactions resource from storage.
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