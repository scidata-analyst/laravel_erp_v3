<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\StockMovementsRequest;
use App\Http\Resources\Inventory\StockMovementsResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Inventory\StockMovementsService;
use App\DTOs\Inventory\StockMovementsDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class StockMovementsController extends Controller
{
    public function __construct(
        protected StockMovementsService $service
    ) {}

    public function index(StockMovementsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $movements = $this->service->getMovements($perPage, $search, $filters);

        return StockMovementsResource::collection($movements)
            ->additional([
                'success' => true,
                'message' => 'Stock movements retrieved successfully'
            ]);
    }

    public function store(StockMovementsRequest $request): JsonResponse
    {
        $dto = StockMovementsDTO::fromRequest($request->validated());
        $movement = $this->service->recordMovement($dto);

        return response()->json([
            'success' => true,
            'message' => 'Stock movement recorded successfully',
            'data' => new StockMovementsResource($movement)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $movement = $this->service->getMovementById($id);
        if (!$movement) {
            return response()->json(['success' => false, 'message' => 'Movement not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Stock movement retrieved successfully',
            'data' => new StockMovementsResource($movement)
        ]);
    }

    public function getByProduct(int $productId): JsonResponse
    {
        $movements = $this->service->getProductMovements($productId);

        return response()->json([
            'success' => true,
            'message' => 'Product movements retrieved successfully',
            'data' => StockMovementsResource::collection($movements)
        ]);
    }
}
