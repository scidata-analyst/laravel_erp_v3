<?php

namespace App\Traits\Sales;

use App\Models\Sales\SalesOrders;

/**
 * Class SalesOrdersTrait
 *
 * Trait for managing SalesOrders resources.
 * Provides CRUD operations with JSON responses.
 */
trait SalesOrdersTrait
{
    /**
     * @var SalesOrdersTrait
     */
    protected $salesOrdersTrait;

    /**
     * SalesOrdersTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all SalesOrders records without pagination.
     *
     */
    public function all()
    {
        $data = $this->salesOrdersTrait->all();
    }

    /**
     * Display a paginated listing of SalesOrders resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param SalesOrdersRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
