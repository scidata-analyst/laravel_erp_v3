<?php

namespace App\Constants\Logistics;

use App\Models\Logistics\Routes;

/**
 * Class RoutesConstant
 *
 * Constant for managing Routes resources.
 * Provides CRUD operations with JSON responses.
 */
class RoutesConstant
{
    /**
     * @var RoutesConstant
     */
    protected $routesConstant;

    /**
     * RoutesConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Routes records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->routesConstant->all();
    }

    /**
     * Display a paginated listing of Routes resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Routes resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Routes resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Routes resource in storage.
     *
     * @param RoutesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Routes resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
