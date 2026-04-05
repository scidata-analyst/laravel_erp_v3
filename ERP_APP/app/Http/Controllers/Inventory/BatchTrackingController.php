<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\BatchTrackingRequest;
use App\Http\Resources\Inventory\BatchTrackingResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Inventory\BatchTrackingService;
use App\DTOs\Inventory\BatchTrackingDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BatchTrackingController extends Controller
{
    public function __construct(
        protected BatchTrackingService $service
    ) {}

    public function index(BatchTrackingRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $batches = $this->service->getBatches($perPage, $search, $filters);

        return BatchTrackingResource::collection($batches)
            ->additional([
                'success' => true,
                'message' => 'Batches retrieved successfully'
            ]);
    }

    public function store(BatchTrackingRequest $request): JsonResponse
    {
        $dto = BatchTrackingDTO::fromRequest($request->validated());
        $batch = $this->service->createBatch($dto);

        return response()->json([
            'success' => true,
            'message' => 'Batch created successfully',
            'data' => new BatchTrackingResource($batch)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $batch = $this->service->getBatchById($id);
        if (!$batch) {
            return response()->json(['success' => false, 'message' => 'Batch not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Batch retrieved successfully',
            'data' => new BatchTrackingResource($batch)
        ]);
    }

    public function update(BatchTrackingRequest $request, int $id): JsonResponse
    {
        $dto = BatchTrackingDTO::fromRequest($request->validated());
        $success = $this->service->updateBatch($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Batch not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Batch updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteBatch($id);

        return response()->json([
            'success' => true,
            'message' => 'Batch deleted successfully'
        ]);
    }

    public function getExpiringBatches(Request $request): JsonResponse
    {
        $days = $request->get('days', 30);
        $batches = $this->service->getExpiringBatches($days);

        return response()->json([
            'success' => true,
            'message' => 'Expiring batches retrieved successfully',
            'data' => BatchTrackingResource::collection($batches),
            'count' => $batches->count()
        ]);
    }
}
