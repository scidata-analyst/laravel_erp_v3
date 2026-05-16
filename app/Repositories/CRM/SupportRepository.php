<?php

namespace App\Repositories\CRM;

use App\Models\CRM\Support;
use App\Interfaces\CRM\SupportInterface;

/**
 * Class SupportRepository
 *
 * Repository for managing Support resources.
 * Provides CRUD operations with database queries.
 */
class SupportRepository implements SupportInterface
{
    /**
     * @var Support
     */
    protected $model;

    /**
     * SupportRepository constructor.
     *
     * @param Support $model
     */
    public function __construct(Support $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Support records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Support resources.
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
     * Store a newly created Support resource in storage.
     *
     * @param array $data
     * @return \App\Models\CRM\Support
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     * @return \App\Models\CRM\Support
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\CRM\Support
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Support resource from storage.
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