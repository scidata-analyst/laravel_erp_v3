<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\TasksService;
use App\Http\Requests\Projects\TasksRequest;
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
     * @return \Illuminate\Http\JsonResponse
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->tasksService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Tasks records fetched successfully",
            "data" => TasksResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Tasks resource in storage.
     *
     * @param TasksRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TasksRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param TasksRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(TasksRequest $request, $id)
    {
        $data = $this->tasksService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
