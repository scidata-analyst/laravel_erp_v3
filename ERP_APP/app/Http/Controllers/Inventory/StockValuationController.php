<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StockValuationRequest;
use App\Http\Resources\Inventory\StockValuationResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Inventory\StockValuationService;
use App\DTOs\Inventory\StockValuationDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StockValuationController extends Controller
{
    public function __construct(
        protected StockValuationService $service
    ) {}

    public function index(StockValuationRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $valuations = $this->service->getValuations($perPage, $search, $filters);

        return StockValuationResource::collection($valuations)
            ->additional([
                'success' => true,
                'message' => 'Stock valuations retrieved successfully'
            ]);
    }

    public function store(StockValuationRequest $request): JsonResponse
    {
        // Usually triggered on-demand or by events
        $productId = $request->validated()['product_id'];
        $valuation = $this->service->calculateAndRecordValuation($productId);

        return response()->json([
            'success' => true,
            'message' => 'Stock valuation recorded successfully',
            'data' => new StockValuationResource($valuation)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $valuation = $this->service->getValuationById($id);
        if (!$valuation) {
            return response()->json(['success' => false, 'message' => 'Valuation not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Stock valuation retrieved successfully',
            'data' => new StockValuationResource($valuation)
        ]);
    }

    public function getLatestByProduct(int $productId): JsonResponse
    {
        $valuation = $this->service->getLatestProductValuation($productId);
        if (!$valuation) {
            return response()->json(['success' => false, 'message' => 'No valuation found for this product'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Latest product valuation retrieved successfully',
            'data' => new StockValuationResource($valuation)
        ]);
    }
}
