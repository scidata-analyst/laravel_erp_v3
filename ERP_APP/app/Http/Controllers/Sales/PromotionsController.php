<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\PromotionsRequest;
use App\Http\Resources\Sales\PromotionsResource;
use App\Services\Sales\PromotionsService;
use App\DTOs\Sales\PromotionsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PromotionsController extends Controller
{
    public function __construct(
        protected PromotionsService $service
    ) {}

    public function index(PromotionsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $promotions = $this->service->getPromotions($perPage, $search, $filters);

        return PromotionsResource::collection($promotions)
            ->additional([
                'success' => true,
                'message' => 'Promotions retrieved successfully'
            ]);
    }

    public function store(PromotionsRequest $request): JsonResponse
    {
        $dto = PromotionsDTO::fromRequest($request->validated());
        $promotion = $this->service->createPromotion($dto);

        return response()->json([
            'success' => true,
            'message' => 'Promotion created successfully',
            'data' => new PromotionsResource($promotion)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $promotion = $this->service->getPromotionById($id);
        if (!$promotion) {
            return response()->json(['success' => false, 'message' => 'Promotion not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Promotion retrieved successfully',
            'data' => new PromotionsResource($promotion)
        ]);
    }

    public function update(PromotionsRequest $request, int $id): JsonResponse
    {
        $dto = PromotionsDTO::fromRequest($request->validated());
        $success = $this->service->updatePromotion($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Promotion not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Promotion updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deletePromotion($id);

        return response()->json([
            'success' => true,
            'message' => 'Promotion deleted successfully'
        ]);
    }

    public function getActive(): JsonResponse
    {
        $promotions = $this->service->getActivePromotions();

        return response()->json([
            'success' => true,
            'message' => 'Active promotions retrieved successfully',
            'data' => PromotionsResource::collection($promotions),
            'count' => $promotions->count()
        ]);
    }
}
