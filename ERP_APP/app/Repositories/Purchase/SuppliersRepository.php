<?php

namespace App\Repositories\Purchase;

use App\Models\Purchase\Suppliers;

/**
 * Class SuppliersRepository
 *
 * Repository for managing Suppliers resources.
 * Provides CRUD operations with JSON responses.
 */
class SuppliersRepository
{
    /**
     * @var SuppliersRepository
     */
    protected $suppliersRepository;

    /**
     * SuppliersRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Suppliers records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->suppliersRepository->all();
    }

    /**
     * Display a paginated listing of Suppliers resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Suppliers resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param SuppliersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
