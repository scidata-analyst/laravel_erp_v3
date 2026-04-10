<?php

namespace App\Traits\Reports;

use App\Models\Reports\BiDashboards;

/**
 * Class BiDashboardsTrait
 *
 * Trait for managing BiDashboards resources.
 * Provides CRUD operations with JSON responses.
 */
trait BiDashboardsTrait
{
    /**
     * @var BiDashboardsTrait
     */
    protected $biDashboardsTrait;

    /**
     * BiDashboardsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     */
    public function all()
    {
        $data = $this->biDashboardsTrait->all();
    }

    /**
     * Display a paginated listing of BiDashboards resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created BiDashboards resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param BiDashboardsRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
