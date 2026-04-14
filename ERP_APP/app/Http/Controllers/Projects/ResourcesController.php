<?php

namespace App\Http\Controllers\Projects;

use App\Services\Projects\ResourcesService;
use App\Http\Requests\Projects\ResourcesStoreRequest;
use App\Http\Requests\Projects\ResourcesUpdateRequest;
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
     */
    public function all()
    {
        $data = $this->resourcesService->all();

        return ResourcesResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All Resources records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of Resources resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->resourcesService->index($perPage, $search, $filters);

        return view("projects.resources", compact("data"));
    }

    /**
     * Store a newly created Resources resource in storage.
     *
     * @param ResourcesStoreRequest $request
     */
    public function store(ResourcesStoreRequest $request)
    {
        $data = $this->resourcesService->store($request->validated());

        return (new ResourcesResource($data))->additional([
            'success' => true,
            'message' => 'Resources record created successfully',
        ]);
    }

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->resourcesService->show($id);

        return (new ResourcesResource($data))->additional([
            'success' => true,
            'message' => 'Resources record fetched successfully',
        ]);
    }

    /**
     * Update the specified Resources resource in storage.
     *
     * @param ResourcesUpdateRequest $request
     * @param int $id
     */
    public function update(ResourcesUpdateRequest $request, $id)
    {
        $data = $this->resourcesService->update($request->validated(), $id);

        return (new ResourcesResource($data))->additional([
            'success' => true,
            'message' => 'Resources record updated successfully',
        ]);
    }

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
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
