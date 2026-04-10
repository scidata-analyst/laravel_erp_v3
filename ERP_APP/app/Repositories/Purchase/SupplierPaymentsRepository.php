<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\SupplierPayments;

/**
 * Class SupplierPaymentsRepository
 *
 * Repository for managing SupplierPayments resources.
 * Provides CRUD operations with database queries.
 */
class SupplierPaymentsRepository
{
    /**
     * @var SupplierPayments
     */
    protected $model;

    /**
     * SupplierPaymentsRepository constructor.
     *
     * @param SupplierPayments $model
     */
    public function __construct(SupplierPayments $model)
    {
        $this->model = $model;
    }

    /**
     * Display all SupplierPayments records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Display a paginated listing of SupplierPayments resources.
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
            $query->where('payment_number', 'like', "%{$search}%");
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a newly created SupplierPayments resource in storage.
     *
     * @param array $data
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Display the specified SupplierPayments resource.
     *
     * @param int $id
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function show($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update the specified SupplierPayments resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Purchase\SupplierPayments
     */
    public function update($id, array $data)
    {
        $record = $this->model->findOrFail($id);
        $record->update($data);
        return $record;
    }

    /**
     * Remove the specified SupplierPayments resource from storage.
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