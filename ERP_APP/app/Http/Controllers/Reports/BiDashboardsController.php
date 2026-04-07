<?php

namespace App\Http\Controllers\Reports;

use App\Services\Reports\BiDashboardsService;
use App\Http\Requests\Reports\BiDashboardsRequest;
use App\Http\Resources\Reports\BiDashboardsResource;
use App\Http\Controllers\Controller;

/**
 * Class BiDashboardsController
 *
 * Controller for managing BiDashboards resources.
 * Provides CRUD operations with JSON responses.
 */
class BiDashboardsController extends Controller
{
    /**
     * @var BiDashboardsService
     */
    protected $biDashboardsService;

    /**
     * BiDashboardsController constructor.
     *
     * @param BiDashboardsService $biDashboardsService
     */
    public function __construct(BiDashboardsService $biDashboardsService)
    {
        $this->biDashboardsService = $biDashboardsService;
    }

    /**
     * Display a paginated listing of BiDashboards resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->biDashboardsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "BiDashboards records fetched successfully",
            "data" => BiDashboardsResource::collection($data)
        ]);
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->biDashboardsService->all();

        return response()->json([
            "success" => true,
            "message" => "All BiDashboards records fetched successfully",
            "data" => BiDashboardsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created BiDashboards resource in storage.
     *
     * @param BiDashboardsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BiDashboardsRequest $request)
    {
        $data = $this->biDashboardsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "BiDashboards record created successfully",
            "data" => new BiDashboardsResource($data)
        ], 201);
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->biDashboardsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "BiDashboards record fetched successfully",
            "data" => new BiDashboardsResource($data)
        ]);
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param BiDashboardsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BiDashboardsRequest $request, $id)
    {
        $data = $this->biDashboardsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "BiDashboards record updated successfully",
            "data" => new BiDashboardsResource($data)
        ]);
    }

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->biDashboardsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "BiDashboards record deleted successfully"
        ]);
    }
}
