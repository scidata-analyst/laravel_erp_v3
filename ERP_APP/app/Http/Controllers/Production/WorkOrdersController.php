<?php

namespace App\Http\Controllers\Production;

use App\Services\Production\WorkOrdersService;
use App\Http\Requests\Production\WorkOrdersRequest;
use App\Http\Resources\Production\WorkOrdersResource;
use App\Http\Controllers\Controller;

/**
 * Class WorkOrdersController
 *
 * Controller for managing WorkOrders resources.
 * Provides CRUD operations with JSON responses.
 */
class WorkOrdersController extends Controller
{
    /**
     * @var WorkOrdersService
     */
    protected $workOrdersService;

    /**
     * WorkOrdersController constructor.
     *
     * @param WorkOrdersService $workOrdersService
     */
    public function __construct(WorkOrdersService $workOrdersService)
    {
        $this->workOrdersService = $workOrdersService;
    }

    /**
     * Display all WorkOrders records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->workOrdersService->all();

        return response()->json([
            "success" => true,
            "message" => "All WorkOrders records fetched successfully",
            "data" => WorkOrdersResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of WorkOrders resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->workOrdersService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "WorkOrders records fetched successfully",
            "data" => WorkOrdersResource::collection($data)
        ]);
    }

    /**
     * Store a newly created WorkOrders resource in storage.
     *
     * @param WorkOrdersRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(WorkOrdersRequest $request)
    {
        $data = $this->workOrdersService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "WorkOrders record created successfully",
            "data" => new WorkOrdersResource($data)
        ], 201);
    }

    /**
     * Display the specified WorkOrders resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->workOrdersService->show($id);

        return response()->json([
            "success" => true,
            "message" => "WorkOrders record fetched successfully",
            "data" => new WorkOrdersResource($data)
        ]);
    }

    /**
     * Update the specified WorkOrders resource in storage.
     *
     * @param WorkOrdersRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(WorkOrdersRequest $request, $id)
    {
        $data = $this->workOrdersService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "WorkOrders record updated successfully",
            "data" => new WorkOrdersResource($data)
        ]);
    }

    /**
     * Remove the specified WorkOrders resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->workOrdersService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "WorkOrders record deleted successfully"
        ]);
    }
}
