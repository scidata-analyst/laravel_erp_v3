<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\SupplierPaymentsService;
use App\Http\Requests\Purchase\SupplierPaymentsStoreRequest;
use App\Http\Requests\Purchase\SupplierPaymentsUpdateRequest;
use App\Http\Resources\Purchase\SupplierPaymentsResource;
use App\Http\Controllers\Controller;

/**
 * Class SupplierPaymentsController
 *
 * Controller for managing SupplierPayments resources.
 * Provides CRUD operations with JSON responses.
 */
class SupplierPaymentsController extends Controller
{
    /**
     * @var SupplierPaymentsService
     */
    protected $supplierPaymentsService;

    /**
     * SupplierPaymentsController constructor.
     *
     * @param SupplierPaymentsService $supplierPaymentsService
     */
    public function __construct(SupplierPaymentsService $supplierPaymentsService)
    {
        $this->supplierPaymentsService = $supplierPaymentsService;
    }

    /**
     * Display all SupplierPayments records without pagination.
     *
     */
    public function all()
    {
        $data = $this->supplierPaymentsService->all();

        return response()->json([
            "success" => true,
            "message" => "All SupplierPayments records fetched successfully",
            "data" => SupplierPaymentsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of SupplierPayments resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->supplierPaymentsService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "SupplierPayments records fetched successfully",
                "data" => SupplierPaymentsResource::collection($data)
            ]);
        }

        return view("purchase.supplier_payments", compact("data"));
    }

    /**
     * Store a newly created SupplierPayments resource in storage.
     *
     * @param SupplierPaymentsStoreRequest $request
     */
    public function store(SupplierPaymentsStoreRequest $request)
    {
        $data = $this->supplierPaymentsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "SupplierPayments record created successfully",
            "data" => new SupplierPaymentsResource($data)
        ], 201);
    }

    /**
     * Display the specified SupplierPayments resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->supplierPaymentsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "SupplierPayments record fetched successfully",
            "data" => new SupplierPaymentsResource($data)
        ]);
    }

    /**
     * Update the specified SupplierPayments resource in storage.
     *
     * @param SupplierPaymentsUpdateRequest $request
     * @param int $id
     */
    public function update(SupplierPaymentsUpdateRequest $request, $id)
    {
        $data = $this->supplierPaymentsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "SupplierPayments record updated successfully",
            "data" => new SupplierPaymentsResource($data)
        ]);
    }

    /**
     * Remove the specified SupplierPayments resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->supplierPaymentsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "SupplierPayments record deleted successfully"
        ]);
    }
}
