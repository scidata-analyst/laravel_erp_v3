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
     */
    public function all()
    {
        $data = $this->purchaseOrdersService->all();

        return PurchaseOrdersResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'PurchaseOrders records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of PurchaseOrders resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->purchaseOrdersService->index($perPage, $search, $filters);

        return view("purchase.purchase_orders", compact("data"));
    }

    /**
     * Store a newly created PurchaseOrders resource in storage.
     *
     * @param PurchaseOrdersStoreRequest $request
     */
    public function store(PurchaseOrdersStoreRequest $request)
    {
        $data = $this->purchaseOrdersService->store($request->validated());

        return (new PurchaseOrdersResource($data))->additional([
            'success' => true,
            'message' => 'PurchaseOrders record created successfully',
        ]);
    }

    /**
     * Display the specified PurchaseOrders resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->purchaseOrdersService->show($id);

        return (new PurchaseOrdersResource($data))->additional([
            'success' => true,
            'message' => 'PurchaseOrders record fetched successfully',
        ]);
    }

    /**
     * Update the specified PurchaseOrders resource in storage.
     *
     * @param PurchaseOrdersUpdateRequest $request
     * @param int $id
     */
    public function update(PurchaseOrdersUpdateRequest $request, $id)
    {
        $data = $this->purchaseOrdersService->update($request->validated(), $id);

        return (new PurchaseOrdersResource($data))->additional([
            'success' => true,
            'message' => 'PurchaseOrders record updated successfully',
        ]);
    }

    /**
     * Remove the specified PurchaseOrders resource from storage.
     *
     * @param int $id
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
