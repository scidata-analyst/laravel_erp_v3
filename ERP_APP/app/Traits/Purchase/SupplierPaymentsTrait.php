<?php

namespace App\Traits\Purchase;

use App\Models\Purchase\SupplierPayments;

/**
 * Class SupplierPaymentsTrait
 *
 * Trait for managing SupplierPayments resources.
 * Provides CRUD operations with JSON responses.
 */
trait SupplierPaymentsTrait
{
    /**
     * @var SupplierPaymentsTrait
     */
    protected $supplierPaymentsTrait;

    /**
     * SupplierPaymentsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all SupplierPayments records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->supplierPaymentsTrait->all();
    }

    /**
     * Display a paginated listing of SupplierPayments resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created SupplierPayments resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified SupplierPayments resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified SupplierPayments resource in storage.
     *
     * @param SupplierPaymentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified SupplierPayments resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
