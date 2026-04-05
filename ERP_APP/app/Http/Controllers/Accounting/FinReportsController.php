<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\FinReportsRequest;
use App\Http\Resources\Accounting\FinReportsResource;
use App\Services\Accounting\FinReportsService;
use App\DTOs\Accounting\FinReportsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FinReportsController extends Controller
{
    public function __construct(
        protected FinReportsService $service
    ) {}

    public function index(FinReportsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $reports = $this->service->getReports($perPage, $search, $filters);

        return FinReportsResource::collection($reports)
            ->additional([
                'success' => true,
                'message' => 'Financial reports retrieved successfully'
            ]);
    }

    public function store(FinReportsRequest $request): JsonResponse
    {
        $dto = FinReportsDTO::fromRequest($request->validated());
        $report = $this->service->generateReport($dto);

        return response()->json([
            'success' => true,
            'message' => 'Financial report generated successfully',
            'data' => new FinReportsResource($report)
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
            'message' => 'Financial report retrieved successfully',
            'data' => new FinReportsResource($report)
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteReport($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Report not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Financial report deleted successfully']);
    }
}
