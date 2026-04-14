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

        return AttendanceResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All Attendance records fetched successfully',
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

        return view("hr.attendance", compact("data"));
    }

    /**
     * Store a newly created Attendance resource in storage.
     *
     * @param AttendanceStoreRequest $request
     */
    public function store(AttendanceStoreRequest $request)
    {
        $data = $this->attendanceService->store($request->validated());

        return (new AttendanceResource($data))->additional([
            'success' => true,
            'message' => 'Attendance record created successfully',
        ]);
    }

    /**
     * Display the specified Attendance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->attendanceService->show($id);

        return (new AttendanceResource($data))->additional([
            'success' => true,
            'message' => 'Attendance record fetched successfully',
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

        return (new AttendanceResource($data))->additional([
            'success' => true,
            'message' => 'Attendance record updated successfully',
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
