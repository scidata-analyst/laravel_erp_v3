<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\CustomReportsRequest;
use App\Http\Resources\Reports\CustomReportsResource;
use App\Services\Reports\CustomReportsService;
use App\DTOs\Reports\CustomReportsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomReportsController extends Controller
{
    public function __construct(
        protected CustomReportsService $service
    ) {}

    public function index(CustomReportsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $reports = $this->service->getReports($perPage, $search, $filters);

        return CustomReportsResource::collection($reports)
            ->additional([
                'success' => true,
                'message' => 'Custom reports retrieved successfully'
            ]);
    }

    public function store(CustomReportsRequest $request): JsonResponse
    {
        $dto = CustomReportsDTO::fromRequest($request->validated());
        $report = $this->service->createReport($dto);

        return response()->json([
            'success' => true,
            'message' => 'Custom report created successfully',
            'data' => new CustomReportsResource($report)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $report = $this->service->getReportById($id);
        if (!$report) {
            return response()->json(['success' => false, 'message' => 'Report not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Custom report retrieved successfully',
            'data' => new CustomReportsResource($report)
        ]);
    }

    public function update(CustomReportsRequest $request, int $id): JsonResponse
    {
        $dto = CustomReportsDTO::fromRequest($request->validated());
        $success = $this->service->updateReport($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Report not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Custom report updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteReport($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Report not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Custom report deleted successfully'
        ]);
    }
}
