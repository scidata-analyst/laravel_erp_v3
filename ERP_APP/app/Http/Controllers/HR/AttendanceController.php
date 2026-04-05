<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\HR\AttendanceRequest;
use App\Http\Resources\HR\AttendanceResource;
use App\Services\HR\AttendanceService;
use App\DTOs\HR\AttendanceDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AttendanceController extends Controller
{
    public function __construct(
        protected AttendanceService $service
    ) {}

    public function index(AttendanceRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $records = $this->service->getAttendanceRecords($perPage, $search, $filters);

        return AttendanceResource::collection($records)
            ->additional([
                'success' => true,
                'message' => 'Attendance records retrieved successfully'
            ]);
    }

    public function store(AttendanceRequest $request): JsonResponse
    {
        $dto = AttendanceDTO::fromRequest($request->validated());
        $record = $this->service->recordAttendance($dto);

        return response()->json([
            'success' => true,
            'message' => 'Attendance record created successfully',
            'data' => new AttendanceResource($record)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $record = $this->service->getAttendanceById($id);
        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Attendance record not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Attendance record retrieved successfully',
            'data' => new AttendanceResource($record)
        ]);
    }

    public function update(AttendanceRequest $request, int $id): JsonResponse
    {
        $dto = AttendanceDTO::fromRequest($request->validated());
        $success = $this->service->updateAttendance($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Attendance record not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Attendance record updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteAttendance($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Attendance record not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Attendance record deleted successfully']);
    }

    public function checkIn(Request $request): JsonResponse
    {
        $request->validate(['employee_id' => 'required|integer']);
        $record = $this->service->checkIn($request->employee_id);

        return response()->json([
            'success' => true,
            'message' => 'Check-in successful',
            'data' => new AttendanceResource($record)
        ]);
    }

    public function checkOut(Request $request): JsonResponse
    {
        $request->validate(['employee_id' => 'required|integer']);
        $this->service->checkOut($request->employee_id);

        return response()->json([
            'success' => true,
            'message' => 'Check-out successful'
        ]);
    }
}
