<?php

namespace App\Constants\Reports;

use App\Models\Reports\BiDashboards;

/**
 * Class BiDashboardsConstant
 *
 * Constant for managing BiDashboards resources.
 * Provides CRUD operations with JSON responses.
 */
class BiDashboardsConstant
{
    /**
     * @var BiDashboardsConstant
     */
    protected $biDashboardsConstant;

    /**
     * BiDashboardsConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->biDashboardsConstant->all();
    }

    /**
     * Display a paginated listing of BiDashboards resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created BiDashboards resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param BiDashboardsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
