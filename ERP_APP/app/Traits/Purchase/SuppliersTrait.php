<?php

namespace App\Traits\Purchase;

use App\Models\Purchase\Suppliers;

/**
 * Class SuppliersTrait
 *
 * Trait for managing Suppliers resources.
 * Provides CRUD operations with JSON responses.
 */
trait SuppliersTrait
{
    /**
     * @var SuppliersTrait
     */
    protected $suppliersTrait;

    /**
     * SuppliersTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Suppliers records without pagination.
     *
     */
    public function all()
    {
        $data = $this->suppliersTrait->all();
    }

    /**
     * Display a paginated listing of Suppliers resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Suppliers resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param SuppliersRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
