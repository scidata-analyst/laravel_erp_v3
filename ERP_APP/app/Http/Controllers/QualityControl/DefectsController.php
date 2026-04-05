<?php

namespace App\Http\Controllers\QualityControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualityControl\DefectsRequest;
use App\Http\Resources\QualityControl\DefectsResource;
use App\Services\QualityControl\DefectsService;
use App\DTOs\QualityControl\DefectsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DefectsController extends Controller
{
    public function __construct(
        protected DefectsService $service
    ) {}

    public function index(DefectsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $defects = $this->service->getDefects($perPage, $search, $filters);

        return DefectsResource::collection($defects)
            ->additional([
                'success' => true,
                'message' => 'Defects retrieved successfully'
            ]);
    }

    public function store(DefectsRequest $request): JsonResponse
    {
        $dto = DefectsDTO::fromRequest($request->validated());
        $defect = $this->service->reportDefect($dto);

        return response()->json([
            'success' => true,
            'message' => 'Defect reported successfully',
            'data' => new DefectsResource($defect)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $defect = $this->service->getDefectById($id);
        if (!$defect) {
            return response()->json(['success' => false, 'message' => 'Defect not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Defect retrieved successfully',
            'data' => new DefectsResource($defect)
        ]);
    }

    public function update(DefectsRequest $request, int $id): JsonResponse
    {
        $dto = DefectsDTO::fromRequest($request->validated());
        $success = $this->service->updateDefect($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Defect not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Defect updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteDefect($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Defect not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Defect deleted successfully']);
    }

    public function resolve(Request $request, int $id): JsonResponse
    {
        $request->validate(['resolution' => 'required|string']);
        $success = $this->service->resolveDefect($id, $request->resolution);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Defect not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Defect resolved successfully'
        ]);
    }
}
