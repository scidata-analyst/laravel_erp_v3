<?php

namespace App\Traits\HR;

use App\Services\HR\AttendanceService;

trait AttendanceTrait
{
    /**
     * @var AttendanceService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param AttendanceService $service
     * @return $this
     */
    public function setAttendanceService(AttendanceService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Attendance records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Attendance resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created Attendance resource in storage.
     *
     * @param array $data
     * @return \App\Models\HR\Attendance
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     * @return \App\Models\HR\Attendance
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Attendance resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\HR\Attendance
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Attendance resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}