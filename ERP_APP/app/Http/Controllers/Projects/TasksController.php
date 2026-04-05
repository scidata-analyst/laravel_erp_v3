<?php

namespace App\Http\Controllers\Projects;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\TasksRequest;
use App\Http\Resources\Projects\TasksResource;
use App\Services\Projects\TasksService;
use App\DTOs\Projects\TasksDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TasksController extends Controller
{
    public function __construct(
        protected TasksService $service
    ) {}

    public function index(TasksRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $tasks = $this->service->getTasks($perPage, $search, $filters);

        return TasksResource::collection($tasks)
            ->additional([
                'success' => true,
                'message' => 'Tasks retrieved successfully'
            ]);
    }

    public function store(TasksRequest $request): JsonResponse
    {
        $dto = TasksDTO::fromRequest($request->validated());
        $task = $this->service->createTask($dto);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'data' => new TasksResource($task)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->service->getTaskById($id);
        if (!$task) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task retrieved successfully',
            'data' => new TasksResource($task)
        ]);
    }

    public function update(TasksRequest $request, int $id): JsonResponse
    {
        $dto = TasksDTO::fromRequest($request->validated());
        $success = $this->service->updateTask($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Task updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteTask($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Task deleted successfully']);
    }

    public function updateProgress(Request $request, int $id): JsonResponse
    {
        $request->validate(['progress' => 'required|integer|min:0|max:100']);
        $success = $this->service->updateTaskProgress($id, $request->progress);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Task not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Task progress updated successfully'
        ]);
    }
}
