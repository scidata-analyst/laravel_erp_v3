<?php

namespace App\Http\Controllers\Sales;

use App\Services\Sales\SalesOrdersService;
use App\Http\Requests\Sales\SalesOrdersRequest;
use App\Http\Resources\Sales\SalesOrdersResource;
use App\Http\Controllers\Controller;

/**
 * Class SalesOrdersController
 *
 * Controller for managing SalesOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class SalesOrdersController extends Controller
{
    /**
     * @var SalesOrdersService
     */
    protected $salesOrdersService;

    /**
     * SalesOrdersController constructor.
     *
     * @param SalesOrdersService $salesOrdersService
     */
    public function __construct(SalesOrdersService $salesOrdersService)
    {
        $this->salesOrdersService = $salesOrdersService;
    }

    /**
     * Display a paginated listing of SalesOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->salesOrdersService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "SalesOrders records fetched successfully",
            "data" => SalesOrdersResource::collection($data)
        ]);
    }

    /**
     * Display all SalesOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->salesOrdersService->all();

        return response()->json([
            "success" => true,
            "message" => "All SalesOrders records fetched successfully",
            "data" => SalesOrdersResource::collection($data)
        ]);
    }

    /**
     * Store a newly created SalesOrders resource in storage.
     *
     * @param SalesOrdersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SalesOrdersRequest $request)
    {
        $data = $this->salesOrdersService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "SalesOrders record created successfully",
            "data" => new SalesOrdersResource($data)
        ], 201);
    }

    /**
     * Display the specified SalesOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->salesOrdersService->show($id);

        return response()->json([
            "success" => true,
            "message" => "SalesOrders record fetched successfully",
            "data" => new SalesOrdersResource($data)
        ]);
    }

    /**
     * Update the specified SalesOrders resource in storage.
     *
     * @param SalesOrdersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SalesOrdersRequest $request, $id)
    {
        $data = $this->salesOrdersService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "SalesOrders record updated successfully",
            "data" => new SalesOrdersResource($data)
        ]);
    }

    /**
     * Remove the specified SalesOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->salesOrdersService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "SalesOrders record deleted successfully"
        ]);
    }
}
