<?php

namespace App\Traits\HR;

use App\Models\HR\Attendance;

/**
 * Class AttendanceTrait
 *
 * Trait for managing Attendance resources.
 * Provides CRUD operations with JSON responses.
 */
trait AttendanceTrait
{
    /**
     * @var AttendanceTrait
     */
    protected $attendanceTrait;

    /**
     * AttendanceTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Attendance records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->attendanceTrait->all();
    }

    /**
     * Display a paginated listing of Attendance resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Attendance resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Attendance resource in storage.
     *
     * @param AttendanceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Attendance resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
