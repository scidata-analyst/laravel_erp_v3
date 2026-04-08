<?php

namespace App\Services\Core;

use App\Models\Core\Dashboard;

/**
 * Class DashboardService
 *
 * Service for managing Dashboard resources.
 * Provides CRUD operations with JSON responses.
 */
class DashboardService
{
    /**
     * @var DashboardService
     */
    protected $dashboardService;

    /**
     * DashboardService constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Dashboard records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->dashboardService->all();
    }

    /**
     * Display a paginated listing of Dashboard resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Dashboard resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param DashboardRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
