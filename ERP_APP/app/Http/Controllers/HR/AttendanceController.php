<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\AttendanceService;
use App\Http\Requests\HR\AttendanceStoreRequest;
use App\Http\Requests\HR\AttendanceUpdateRequest;
use App\Http\Resources\HR\AttendanceResource;
use App\Http\Controllers\Controller;

/**
 * Class AttendanceController
 *
 * Controller for managing Attendance resources.
 * Provides CRUD operations with JSON responses.
 */
class AttendanceController extends Controller
{
    /**
     * @var AttendanceService
     */
    protected $attendanceService;

    /**
     * AttendanceController constructor.
     *
     * @param AttendanceService $attendanceService
     */
    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    /**
     * Display all Attendance records without pagination.
     *
     */
    public function all()
    {
        $data = $this->attendanceService->all();

        return response()->json([
            "success" => true,
            "message" => "All Attendance records fetched successfully",
            "data" => AttendanceResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Attendance resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->attendanceService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Attendance records fetched successfully",
            "data" => AttendanceResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Attendance resource in storage.
     *
     * @param AttendanceStoreRequest $request
     */
    public function store(AttendanceStoreRequest $request)
    {
        $data = $this->attendanceService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Attendance record created successfully",
            "data" => new AttendanceResource($data)
        ], 201);
    }

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->attendanceService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Attendance record fetched successfully",
            "data" => new AttendanceResource($data)
        ]);
    }

    /**
     * Update the specified Attendance resource in storage.
     *
     * @param AttendanceUpdateRequest $request
     * @param int $id
     */
    public function update(AttendanceUpdateRequest $request, $id)
    {
        $data = $this->attendanceService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Attendance record updated successfully",
            "data" => new AttendanceResource($data)
        ]);
    }

    /**
     * Remove the specified Attendance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->attendanceService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Attendance record deleted successfully"
        ]);
    }
}
