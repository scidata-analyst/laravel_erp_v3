<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\ProjectCostService;
use App\Http\Requests\Projects\ProjectCostRequest;
use App\Http\Resources\Projects\ProjectCostResource;
use App\Http\Controllers\Controller;

/**
 * Class ProjectCostController
 *
 * Controller for managing ProjectCost resources.
 * Provides CRUD operations with JSON responses.
 */
class ProjectCostController extends Controller
{
    /**
     * @var ProjectCostService
     */
    protected $projectCostService;

    /**
     * ProjectCostController constructor.
     *
     * @param ProjectCostService $projectCostService
     */
    public function __construct(ProjectCostService $projectCostService)
    {
        $this->projectCostService = $projectCostService;
    }

    /**
     * Display a paginated listing of ProjectCost resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->projectCostService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "ProjectCost records fetched successfully",
            "data" => ProjectCostResource::collection($data)
        ]);
    }

    /**
     * Display all ProjectCost records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->projectCostService->all();

        return response()->json([
            "success" => true,
            "message" => "All ProjectCost records fetched successfully",
            "data" => ProjectCostResource::collection($data)
        ]);
    }

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     * @param ProjectCostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProjectCostRequest $request)
    {
        $data = $this->projectCostService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "ProjectCost record created successfully",
            "data" => new ProjectCostResource($data)
        ], 201);
    }

    /**
     * Display the specified ProjectCost resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->projectCostService->show($id);

        return response()->json([
            "success" => true,
            "message" => "ProjectCost record fetched successfully",
            "data" => new ProjectCostResource($data)
        ]);
    }

    /**
     * Update the specified ProjectCost resource in storage.
     *
     * @param ProjectCostRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ProjectCostRequest $request, $id)
    {
        $data = $this->projectCostService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "ProjectCost record updated successfully",
            "data" => new ProjectCostResource($data)
        ]);
    }

    /**
     * Remove the specified ProjectCost resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->projectCostService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "ProjectCost record deleted successfully"
        ]);
    }
}
