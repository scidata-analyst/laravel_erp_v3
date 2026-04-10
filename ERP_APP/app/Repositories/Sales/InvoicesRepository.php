<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Invoices;
use App\Interfaces\Sales\InvoicesInterface;

/**
 * Class InvoicesRepository
 *
 * Repository for managing Invoices resources.
 * Provides CRUD operations with database queries.
 */
class InvoicesRepository implements InvoicesInterface
{
    /**
     * @var Invoices
     */
    protected $model;

    /**
     * InvoicesRepository constructor.
     *
     * @param Invoices $model
     */
    public function __construct(Invoices $model)
    {
        $this->model = $model;
    }

    /**
     * Display all Invoices records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of Invoices resources.
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
            $query->where('invoice_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created Invoices resource in storage.
     *
     * @param array $data
     * @return \App\Models\Sales\Invoices
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified Invoices resource.
     *
     * @param int $id
     * @return \App\Models\Sales\Invoices
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified Invoices resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Sales\Invoices
     */
    public function update(array $data, $id)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified Invoices resource from storage.
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