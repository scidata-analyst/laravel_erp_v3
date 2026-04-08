<?php

namespace App\Services\Ecommerce;

use App\Models\Ecommerce\Pos;

/**
 * Class PosService
 *
 * Service for managing Pos resources.
 * Provides CRUD operations with JSON responses.
 */
class PosService
{
    /**
     * @var PosService
     */
    protected $posService;

    /**
     * PosService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Pos records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->posService->all();
    }

    /**
     * Display a paginated listing of Pos resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Pos resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Pos resource in storage.
     *
     * @param PosRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
