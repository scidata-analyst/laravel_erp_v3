<?php

namespace App\Services\Accounting;

use App\Models\Accounting\Tax;

/**
 * Class TaxService
 *
 * Service for managing Tax resources.
 * Provides CRUD operations with JSON responses.
 */
class TaxService
{
    /**
     * @var TaxService
     */
    protected $taxService;

    /**
     * TaxService constructor.
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
        $data = $this->taxService->all();
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
