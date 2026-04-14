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
     */
    public function all()
    {
        $data = $this->warehousesService->all();

        return WarehousesResource::collection($data)->additional([
            "success" => true,
            "message" => "All Warehouses records fetched successfully"
        ]);
    }

    /**
     * Display a paginated listing of Warehouses resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->warehousesService->index($perPage, $search, $filters);

        return view("logistics.warehouses", compact("data"));
    }

    /**
     * Store a newly created Warehouses resource in storage.
     *
     * @param WarehousesStoreRequest $request
     */
    public function store(WarehousesStoreRequest $request)
    {
        $data = $this->warehousesService->store($request->validated());

        return (new WarehousesResource($data))->additional([
            "success" => true,
            "message" => "Warehouses record created successfully"
        ]);
    }

    /**
     * Display the specified Warehouses resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->warehousesService->show($id);

        return (new WarehousesResource($data))->additional([
            "success" => true,
            "message" => "Warehouses record fetched successfully"
        ]);
    }

    /**
     * Update the specified Warehouses resource in storage.
     *
     * @param WarehousesUpdateRequest $request
     * @param int $id
     */
    public function update(WarehousesUpdateRequest $request, $id)
    {
        $data = $this->warehousesService->update($request->validated(), $id);

        return (new WarehousesResource($data))->additional([
            "success" => true,
            "message" => "Warehouses record updated successfully"
        ]);
    }

    /**
     * Remove the specified Warehouses resource from storage.
     *
     * @param int $id
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
