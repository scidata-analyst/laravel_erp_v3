<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Requests\Production\WorkOrdersRequest;
use App\Http\Resources\Production\WorkOrdersResource;
use App\Services\Production\WorkOrdersService;
use App\DTOs\Production\WorkOrdersDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WorkOrdersController extends Controller
{
    public function __construct(
        protected WorkOrdersService $service
    ) {}

    public function index(WorkOrdersRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $workOrders = $this->service->getWorkOrders($perPage, $search, $filters);

        return WorkOrdersResource::collection($workOrders)
            ->additional([
                'success' => true,
                'message' => 'Work orders retrieved successfully'
            ]);
    }

    public function store(WorkOrdersRequest $request): JsonResponse
    {
        $dto = WorkOrdersDTO::fromRequest($request->validated());
        $workOrder = $this->service->createWorkOrder($dto);

        return response()->json([
            'success' => true,
            'message' => 'Work order created successfully',
            'data' => new WorkOrdersResource($workOrder)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $workOrder = $this->service->getWorkOrderById($id);
        if (!$workOrder) {
            return response()->json(['success' => false, 'message' => 'Work order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Work order retrieved successfully',
            'data' => new WorkOrdersResource($workOrder)
        ]);
    }

    public function update(WorkOrdersRequest $request, int $id): JsonResponse
    {
        $dto = WorkOrdersDTO::fromRequest($request->validated());
        $success = $this->service->updateWorkOrder($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Work order not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Work order updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteWorkOrder($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Work order not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Work order deleted successfully']);
    }

    public function updateProgress(Request $request, int $id): JsonResponse
    {
        $request->validate([
            'produced_qty' => 'required|integer|min:0',
            'scrap_qty' => 'required|integer|min:0'
        ]);

        $success = $this->service->updateWorkOrderProgress($id, $request->produced_qty, $request->scrap_qty);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Work order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Work order progress updated successfully'
        ]);
    }
}
