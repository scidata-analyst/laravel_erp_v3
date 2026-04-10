<?php

namespace App\Traits\Core;

use App\Models\Core\Dashboard;

/**
 * Class DashboardTrait
 *
 * Trait for managing Dashboard resources.
 * Provides CRUD operations with JSON responses.
 */
trait DashboardTrait
{
    /**
     * @var DashboardTrait
     */
    protected $dashboardTrait;

    /**
     * DashboardTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Dashboard records without pagination.
     *
     */
    public function all()
    {
        $data = $this->dashboardTrait->all();
    }

    /**
     * Display a paginated listing of Dashboard resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Dashboard resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param DashboardRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
