<?php

namespace App\Http\Controllers\Inventory;

use App\Services\Inventory\StockMovementsService;
use App\Http\Requests\Inventory\StockMovementsStoreRequest;
use App\Http\Requests\Inventory\StockMovementsUpdateRequest;
use App\Http\Resources\Inventory\StockMovementsResource;
use App\Http\Controllers\Controller;

/**
 * Class StockMovementsController
 *
 * Controller for managing StockMovements resources.
 * Provides CRUD operations with JSON responses.
 */
class StockMovementsController extends Controller
{
    /**
     * @var StockMovementsService
     */
    protected $stockMovementsService;

    /**
     * StockMovementsController constructor.
     *
     * @param StockMovementsService $stockMovementsService
     */
    public function __construct(StockMovementsService $stockMovementsService)
    {
        $this->stockMovementsService = $stockMovementsService;
    }

    /**
     * Display all StockMovements records without pagination.
     *
     */
    public function all()
    {
        $data = $this->stockMovementsService->all();

        return response()->json([
            "success" => true,
            "message" => "All StockMovements records fetched successfully",
            "data" => StockMovementsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of StockMovements resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->stockMovementsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "StockMovements records fetched successfully",
            "data" => StockMovementsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created StockMovements resource in storage.
     *
     * @param StockMovementsStoreRequest $request
     */
    public function store(StockMovementsStoreRequest $request)
    {
        $data = $this->stockMovementsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "StockMovements record created successfully",
            "data" => new StockMovementsResource($data)
        ], 201);
    }

    /**
     * Display the specified StockMovements resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->stockMovementsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "StockMovements record fetched successfully",
            "data" => new StockMovementsResource($data)
        ]);
    }

    /**
     * Update the specified StockMovements resource in storage.
     *
     * @param StockMovementsUpdateRequest $request
     * @param int $id
     */
    public function update(StockMovementsUpdateRequest $request, $id)
    {
        $data = $this->stockMovementsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "StockMovements record updated successfully",
            "data" => new StockMovementsResource($data)
        ]);
    }

    /**
     * Remove the specified StockMovements resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->stockMovementsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "StockMovements record deleted successfully"
        ]);
    }
}
