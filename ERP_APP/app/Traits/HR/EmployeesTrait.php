<?php

namespace App\Traits\HR;

use App\Models\HR\Employees;

/**
 * Class EmployeesTrait
 *
 * Trait for managing Employees resources.
 * Provides CRUD operations with JSON responses.
 */
trait EmployeesTrait
{
    /**
     * @var EmployeesTrait
     */
    protected $employeesTrait;

    /**
     * EmployeesTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Employees records without pagination.
     *
     */
    public function all()
    {
        $data = $this->employeesTrait->all();
    }

    /**
     * Display a paginated listing of Employees resources.
     *
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Employees resource in storage.
     *
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Employees resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Employees resource in storage.
     *
     * @param EmployeesRequest $request
     * @param int $id
     */
    public function update(array $data, $id)
    {
        
    }

    /**
     * Remove the specified Employees resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        
    }
}
