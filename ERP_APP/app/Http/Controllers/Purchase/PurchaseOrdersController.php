<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\PurchaseOrdersRequest;
use App\Http\Resources\Purchase\PurchaseOrdersResource;
use App\Services\Purchase\PurchaseOrdersService;
use App\DTOs\Purchase\PurchaseOrdersDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PurchaseOrdersController extends Controller
{
    public function __construct(
        protected PurchaseOrdersService $service
    ) {}

    public function index(PurchaseOrdersRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $orders = $this->service->getOrders($perPage, $search, $filters);

        return PurchaseOrdersResource::collection($orders)
            ->additional([
                'success' => true,
                'message' => 'Purchase orders retrieved successfully'
            ]);
    }

    public function store(PurchaseOrdersRequest $request): JsonResponse
    {
        $dto = PurchaseOrdersDTO::fromRequest($request->validated());
        $order = $this->service->createOrder($dto);

        return response()->json([
            'success' => true,
            'message' => 'Purchase order created successfully',
            'data' => new PurchaseOrdersResource($order)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $order = $this->service->getOrderById($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Purchase order retrieved successfully',
            'data' => new PurchaseOrdersResource($order)
        ]);
    }

    public function update(PurchaseOrdersRequest $request, int $id): JsonResponse
    {
        $dto = PurchaseOrdersDTO::fromRequest($request->validated());
        $order = $this->service->updateOrder($id, $dto);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Purchase order updated successfully',
            'data' => new PurchaseOrdersResource($order)
        ]);
    }

    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $status = $request->validate(['status' => 'required|string'])['status'];
        $success = $this->service->updateOrderStatus($id, $status);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);
    }

    public function receive(int $id): JsonResponse
    {
        $this->service->receiveOrder($id);

        return response()->json([
            'success' => true,
            'message' => 'Order marked as received successfully'
        ]);
    }
}
