<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Promotions;

/**
 * Class PromotionsRepository
 *
 * Repository for managing Promotions resources.
 * Provides CRUD operations with database queries.
 */
class PromotionsRepository
{
    /**
     * @var Promotions
     */
    protected $model;

    /**
     * PromotionsRepository constructor.
     *
     * @param Promotions $model
     */
    public function __construct(Promotions $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Promotions records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Promotions resources.
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
     * Store a newly created Promotions resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\Promotions
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Promotions resource.
     *
     * @param int $id
     * @return \App\Models\Sales\Promotions
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Promotions resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Sales\Promotions
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Promotions resource from storage.
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