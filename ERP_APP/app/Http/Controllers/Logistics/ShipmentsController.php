<?php

namespace App\Http\Controllers\Logistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logistics\ShipmentsRequest;
use App\Http\Resources\Logistics\ShipmentsResource;
use App\Services\Logistics\ShipmentsService;
use App\DTOs\Logistics\ShipmentsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShipmentsController extends Controller
{
    public function __construct(
        protected ShipmentsService $service
    ) {}

    public function index(ShipmentsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $shipments = $this->service->getShipments($perPage, $search, $filters);

        return ShipmentsResource::collection($shipments)
            ->additional([
                'success' => true,
                'message' => 'Shipments retrieved successfully'
            ]);
    }

    public function store(ShipmentsRequest $request): JsonResponse
    {
        $dto = ShipmentsDTO::fromRequest($request->validated());
        $shipment = $this->service->createShipment($dto);

        return response()->json([
            'success' => true,
            'message' => 'Shipment created successfully',
            'data' => new ShipmentsResource($shipment)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $shipment = $this->service->getShipmentById($id);

        if (!$shipment) {
            return response()->json(['success' => false, 'message' => 'Shipment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment retrieved successfully',
            'data' => new ShipmentsResource($shipment)
        ]);
    }

    public function update(ShipmentsRequest $request, int $id): JsonResponse
    {
        $dto = ShipmentsDTO::fromRequest($request->validated());
        $success = $this->service->updateShipment($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Shipment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteShipment($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Shipment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment deleted successfully'
        ]);
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $request->validate(['status' => 'required|string']);
        $success = $this->service->updateShipmentStatus($id, $request->status);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Shipment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Shipment status updated successfully'
        ]);
    }
}
