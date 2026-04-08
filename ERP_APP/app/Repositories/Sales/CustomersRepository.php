<?php

namespace App\Repositories\Sales;

use App\Models\Sales\Customers;

/**
 * Class CustomersRepository
 *
 * Repository for managing Customers resources.
 * Provides CRUD operations with JSON responses.
 */
class CustomersRepository
{
    /**
     * @var CustomersRepository
     */
    protected $customersRepository;

    /**
     * CustomersRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Customers records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->customersRepository->all();
    }

    /**
     * Display a paginated listing of Customers resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Customers resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Customers resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Customers resource in storage.
     *
     * @param CustomersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Customers resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
