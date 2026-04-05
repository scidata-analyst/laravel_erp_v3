<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\Core\DashboardRequest;
use App\Http\Resources\Core\DashboardResource;
use App\Services\Core\DashboardService;
use App\DTOs\Core\DashboardDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $service
    ) {}

    public function index(DashboardRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $metrics = $this->service->getMetrics($perPage, $search, $filters);

        return DashboardResource::collection($metrics)
            ->additional([
                'success' => true,
                'message' => 'Dashboard metrics retrieved successfully'
            ]);
    }

    public function store(DashboardRequest $request): JsonResponse
    {
        $dto = DashboardDTO::fromRequest($request->validated());
        $metric = $this->service->logMetric($dto);

        return response()->json([
            'success' => true,
            'message' => 'Metric logged successfully',
            'data' => new DashboardResource($metric)
        ], 201);
    }

    public function stats(): JsonResponse
    {
        $stats = $this->service->getLatestStats();

        return response()->json([
            'success' => true,
            'message' => 'Latest stats retrieved successfully',
            'data' => DashboardResource::collection($stats)
        ]);
    }
}
