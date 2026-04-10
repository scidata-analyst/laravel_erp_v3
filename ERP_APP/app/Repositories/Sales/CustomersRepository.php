<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Customers;

/**
 * Class CustomersRepository
 *
 * Repository for managing Customers resources.
 * Provides CRUD operations with database queries.
 */
class CustomersRepository
{
    /**
     * @var Customers
     */
    protected $model;

    /**
     * CustomersRepository constructor.
     *
     * @param Customers $model
     */
    public function __construct(Customers $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Customers records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Customers resources.
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
     * Store a newly created Customers resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\Customers
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Customers resource.
     *
     * @param int $id
     * @return \App\Models\Sales\Customers
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Customers resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Sales\Customers
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Customers resource from storage.
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