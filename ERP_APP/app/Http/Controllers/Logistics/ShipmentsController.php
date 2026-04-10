<?php

namespace App\Http\Controllers\Logistics;

use App\Services\Logistics\ShipmentsService;
use App\Http\Requests\Logistics\ShipmentsStoreRequest;
use App\Http\Requests\Logistics\ShipmentsUpdateRequest;
use App\Http\Resources\Logistics\ShipmentsResource;
use App\Http\Controllers\Controller;

/**
 * Class ShipmentsController
 *
 * Controller for managing Shipments resources.
 * Provides CRUD operations with JSON responses.
 */
class ShipmentsController extends Controller
{
    /**
     * @var ShipmentsService
     */
    protected $shipmentsService;

    /**
     * ShipmentsController constructor.
     *
     * @param ShipmentsService $shipmentsService
     */
    public function __construct(ShipmentsService $shipmentsService)
    {
        $this->shipmentsService = $shipmentsService;
    }

    /**
     * Display all Shipments records without pagination.
     *
     */
    public function all()
    {
        $data = $this->shipmentsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Shipments records fetched successfully",
            "data" => ShipmentsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Shipments resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->shipmentsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Shipments records fetched successfully",
            "data" => ShipmentsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Shipments resource in storage.
     *
     * @param ShipmentsStoreRequest $request
     */
    public function store(ShipmentsStoreRequest $request)
    {
        $data = $this->shipmentsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Shipments record created successfully",
            "data" => new ShipmentsResource($data)
        ], 201);
    }

    /**
     * Display the specified Shipments resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->shipmentsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Shipments record fetched successfully",
            "data" => new ShipmentsResource($data)
        ]);
    }

    /**
     * Update the specified Shipments resource in storage.
     *
     * @param ShipmentsUpdateRequest $request
     * @param int $id
     */
    public function update(ShipmentsUpdateRequest $request, $id)
    {
        $data = $this->shipmentsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Shipments record updated successfully",
            "data" => new ShipmentsResource($data)
        ]);
    }

    /**
     * Remove the specified Shipments resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->shipmentsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Shipments record deleted successfully"
        ]);
    }
}
