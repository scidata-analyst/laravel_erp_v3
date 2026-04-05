<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\SupplierPaymentsRequest;
use App\Http\Resources\Purchase\SupplierPaymentsResource;
use App\Services\Purchase\SupplierPaymentsService;
use App\DTOs\Purchase\SupplierPaymentsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SupplierPaymentsController extends Controller
{
    public function __construct(
        protected SupplierPaymentsService $service
    ) {}

    public function index(SupplierPaymentsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $payments = $this->service->getPayments($perPage, $search, $filters);

        return SupplierPaymentsResource::collection($payments)
            ->additional([
                'success' => true,
                'message' => 'Supplier payments retrieved successfully'
            ]);
    }

    public function store(SupplierPaymentsRequest $request): JsonResponse
    {
        $dto = SupplierPaymentsDTO::fromRequest($request->validated());
        $payment = $this->service->recordPayment($dto);

        return response()->json([
            'success' => true,
            'message' => 'Supplier payment recorded successfully',
            'data' => new SupplierPaymentsResource($payment)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $payment = $this->service->getPaymentById($id);
        if (!$payment) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier payment retrieved successfully',
            'data' => new SupplierPaymentsResource($payment)
        ]);
    }

    public function update(SupplierPaymentsRequest $request, int $id): JsonResponse
    {
        $dto = SupplierPaymentsDTO::fromRequest($request->validated());
        $success = $this->service->updatePayment($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier payment updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deletePayment($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Payment not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier payment deleted successfully'
        ]);
    }
}
