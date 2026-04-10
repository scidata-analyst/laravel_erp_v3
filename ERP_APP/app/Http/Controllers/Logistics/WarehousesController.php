<?php

namespace App\Http\Controllers\Logistics;

use App\Services\Logistics\WarehousesService;
use App\Http\Requests\Logistics\WarehousesStoreRequest;
use App\Http\Requests\Logistics\WarehousesUpdateRequest;
use App\Http\Resources\Logistics\WarehousesResource;
use App\Http\Controllers\Controller;

/**
 * Class WarehousesController
 *
 * Controller for managing Warehouses resources.
 * Provides CRUD operations with JSON responses.
 */
class WarehousesController extends Controller
{
    /**
     * @var WarehousesService
     */
    protected $warehousesService;

    /**
     * WarehousesController constructor.
     *
     * @param WarehousesService $warehousesService
     */
    public function __construct(WarehousesService $warehousesService)
    {
        $this->warehousesService = $warehousesService;
    }

    /**
     * Display all Warehouses records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->warehousesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Warehouses records fetched successfully",
            "data" => WarehousesResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Warehouses resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->warehousesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Warehouses records fetched successfully",
            "data" => WarehousesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Warehouses resource in storage.
     *
     * @param WarehousesStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WarehousesStoreRequest $request)
    {
        $data = $this->warehousesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Warehouses record created successfully",
            "data" => new WarehousesResource($data)
        ], 201);
    }

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->warehousesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Warehouses record fetched successfully",
            "data" => new WarehousesResource($data)
        ]);
    }

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param WarehousesUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WarehousesUpdateRequest $request, $id)
    {
        $data = $this->warehousesService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Warehouses record updated successfully",
            "data" => new WarehousesResource($data)
        ]);
    }

    /**
     * Remove the specified Warehouses resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->warehousesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Warehouses record deleted successfully"
        ]);
    }
}
