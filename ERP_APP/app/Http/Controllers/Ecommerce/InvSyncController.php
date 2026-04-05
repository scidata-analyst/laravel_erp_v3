<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\InvSyncRequest;
use App\Http\Resources\Ecommerce\InvSyncResource;
use App\Services\Ecommerce\InvSyncService;
use App\DTOs\Ecommerce\InvSyncDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvSyncController extends Controller
{
    public function __construct(
        protected InvSyncService $service
    ) {}

    public function index(InvSyncRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $syncs = $this->service->getSyncLogs($perPage, $search, $filters);

        return InvSyncResource::collection($syncs)
            ->additional([
                'success' => true,
                'message' => 'Inventory sync logs retrieved successfully'
            ]);
    }

    public function store(InvSyncRequest $request): JsonResponse
    {
        $dto = InvSyncDTO::fromRequest($request->validated());
        $sync = $this->service->initiateSync($dto);

        return response()->json([
            'success' => true,
            'message' => 'Inventory sync initiated successfully',
            'data' => new InvSyncResource($sync)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $sync = $this->service->getSyncById($id);

        if (!$sync) {
            return response()->json(['success' => false, 'message' => 'Sync log not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory sync retrieved successfully',
            'data' => new InvSyncResource($sync)
        ]);
    }

    public function update(InvSyncRequest $request, int $id): JsonResponse
    {
        $dto = InvSyncDTO::fromRequest($request->validated());
        $success = $this->service->updateSync($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Sync log not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory sync updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteSync($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Sync log not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory sync deleted successfully'
        ]);
    }

    public function complete(int $id): JsonResponse
    {
        $success = $this->service->markSyncCompleted($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Sync log not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Inventory sync marked as completed'
        ]);
    }
}
