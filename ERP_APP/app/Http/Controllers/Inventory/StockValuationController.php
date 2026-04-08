<?php

namespace App\Http\Controllers\Inventory;

use App\Services\Inventory\StockValuationService;
use App\Http\Requests\Inventory\StockValuationRequest;
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->stockValuationService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "StockValuation records fetched successfully",
            "data" => StockValuationResource::collection($data)
        ]);
    }

    /**
     * Store a newly created StockValuation resource in storage.
     *
     * @param StockValuationRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StockValuationRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param StockValuationRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StockValuationRequest $request, $id)
    {
        $data = $this->stockValuationService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
