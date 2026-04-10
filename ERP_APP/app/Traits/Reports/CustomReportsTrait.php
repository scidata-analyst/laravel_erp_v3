<?php

namespace App\Traits\Reports;

use App\Models\Reports\CustomReports;

/**
 * Class CustomReportsTrait
 *
 * Trait for managing CustomReports resources.
 * Provides CRUD operations with JSON responses.
 */
trait CustomReportsTrait
{
    /**
     * @var CustomReportsTrait
     */
    protected $customReportsTrait;

    /**
     * CustomReportsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all CustomReports records without pagination.
     *
     */
    public function all()
    {
        $data = $this->customReportsTrait->all();
    }

    /**
     * Display a paginated listing of CustomReports resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created CustomReports resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param CustomReportsRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
