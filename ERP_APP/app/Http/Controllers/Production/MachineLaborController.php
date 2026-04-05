<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Requests\Production\MachineLaborRequest;
use App\Http\Resources\Production\MachineLaborResource;
use App\Services\Production\MachineLaborService;
use App\DTOs\Production\MachineLaborDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MachineLaborController extends Controller
{
    public function __construct(
        protected MachineLaborService $service
    ) {}

    public function index(MachineLaborRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $usage = $this->service->getResourceUsage($perPage, $search, $filters);

        return MachineLaborResource::collection($usage)
            ->additional([
                'success' => true,
                'message' => 'Resource usage retrieved successfully'
            ]);
    }

    public function store(MachineLaborRequest $request): JsonResponse
    {
        $dto = MachineLaborDTO::fromRequest($request->validated());
        $usage = $this->service->recordUsage($dto);

        return response()->json([
            'success' => true,
            'message' => 'Resource usage recorded successfully',
            'data' => new MachineLaborResource($usage)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $usage = $this->service->getUsageById($id);
        if (!$usage) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Resource usage retrieved successfully',
            'data' => new MachineLaborResource($usage)
        ]);
    }

    public function update(MachineLaborRequest $request, int $id): JsonResponse
    {
        $dto = MachineLaborDTO::fromRequest($request->validated());
        $success = $this->service->updateUsage($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Resource usage updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteUsage($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Resource usage deleted successfully']);
    }

    public function getCost(int $workOrderId): JsonResponse
    {
        $cost = $this->service->calculateTotalCost($workOrderId);

        return response()->json([
            'success' => true,
            'message' => 'Total cost calculated successfully',
            'data' => [
                'work_order_id' => $workOrderId,
                'total_cost' => $cost
            ]
        ]);
    }
}
