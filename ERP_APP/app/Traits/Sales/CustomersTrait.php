<?php

namespace App\Traits\Sales;

use App\Models\Sales\Customers;

/**
 * Class CustomersTrait
 *
 * Trait for managing Customers resources.
 * Provides CRUD operations with JSON responses.
 */
trait CustomersTrait
{
    /**
     * @var CustomersTrait
     */
    protected $customersTrait;

    /**
     * CustomersTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Customers records without pagination.
     *
     */
    public function all()
    {
        $data = $this->customersTrait->all();
    }

    /**
     * Display a paginated listing of Customers resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Customers resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Customers resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Customers resource in storage.
     *
     * @param CustomersRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Customers resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
