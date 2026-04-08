<?php

namespace App\Services\Production;

use App\Models\Production\Bom;

/**
 * Class BomService
 *
 * Service for managing Bom resources.
 * Provides CRUD operations with JSON responses.
 */
class BomService
{
    /**
     * @var BomService
     */
    protected $bomService;

    /**
     * BomService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Bom records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->bomService->all();
    }

    /**
     * Display a paginated listing of Bom resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Bom resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Bom resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Bom resource in storage.
     *
     * @param BomRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Bom resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
