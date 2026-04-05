<?php

namespace App\Http\Controllers\Logistics;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logistics\RoutesRequest;
use App\Http\Resources\Logistics\RoutesResource;
use App\Services\Logistics\RoutesService;
use App\DTOs\Logistics\RoutesDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class RoutesController extends Controller
{
    public function __construct(
        protected RoutesService $service
    ) {}

    public function index(RoutesRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $routes = $this->service->getRoutes($perPage, $search, $filters);

        return RoutesResource::collection($routes)
            ->additional([
                'success' => true,
                'message' => 'Routes retrieved successfully'
            ]);
    }

    public function store(RoutesRequest $request): JsonResponse
    {
        $dto = RoutesDTO::fromRequest($request->validated());
        $route = $this->service->createRoute($dto);

        return response()->json([
            'success' => true,
            'message' => 'Route created successfully',
            'data' => new RoutesResource($route)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $route = $this->service->getRouteById($id);
        if (!$route) {
            return response()->json(['success' => false, 'message' => 'Route not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Route retrieved successfully',
            'data' => new RoutesResource($route)
        ]);
    }
}
