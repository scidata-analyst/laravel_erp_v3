<?php

namespace App\Http\Controllers\Logistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logistics\WarehousesRequest;
use App\Http\Resources\Logistics\WarehousesResource;
use App\Services\Logistics\WarehousesService;
use App\DTOs\Logistics\WarehousesDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WarehousesController extends Controller
{
    public function __construct(
        protected WarehousesService $service
    ) {}

    public function index(WarehousesRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $warehouses = $this->service->getWarehouses($perPage, $search, $filters);

        return WarehousesResource::collection($warehouses)
            ->additional([
                'success' => true,
                'message' => 'Warehouses retrieved successfully'
            ]);
    }

    public function store(WarehousesRequest $request): JsonResponse
    {
        $dto = WarehousesDTO::fromRequest($request->validated());
        $warehouse = $this->service->createWarehouse($dto);

        return response()->json([
            'success' => true,
            'message' => 'Warehouse created successfully',
            'data' => new WarehousesResource($warehouse)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $warehouse = $this->service->getWarehouseById($id);
        if (!$warehouse) {
            return response()->json(['success' => false, 'message' => 'Warehouse not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Warehouse retrieved successfully',
            'data' => new WarehousesResource($warehouse)
        ]);
    }

    public function update(WarehousesRequest $request, int $id): JsonResponse
    {
        $dto = WarehousesDTO::fromRequest($request->validated());
        $success = $this->service->updateWarehouse($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Warehouse not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Warehouse updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteWarehouse($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Warehouse not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Warehouse deleted successfully'
        ]);
    }
}
