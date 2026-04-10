<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\PurchaseOrdersService;
use App\Http\Requests\Purchase\PurchaseOrdersStoreRequest;
use App\Http\Requests\Purchase\PurchaseOrdersUpdateRequest;
use App\Http\Resources\Purchase\PurchaseOrdersResource;
use App\Http\Controllers\Controller;

/**
 * Class PurchaseOrdersController
 *
 * Controller for managing PurchaseOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class PurchaseOrdersController extends Controller
{
    /**
     * @var PurchaseOrdersService
     */
    protected $purchaseOrdersService;

    /**
     * PurchaseOrdersController constructor.
     *
     * @param PurchaseOrdersService $purchaseOrdersService
     */
    public function __construct(PurchaseOrdersService $purchaseOrdersService)
    {
        $this->purchaseOrdersService = $purchaseOrdersService;
    }

    /**
     * Display all PurchaseOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->purchaseOrdersService->all();

        return response()->json([
            "success" => true,
            "message" => "All PurchaseOrders records fetched successfully",
            "data" => PurchaseOrdersResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of PurchaseOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->purchaseOrdersService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "PurchaseOrders records fetched successfully",
            "data" => PurchaseOrdersResource::collection($data)
        ]);
    }

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @param PurchaseOrdersStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PurchaseOrdersStoreRequest $request)
    {
        $data = $this->purchaseOrdersService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "PurchaseOrders record created successfully",
            "data" => new PurchaseOrdersResource($data)
        ], 201);
    }

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->purchaseOrdersService->show($id);

        return response()->json([
            "success" => true,
            "message" => "PurchaseOrders record fetched successfully",
            "data" => new PurchaseOrdersResource($data)
        ]);
    }

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param PurchaseOrdersUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PurchaseOrdersUpdateRequest $request, $id)
    {
        $data = $this->purchaseOrdersService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "PurchaseOrders record updated successfully",
            "data" => new PurchaseOrdersResource($data)
        ]);
    }

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->purchaseOrdersService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "PurchaseOrders record deleted successfully"
        ]);
    }
}
