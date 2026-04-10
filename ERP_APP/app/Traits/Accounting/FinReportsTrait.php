<?php

namespace App\Traits\Accounting;

use App\Models\Accounting\FinReports;

/**
 * Class FinReportsTrait
 *
 * Trait for managing FinReports resources.
 * Provides CRUD operations with JSON responses.
 */
trait FinReportsTrait
{
    /**
     * @var FinReportsTrait
     */
    protected $finReportsTrait;

    /**
     * FinReportsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all FinReports records without pagination.
     *
     */
    public function all()
    {
        $data = $this->finReportsTrait->all();
    }

    /**
     * Display a paginated listing of FinReports resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created FinReports resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified FinReports resource in storage.
     *
     * @param FinReportsRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified FinReports resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
