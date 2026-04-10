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
     */
    public function all()
    {
        $data = $this->invoicesTrait->all();
    }

    /**
     * Display a paginated listing of Invoices resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Invoices resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Invoices resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Invoices resource in storage.
     *
     * @param InvoicesRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Invoices resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
