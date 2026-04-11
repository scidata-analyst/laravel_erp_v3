<?php

namespace App\Http\Controllers\Sales;

use App\Services\Sales\InvoicesService;
use App\Http\Requests\Sales\InvoicesStoreRequest;
use App\Http\Requests\Sales\InvoicesUpdateRequest;
use App\Http\Resources\Sales\InvoicesResource;
use App\Http\Controllers\Controller;

/**
 * Class InvoicesController
 *
 * Controller for managing Invoices resources.
 * Provides CRUD operations with JSON responses.
 */
class InvoicesController extends Controller
{
    /**
     * @var InvoicesService
     */
    protected $invoicesService;

    /**
     * InvoicesController constructor.
     *
     * @param InvoicesService $invoicesService
     */
    public function __construct(InvoicesService $invoicesService)
    {
        $this->invoicesService = $invoicesService;
    }

    /**
     * Display all Invoices records without pagination.
     *
     */
    public function all()
    {
        $data = $this->invoicesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Invoices records fetched successfully",
            "data" => InvoicesResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Invoices resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->invoicesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Invoices records fetched successfully",
            "data" => InvoicesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Invoices resource in storage.
     *
     * @param InvoicesStoreRequest $request
     */
    public function store(InvoicesStoreRequest $request)
    {
        $data = $this->invoicesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Invoices record created successfully",
            "data" => new InvoicesResource($data)
        ], 201);
    }

    /**
     * Display the specified Invoices resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->invoicesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Invoices record fetched successfully",
            "data" => new InvoicesResource($data)
        ]);
    }

    /**
     * Update the specified Invoices resource in storage.
     *
     * @param InvoicesUpdateRequest $request
     * @param int $id
     */
    public function update(InvoicesUpdateRequest $request, $id)
    {
        $data = $this->invoicesService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Invoices record updated successfully",
            "data" => new InvoicesResource($data)
        ]);
    }

    /**
     * Remove the specified Invoices resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->invoicesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Invoices record deleted successfully"
        ]);
    }
}
