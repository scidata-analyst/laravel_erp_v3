<?php

namespace App\Http\Controllers\Logistics;

use App\Services\Logistics\RoutesService;
use App\Http\Requests\Logistics\RoutesRequest;
use App\Http\Resources\Logistics\RoutesResource;
use App\Http\Controllers\Controller;

/**
 * Class RoutesController
 *
 * Controller for managing Routes resources.
 * Provides CRUD operations with JSON responses.
 */
class RoutesController extends Controller
{
    /**
     * @var RoutesService
     */
    protected $routesService;

    /**
     * RoutesController constructor.
     *
     * @param RoutesService $routesService
     */
    public function __construct(RoutesService $routesService)
    {
        $this->routesService = $routesService;
    }

    /**
     * Display a paginated listing of Routes resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->routesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Routes records fetched successfully",
            "data" => RoutesResource::collection($data)
        ]);
    }

    /**
     * Display all Routes records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->routesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Routes records fetched successfully",
            "data" => RoutesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Routes resource in storage.
     *
     * @param RoutesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RoutesRequest $request)
    {
        $data = $this->routesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Routes record created successfully",
            "data" => new RoutesResource($data)
        ], 201);
    }

    /**
     * Display the specified Routes resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->routesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Routes record fetched successfully",
            "data" => new RoutesResource($data)
        ]);
    }

    /**
     * Update the specified Routes resource in storage.
     *
     * @param RoutesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(RoutesRequest $request, $id)
    {
        $data = $this->routesService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Routes record updated successfully",
            "data" => new RoutesResource($data)
        ]);
    }

    /**
     * Remove the specified Routes resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->routesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Routes record deleted successfully"
        ]);
    }
}
