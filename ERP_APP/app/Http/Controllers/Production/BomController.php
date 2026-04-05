<?php

namespace App\Http\Controllers\Production;

use App\Http\Controllers\Controller;
use App\Http\Requests\Production\BomRequest;
use App\Http\Resources\Production\BomResource;
use App\Services\Production\BomService;
use App\DTOs\Production\BomDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BomController extends Controller
{
    public function __construct(
        protected BomService $service
    ) {}

    public function index(BomRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $boms = $this->service->getBoms($perPage, $search, $filters);

        return BomResource::collection($boms)
            ->additional([
                'success' => true,
                'message' => 'BOMs retrieved successfully'
            ]);
    }

    public function store(BomRequest $request): JsonResponse
    {
        $dto = BomDTO::fromRequest($request->validated());
        $bom = $this->service->createBom($dto);

        return response()->json([
            'success' => true,
            'message' => 'BOM created successfully',
            'data' => new BomResource($bom)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $bom = $this->service->getBomById($id);
        if (!$bom) {
            return response()->json(['success' => false, 'message' => 'BOM not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'BOM retrieved successfully',
            'data' => new BomResource($bom)
        ]);
    }

    public function update(BomRequest $request, int $id): JsonResponse
    {
        $dto = BomDTO::fromRequest($request->validated());
        $success = $this->service->updateBom($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'BOM not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'BOM updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteBom($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'BOM not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'BOM deleted successfully']);
    }
}
