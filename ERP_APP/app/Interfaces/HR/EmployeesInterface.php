<?php

namespace App\Interfaces\HR;


/**
 * Class EmployeesInterface
 *
 * Interface for managing Employees resources.
 * Provides CRUD operations with JSON responses.
 */
interface EmployeesInterface
{
    /**
     * Display all Employees records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Employees resources.
     *
     */
    public function index();

    /**
     * Store a newly created Employees resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Employees resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Employees resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Employees resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
