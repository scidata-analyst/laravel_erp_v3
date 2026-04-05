<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\Core\SettingsRequest;
use App\Http\Resources\Core\SettingsResource;
use App\Services\Core\SettingsService;
use App\DTOs\Core\SettingsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SettingsController extends Controller
{
    public function __construct(
        protected SettingsService $service
    ) {}

    public function index(SettingsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $settings = $this->service->getSettings($perPage, $search, $filters);

        return SettingsResource::collection($settings)
            ->additional([
                'success' => true,
                'message' => 'Settings retrieved successfully'
            ]);
    }

    public function store(SettingsRequest $request): JsonResponse
    {
        $dto = SettingsDTO::fromRequest($request->validated());
        $setting = $this->service->saveSetting($dto);

        return response()->json([
            'success' => true,
            'message' => 'Setting saved successfully',
            'data' => new SettingsResource($setting)
        ]);
    }

    public function show(string $key): JsonResponse
    {
        $setting = $this->service->getSettingByKey($key);
        if (!$setting) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Setting retrieved successfully',
            'data' => new SettingsResource($setting)
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteSetting($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Setting deleted successfully']);
    }
}
