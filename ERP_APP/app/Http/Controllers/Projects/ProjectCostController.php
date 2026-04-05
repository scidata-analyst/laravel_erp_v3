<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ProjectCostRequest;
use App\Http\Resources\Projects\ProjectCostResource;
use App\Services\Projects\ProjectCostService;
use App\DTOs\Projects\ProjectCostDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProjectCostController extends Controller
{
    public function __construct(
        protected ProjectCostService $service
    ) {}

    public function index(ProjectCostRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $costs = $this->service->getProjectCosts($perPage, $search, $filters);

        return ProjectCostResource::collection($costs)
            ->additional([
                'success' => true,
                'message' => 'Project costs retrieved successfully'
            ]);
    }

    public function store(ProjectCostRequest $request): JsonResponse
    {
        $dto = ProjectCostDTO::fromRequest($request->validated());
        $cost = $this->service->addCost($dto);

        return response()->json([
            'success' => true,
            'message' => 'Project cost added successfully',
            'data' => new ProjectCostResource($cost)
        ], 201);
    }

    public function approve(int $id): JsonResponse
    {
        $success = $this->service->approveCost($id, auth()->id());

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Project cost not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project cost approved successfully'
        ]);
    }

    public function summary(int $projectId): JsonResponse
    {
        $summary = $this->service->getCostSummary($projectId);

        return response()->json([
            'success' => true,
            'message' => 'Project cost summary retrieved successfully',
            'data' => $summary
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $cost = $this->service->getCostById($id);
        if (!$cost) {
            return response()->json(['success' => false, 'message' => 'Project cost not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Project cost retrieved successfully',
            'data' => new ProjectCostResource($cost)
        ]);
    }

    public function update(ProjectCostRequest $request, int $id): JsonResponse
    {
        $dto = ProjectCostDTO::fromRequest($request->validated());
        $success = $this->service->updateCost($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Project cost not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Project cost updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteCost($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Project cost not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Project cost deleted successfully']);
    }
}
