<?php

namespace App\Repositories\Accounting;

use App\Models\Accounting\Tax;

/**
 * Class TaxRepository
 *
 * Repository for managing Tax resources.
 * Provides CRUD operations with JSON responses.
 */
class TaxRepository
{
    /**
     * @var TaxRepository
     */
    protected $taxRepository;

    /**
     * TaxRepository constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Tax records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->taxRepository->all();
    }

    /**
     * Display a paginated listing of Tax resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Tax resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Tax resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Tax resource in storage.
     *
     * @param TaxRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Tax resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
