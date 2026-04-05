<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\GrnRequest;
use App\Http\Resources\Purchase\GrnResource;
use App\Services\Purchase\GrnService;
use App\DTOs\Purchase\GrnDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GrnController extends Controller
{
    public function __construct(
        protected GrnService $service
    ) {}

    public function index(GrnRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $grns = $this->service->getGrns($perPage, $search, $filters);

        return GrnResource::collection($grns)
            ->additional([
                'success' => true,
                'message' => 'Goods Received Notes retrieved successfully'
            ]);
    }

    public function store(GrnRequest $request): JsonResponse
    {
        $dto = GrnDTO::fromRequest($request->validated());
        $grn = $this->service->receiveGoods($dto);

        return response()->json([
            'success' => true,
            'message' => 'Goods received successfully',
            'data' => new GrnResource($grn)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $grn = $this->service->getGrnById($id);
        if (!$grn) {
            return response()->json(['success' => false, 'message' => 'GRN not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'GRN retrieved successfully',
            'data' => new GrnResource($grn)
        ]);
    }

    public function update(GrnRequest $request, int $id): JsonResponse
    {
        $dto = GrnDTO::fromRequest($request->validated());
        $success = $this->service->updateGrn($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'GRN not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'GRN updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteGrn($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'GRN not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'GRN deleted successfully'
        ]);
    }
}
