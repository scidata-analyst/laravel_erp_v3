<?php

namespace App\Http\Controllers\Inventory;

use App\Services\Inventory\StockValuationService;
use App\Http\Requests\Inventory\StockValuationStoreRequest;
use App\Http\Requests\Inventory\StockValuationUpdateRequest;
use App\Http\Resources\Inventory\StockValuationResource;
use App\Http\Controllers\Controller;

/**
 * Class StockValuationController
 *
 * Controller for managing StockValuation resources.
 * Provides CRUD operations with JSON responses.
 */
class StockValuationController extends Controller
{
    /**
     * @var StockValuationService
     */
    protected $stockValuationService;

    /**
     * StockValuationController constructor.
     *
     * @param StockValuationService $stockValuationService
     */
    public function __construct(StockValuationService $stockValuationService)
    {
        $this->stockValuationService = $stockValuationService;
    }

    /**
     * Display all StockValuation records without pagination.
     *
     */
    public function all()
    {
        $data = $this->stockValuationService->all();

        return response()->json([
            "success" => true,
            "message" => "All StockValuation records fetched successfully",
            "data" => StockValuationResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of StockValuation resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->stockValuationService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "StockValuation records fetched successfully",
                "data" => StockValuationResource::collection($data)
            ]);
        }

        return view("inventory.stock_valuation", compact("data"));
    }

    /**
     * Store a newly created StockValuation resource in storage.
     *
     * @param StockValuationStoreRequest $request
     */
    public function store(StockValuationStoreRequest $request)
    {
        $data = $this->stockValuationService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "StockValuation record created successfully",
            "data" => new StockValuationResource($data)
        ], 201);
    }

    /**
     * Display the specified StockValuation resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->stockValuationService->show($id);

        return response()->json([
            "success" => true,
            "message" => "StockValuation record fetched successfully",
            "data" => new StockValuationResource($data)
        ]);
    }

    /**
     * Update the specified StockValuation resource in storage.
     *
     * @param StockValuationUpdateRequest $request
     * @param int $id
     */
    public function update(StockValuationUpdateRequest $request, $id)
    {
        $data = $this->stockValuationService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "StockValuation record updated successfully",
            "data" => new StockValuationResource($data)
        ]);
    }

    /**
     * Remove the specified StockValuation resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->stockValuationService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "StockValuation record deleted successfully"
        ]);
    }
}
