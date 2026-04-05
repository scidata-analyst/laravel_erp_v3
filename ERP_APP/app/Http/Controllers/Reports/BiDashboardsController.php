<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\BiDashboardsRequest;
use App\Http\Resources\Reports\BiDashboardsResource;
use App\Services\Reports\BiDashboardsService;
use App\DTOs\Reports\BiDashboardsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BiDashboardsController extends Controller
{
    public function __construct(
        protected BiDashboardsService $service
    ) {}

    public function index(BiDashboardsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $dashboards = $this->service->getDashboards($perPage, $search, $filters);

        return BiDashboardsResource::collection($dashboards)
            ->additional([
                'success' => true,
                'message' => 'BI Dashboards retrieved successfully'
            ]);
    }

    public function store(BiDashboardsRequest $request): JsonResponse
    {
        $dto = BiDashboardsDTO::fromRequest($request->validated());
        $dashboard = $this->service->createDashboard($dto);

        return response()->json([
            'success' => true,
            'message' => 'BI Dashboard created successfully',
            'data' => new BiDashboardsResource($dashboard)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $dashboard = $this->service->getDashboardById($id);

        if (!$dashboard) {
            return response()->json(['success' => false, 'message' => 'Dashboard not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'BI Dashboard retrieved successfully',
            'data' => new BiDashboardsResource($dashboard)
        ]);
    }

    public function update(BiDashboardsRequest $request, int $id): JsonResponse
    {
        $dto = BiDashboardsDTO::fromRequest($request->validated());
        $success = $this->service->updateDashboard($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Dashboard not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'BI Dashboard updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteDashboard($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Dashboard not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'BI Dashboard deleted successfully'
        ]);
    }

    public function userDashboards(Request $request): JsonResponse
    {
        $userId = $request->user()->id;
        $dashboards = $this->service->getDashboardsForUser($userId);

        return response()->json([
            'success' => true,
            'message' => 'User dashboards retrieved successfully',
            'data' => BiDashboardsResource::collection($dashboards)
        ]);
    }
}
