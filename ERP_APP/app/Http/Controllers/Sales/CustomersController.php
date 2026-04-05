<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\CustomersRequest;
use App\Http\Resources\Sales\CustomersResource;
use App\Services\Sales\CustomersService;
use App\DTOs\Sales\CustomersDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomersController extends Controller
{
    public function __construct(
        protected CustomersService $service
    ) {}

    public function index(CustomersRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $customers = $this->service->getCustomers($perPage, $search, $filters);

        return CustomersResource::collection($customers)
            ->additional([
                'success' => true,
                'message' => 'Customers retrieved successfully'
            ]);
    }

    public function store(CustomersRequest $request): JsonResponse
    {
        $dto = CustomersDTO::fromRequest($request->validated());
        $customer = $this->service->createCustomer($dto);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully',
            'data' => new CustomersResource($customer)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $customer = $this->service->getCustomerById($id);
        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Customer retrieved successfully',
            'data' => new CustomersResource($customer)
        ]);
    }

    public function update(CustomersRequest $request, int $id): JsonResponse
    {
        $dto = CustomersDTO::fromRequest($request->validated());
        $success = $this->service->updateCustomer($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Customer not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteCustomer($id);

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully'
        ]);
    }

    public function getStats(): JsonResponse
    {
        $stats = $this->service->getCustomerStats();

        return response()->json([
            'success' => true,
            'message' => 'Customer statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
