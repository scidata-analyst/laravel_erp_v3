<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\OnlineChannelsRequest;
use App\Http\Resources\Ecommerce\OnlineChannelsResource;
use App\Services\Ecommerce\OnlineChannelsService;
use App\DTOs\Ecommerce\OnlineChannelsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OnlineChannelsController extends Controller
{
    public function __construct(
        protected OnlineChannelsService $service
    ) {}

    public function index(OnlineChannelsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $channels = $this->service->getChannels($perPage, $search, $filters);

        return OnlineChannelsResource::collection($channels)
            ->additional([
                'success' => true,
                'message' => 'Online channels retrieved successfully'
            ]);
    }

    public function store(OnlineChannelsRequest $request): JsonResponse
    {
        $dto = OnlineChannelsDTO::fromRequest($request->validated());
        $channel = $this->service->addChannel($dto);

        return response()->json([
            'success' => true,
            'message' => 'Online channel added successfully',
            'data' => new OnlineChannelsResource($channel)
        ], 201);
    }

    public function active(): JsonResponse
    {
        $channels = $this->service->getActiveSalesChannels();

        return response()->json([
            'success' => true,
            'message' => 'Active online channels retrieved successfully',
            'data' => OnlineChannelsResource::collection($channels)
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $channel = $this->service->getChannelById($id);
        if (!$channel) {
            return response()->json(['success' => false, 'message' => 'Channel not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Online channel retrieved successfully',
            'data' => new OnlineChannelsResource($channel)
        ]);
    }

    public function update(OnlineChannelsRequest $request, int $id): JsonResponse
    {
        $dto = OnlineChannelsDTO::fromRequest($request->validated());
        $success = $this->service->updateChannel($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Channel not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Online channel updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteChannel($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Channel not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Online channel deleted successfully']);
    }
}
