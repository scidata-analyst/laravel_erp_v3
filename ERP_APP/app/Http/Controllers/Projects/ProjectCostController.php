<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\ProjectCostService;
use App\Http\Requests\Projects\ProjectCostStoreRequest;
use App\Http\Requests\Projects\ProjectCostUpdateRequest;
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
     * Display all ProjectCost records without pagination.
     *
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
     * Display a paginated listing of ProjectCost resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->projectCostService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "ProjectCost records fetched successfully",
                "data" => ProjectCostResource::collection($data)
            ]);
        }

        return view("projects.project_cost", compact("data"));
    }

    /**
     * Store a newly created ProjectCost resource in storage.
     *
     * @param ProjectCostStoreRequest $request
     */
    public function store(ProjectCostStoreRequest $request)
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
     * @param ProjectCostUpdateRequest $request
     * @param int $id
     */
    public function update(ProjectCostUpdateRequest $request, $id)
    {
        $data = $this->projectCostService->update($request->validated(), $id);

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
