<?php

namespace App\Constants\Accounting;

use App\Models\Accounting\FinReports;

/**
 * Class FinReportsConstant
 *
 * Constant for managing FinReports resources.
 * Provides CRUD operations with JSON responses.
 */
class FinReportsConstant
{
    /**
     * @var FinReportsConstant
     */
    protected $finReportsConstant;

    /**
     * FinReportsConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all FinReports records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->finReportsConstant->all();
    }

    /**
     * Display a paginated listing of FinReports resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created FinReports resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified FinReports resource in storage.
     *
     * @param FinReportsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified FinReports resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
