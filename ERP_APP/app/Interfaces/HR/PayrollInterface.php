<?php

namespace App\Interfaces\HR;


/**
 * Class PayrollInterface
 *
 * Interface for managing Payroll resources.
 * Provides CRUD operations with JSON responses.
 */
interface PayrollInterface
{
    /**
     * Display all Payroll records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Payroll resources.
     *
     */
    public function index();

    /**
     * Store a newly created Payroll resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Payroll resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Payroll resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Payroll resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
