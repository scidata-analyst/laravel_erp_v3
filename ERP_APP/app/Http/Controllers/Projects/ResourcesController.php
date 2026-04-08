<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\ResourcesService;
use App\Http\Requests\Projects\ResourcesRequest;
use App\Http\Resources\Projects\ResourcesResource;
use App\Http\Controllers\Controller;

/**
 * Class ResourcesController
 *
 * Controller for managing Resources resources.
 * Provides CRUD operations with JSON responses.
 */
class ResourcesController extends Controller
{
    /**
     * @var ResourcesService
     */
    protected $resourcesService;

    /**
     * ResourcesController constructor.
     *
     * @param ResourcesService $resourcesService
     */
    public function __construct(ResourcesService $resourcesService)
    {
        $this->resourcesService = $resourcesService;
    }

    /**
     * Display all Resources records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->resourcesService->all();

        return response()->json([
            "success" => true,
            "message" => "All Resources records fetched successfully",
            "data" => ResourcesResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Resources resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->resourcesService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Resources records fetched successfully",
            "data" => ResourcesResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Resources resource in storage.
     *
     * @param ResourcesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ResourcesRequest $request)
    {
        $data = $this->resourcesService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Resources record created successfully",
            "data" => new ResourcesResource($data)
        ], 201);
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->resourcesService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Resources record fetched successfully",
            "data" => new ResourcesResource($data)
        ]);
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param ResourcesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ResourcesRequest $request, $id)
    {
        $data = $this->resourcesService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Resources record updated successfully",
            "data" => new ResourcesResource($data)
        ]);
    }

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->resourcesService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Resources record deleted successfully"
        ]);
    }
}
