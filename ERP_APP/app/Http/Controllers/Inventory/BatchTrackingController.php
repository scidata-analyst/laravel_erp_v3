<?php

namespace App\Http\Controllers\Inventory;

use App\Services\Inventory\BatchTrackingService;
use App\Http\Requests\Inventory\BatchTrackingStoreRequest;
use App\Http\Requests\Inventory\BatchTrackingUpdateRequest;
use App\Http\Resources\Inventory\BatchTrackingResource;
use App\Http\Controllers\Controller;

/**
 * Class BatchTrackingController
 *
 * Controller for managing BatchTracking resources.
 * Provides CRUD operations with JSON responses.
 */
class BatchTrackingController extends Controller
{
    /**
     * @var BatchTrackingService
     */
    protected $batchTrackingService;

    /**
     * BatchTrackingController constructor.
     *
     * @param BatchTrackingService $batchTrackingService
     */
    public function __construct(BatchTrackingService $batchTrackingService)
    {
        $this->batchTrackingService = $batchTrackingService;
    }

    /**
     * Display all BatchTracking records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->batchTrackingService->all();

        return response()->json([
            "success" => true,
            "message" => "All BatchTracking records fetched successfully",
            "data" => BatchTrackingResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of BatchTracking resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->batchTrackingService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "BatchTracking records fetched successfully",
            "data" => BatchTrackingResource::collection($data)
        ]);
    }

    /**
     * Store a newly created BatchTracking resource in storage.
     *
     * @param BatchTrackingStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(BatchTrackingStoreRequest $request)
    {
        $data = $this->batchTrackingService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "BatchTracking record created successfully",
            "data" => new BatchTrackingResource($data)
        ], 201);
    }

    /**
     * Display the specified BatchTracking resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->batchTrackingService->show($id);

        return response()->json([
            "success" => true,
            "message" => "BatchTracking record fetched successfully",
            "data" => new BatchTrackingResource($data)
        ]);
    }

    /**
     * Update the specified BatchTracking resource in storage.
     *
     * @param BatchTrackingUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(BatchTrackingUpdateRequest $request, $id)
    {
        $data = $this->batchTrackingService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "BatchTracking record updated successfully",
            "data" => new BatchTrackingResource($data)
        ]);
    }

    /**
     * Remove the specified BatchTracking resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->batchTrackingService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "BatchTracking record deleted successfully"
        ]);
    }
}
