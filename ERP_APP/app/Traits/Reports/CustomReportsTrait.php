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
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->customReportsTrait->all();
    }

    /**
     * Display a paginated listing of CustomReports resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created CustomReports resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param CustomReportsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
