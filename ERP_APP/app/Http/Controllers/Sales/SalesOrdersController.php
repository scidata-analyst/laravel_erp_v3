<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\SalesOrdersRequest;
use App\Http\Resources\Sales\SalesOrdersResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Sales\SalesOrdersService;
use App\DTOs\Sales\SalesOrdersDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SalesOrdersController extends Controller
{
    public function __construct(
        protected SalesOrdersService $service
    ) {}

    public function index(SalesOrdersRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $orders = $this->service->getOrders($perPage, $search, $filters);

        return SalesOrdersResource::collection($orders)
            ->additional([
                'success' => true,
                'message' => 'Sales orders retrieved successfully'
            ]);
    }

    public function store(SalesOrdersRequest $request): JsonResponse
    {
        $dto = SalesOrdersDTO::fromRequest($request->validated());
        $order = $this->service->createOrder($dto);

        return response()->json([
            'success' => true,
            'message' => 'Sales order created successfully',
            'data' => new SalesOrdersResource($order)
        ], 201);
    }

    public function update(SalesOrdersRequest $request, int $id): JsonResponse
    {
        $dto = SalesOrdersDTO::fromRequest($request->validated());
        $success = $this->service->updateOrder($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sales order updated successfully'
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $order = $this->service->getOrderById($id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Sales order retrieved successfully',
            'data' => new SalesOrdersResource($order)
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

    public function cancel(int $id): JsonResponse
    {
        $this->service->cancelOrder($id);

        return response()->json([
            'success' => true,
            'message' => 'Order cancelled successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteOrder($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Order not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order deleted successfully'
        ]);
    }
}
