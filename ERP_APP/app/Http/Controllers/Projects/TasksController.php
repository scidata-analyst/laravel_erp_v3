<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\TasksService;
use App\Http\Requests\Projects\TasksStoreRequest;
use App\Http\Requests\Projects\TasksUpdateRequest;
use App\Http\Resources\Projects\TasksResource;
use App\Http\Controllers\Controller;

/**
 * Class TasksController
 *
 * Controller for managing Tasks resources.
 * Provides CRUD operations with JSON responses.
 */
class TasksController extends Controller
{
    /**
     * @var TasksService
     */
    protected $tasksService;

    /**
     * TasksController constructor.
     *
     * @param TasksService $tasksService
     */
    public function __construct(TasksService $tasksService)
    {
        $this->tasksService = $tasksService;
    }

    /**
     * Display all Tasks records without pagination.
     *
     */
    public function all()
    {
        $data = $this->tasksService->all();

        return response()->json([
            "success" => true,
            "message" => "All Tasks records fetched successfully",
            "data" => TasksResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Tasks resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->tasksService->index($perPage, $search, $filters);

        if (request()->ajax()) {
            return response()->json([
                "success" => true,
                "message" => "Tasks records fetched successfully",
                "data" => TasksResource::collection($data)
            ]);
        }

        return view("projects.tasks", compact("data"));
    }

    /**
     * Store a newly created Tasks resource in storage.
     *
     * @param TasksStoreRequest $request
     */
    public function store(TasksStoreRequest $request)
    {
        $data = $this->tasksService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Tasks record created successfully",
            "data" => new TasksResource($data)
        ], 201);
    }

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->tasksService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Tasks record fetched successfully",
            "data" => new TasksResource($data)
        ]);
    }

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param TasksUpdateRequest $request
     * @param int $id
     */
    public function update(TasksUpdateRequest $request, $id)
    {
        $data = $this->tasksService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Tasks record updated successfully",
            "data" => new TasksResource($data)
        ]);
    }

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->tasksService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Tasks record deleted successfully"
        ]);
    }
}
