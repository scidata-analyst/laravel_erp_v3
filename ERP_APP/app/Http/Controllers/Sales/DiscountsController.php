<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\DiscountsRequest;
use App\Http\Resources\Sales\DiscountsResource;
use App\Services\Sales\DiscountsService;
use App\DTOs\Sales\DiscountsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DiscountsController extends Controller
{
    public function __construct(
        protected DiscountsService $service
    ) {}

    public function index(DiscountsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $discounts = $this->service->getDiscounts($perPage, $search, $filters);

        return DiscountsResource::collection($discounts)
            ->additional([
                'success' => true,
                'message' => 'Discounts retrieved successfully'
            ]);
    }

    public function store(DiscountsRequest $request): JsonResponse
    {
        $dto = DiscountsDTO::fromRequest($request->validated());
        $discount = $this->service->createDiscount($dto);

        return response()->json([
            'success' => true,
            'message' => 'Discount created successfully',
            'data' => new DiscountsResource($discount)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $discount = $this->service->getDiscountById($id);
        if (!$discount) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Discount retrieved successfully',
            'data' => new DiscountsResource($discount)
        ]);
    }

    public function update(DiscountsRequest $request, int $id): JsonResponse
    {
        $dto = DiscountsDTO::fromRequest($request->validated());
        $success = $this->service->updateDiscount($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Discount updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteDiscount($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Discount not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Discount deleted successfully'
        ]);
    }

    public function validateCode(Request $request): JsonResponse
    {
        $request->validate([
            'code' => 'required|string',
            'amount' => 'nullable|numeric'
        ]);

        $result = $this->service->validateDiscount($request->code, (float) $request->get('amount', 0));

        if (!$result['valid']) {
            return response()->json(['success' => false, 'message' => $result['message']], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Discount code is valid',
            'data' => new DiscountsResource($result['discount'])
        ]);
    }
}
