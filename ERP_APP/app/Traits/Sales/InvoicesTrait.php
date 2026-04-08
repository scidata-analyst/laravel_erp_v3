<?php

namespace App\Traits\Sales;

use App\Models\Sales\Invoices;

/**
 * Class InvoicesTrait
 *
 * Trait for managing Invoices resources.
 * Provides CRUD operations with JSON responses.
 */
trait InvoicesTrait
{
    /**
     * @var InvoicesTrait
     */
    protected $invoicesTrait;

    /**
     * InvoicesTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Invoices records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->invoicesTrait->all();
    }

    /**
     * Display a paginated listing of Invoices resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Invoices resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Invoices resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Invoices resource in storage.
     *
     * @param InvoicesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Invoices resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
