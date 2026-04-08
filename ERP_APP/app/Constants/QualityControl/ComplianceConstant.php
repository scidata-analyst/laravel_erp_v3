<?php

namespace App\Constants\QualityControl;

use App\Models\QualityControl\Compliance;

/**
 * Class ComplianceConstant
 *
 * Constant for managing Compliance resources.
 * Provides CRUD operations with JSON responses.
 */
class ComplianceConstant
{
    /**
     * @var ComplianceConstant
     */
    protected $complianceConstant;

    /**
     * ComplianceConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Compliance records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->complianceConstant->all();
    }

    /**
     * Display a paginated listing of Compliance resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Compliance resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Compliance resource in storage.
     *
     * @param ComplianceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Compliance resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
