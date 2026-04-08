<?php

namespace App\Constants\HR;

use App\Models\HR\Employees;

/**
 * Class EmployeesConstant
 *
 * Constant for managing Employees resources.
 * Provides CRUD operations with JSON responses.
 */
class EmployeesConstant
{
    /**
     * @var EmployeesConstant
     */
    protected $employeesConstant;

    /**
     * EmployeesConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Employees records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->employeesConstant->all();
    }

    /**
     * Display a paginated listing of Employees resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Employees resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Employees resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Employees resource in storage.
     *
     * @param EmployeesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Employees resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
