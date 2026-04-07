<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\SupplierPaymentsService;
use App\Http\Requests\Purchase\SupplierPaymentsRequest;
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
     * Display a paginated listing of SupplierPayments resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->supplierPaymentsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "SupplierPayments records fetched successfully",
            "data" => SupplierPaymentsResource::collection($data)
        ]);
    }

    /**
     * Display all SupplierPayments records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Store a newly created SupplierPayments resource in storage.
     *
     * @param SupplierPaymentsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SupplierPaymentsRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param SupplierPaymentsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SupplierPaymentsRequest $request, $id)
    {
        $data = $this->supplierPaymentsService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
