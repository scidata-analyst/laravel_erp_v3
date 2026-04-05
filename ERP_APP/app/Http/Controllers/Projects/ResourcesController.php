<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\ResourcesRequest;
use App\Http\Resources\Projects\ResourcesResource;
use App\Services\Projects\ResourcesService;
use App\DTOs\Projects\ResourcesDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ResourcesController extends Controller
{
    public function __construct(
        protected ResourcesService $service
    ) {}

    public function index(ResourcesRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $resources = $this->service->getResources($perPage, $search, $filters);

        return ResourcesResource::collection($resources)
            ->additional([
                'success' => true,
                'message' => 'Resources retrieved successfully'
            ]);
    }

    public function store(ResourcesRequest $request): JsonResponse
    {
        $dto = ResourcesDTO::fromRequest($request->validated());
        $resource = $this->service->allocateResource($dto);

        return response()->json([
            'success' => true,
            'message' => 'Resource allocated successfully',
            'data' => new ResourcesResource($resource)
        ], 201);
    }

    public function updateAllocation(Request $request, int $id): JsonResponse
    {
        $request->validate(['allocation' => 'required|integer|min:0|max:100']);
        $success = $this->service->updateAllocation($id, $request->allocation);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Resource allocation updated successfully'
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $resource = $this->service->getResourceById($id);
        if (!$resource) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Resource retrieved successfully',
            'data' => new ResourcesResource($resource)
        ]);
    }

    public function update(ResourcesRequest $request, int $id): JsonResponse
    {
        $dto = ResourcesDTO::fromRequest($request->validated());
        $success = $this->service->updateResource($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Resource updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteResource($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Resource not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Resource deleted successfully']);
    }
}
