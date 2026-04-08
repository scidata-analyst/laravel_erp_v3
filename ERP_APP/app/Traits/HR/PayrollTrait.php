<?php

namespace App\Traits\HR;

use App\Models\HR\Payroll;

/**
 * Class PayrollTrait
 *
 * Trait for managing Payroll resources.
 * Provides CRUD operations with JSON responses.
 */
trait PayrollTrait
{
    /**
     * @var PayrollTrait
     */
    protected $payrollTrait;

    /**
     * PayrollTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Payroll records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->payrollTrait->all();
    }

    /**
     * Display a paginated listing of Payroll resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Payroll resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Payroll resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Payroll resource in storage.
     *
     * @param PayrollRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Payroll resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
