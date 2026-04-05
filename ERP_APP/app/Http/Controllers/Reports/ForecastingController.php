<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\ForecastingRequest;
use App\Http\Resources\Reports\ForecastingResource;
use App\Services\Reports\ForecastingService;
use App\DTOs\Reports\ForecastingDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ForecastingController extends Controller
{
    public function __construct(
        protected ForecastingService $service
    ) {}

    public function index(ForecastingRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $forecasts = $this->service->getForecasts($perPage, $search, $filters);

        return ForecastingResource::collection($forecasts)
            ->additional([
                'success' => true,
                'message' => 'Forecasts retrieved successfully'
            ]);
    }

    public function store(ForecastingRequest $request): JsonResponse
    {
        $dto = ForecastingDTO::fromRequest($request->validated());
        $forecast = $this->service->setupForecast($dto);

        return response()->json([
            'success' => true,
            'message' => 'Forecast setup successfully',
            'data' => new ForecastingResource($forecast)
        ], 201);
    }

    public function run(int $id): JsonResponse
    {
        $success = $this->service->generateForecast($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Forecast not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Forecast calculation initiated'
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $forecast = $this->service->getForecastById($id);
        if (!$forecast) {
            return response()->json(['success' => false, 'message' => 'Forecast not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Forecast retrieved successfully',
            'data' => new ForecastingResource($forecast)
        ]);
    }

    public function update(ForecastingRequest $request, int $id): JsonResponse
    {
        $dto = ForecastingDTO::fromRequest($request->validated());
        $success = $this->service->updateForecast($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Forecast not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Forecast updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteForecast($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Forecast not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Forecast deleted successfully']);
    }
}
