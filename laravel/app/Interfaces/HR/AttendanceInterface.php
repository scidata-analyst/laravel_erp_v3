<?php

namespace App\Interfaces\HR;


/**
 * Class AttendanceInterface
 *
 * Interface for managing Attendance resources.
 * Provides CRUD operations with JSON responses.
 */
interface AttendanceInterface
{
    /**
     * Display all Attendance records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Attendance resources.
     *
     */
    public function index();

    /**
     * Store a newly created Attendance resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Attendance resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Attendance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
