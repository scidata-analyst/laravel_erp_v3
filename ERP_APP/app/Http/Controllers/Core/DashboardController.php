<?php

namespace App\Http\Controllers\Core;

use App\Services\Core\DashboardService;
use App\Http\Requests\Core\DashboardRequest;
use App\Http\Resources\Core\DashboardResource;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 *
 * Controller for managing Dashboard resources.
 * Provides CRUD operations with JSON responses.
 */
class DashboardController extends Controller
{
    /**
     * @var DashboardService
     */
    protected $dashboardService;

    /**
     * DashboardController constructor.
     *
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display all Dashboard records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->dashboardService->all();

        return response()->json([
            "success" => true,
            "message" => "All Dashboard records fetched successfully",
            "data" => DashboardResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Dashboard resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->dashboardService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Dashboard records fetched successfully",
            "data" => DashboardResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Dashboard resource in storage.
     *
     * @param DashboardRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DashboardRequest $request)
    {
        $data = $this->dashboardService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Dashboard record created successfully",
            "data" => new DashboardResource($data)
        ], 201);
    }

    /**
     * Display the specified Dashboard resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->dashboardService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Dashboard record fetched successfully",
            "data" => new DashboardResource($data)
        ]);
    }

    /**
     * Update the specified Dashboard resource in storage.
     *
     * @param DashboardRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DashboardRequest $request, $id)
    {
        $data = $this->dashboardService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Dashboard record updated successfully",
            "data" => new DashboardResource($data)
        ]);
    }

    /**
     * Remove the specified Dashboard resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->dashboardService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Dashboard record deleted successfully"
        ]);
    }
}
