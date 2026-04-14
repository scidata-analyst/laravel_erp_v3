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
     */
    public function all()
    {
        $data = $this->batchTrackingService->all();

        return BatchTrackingResource::collection($data)->additional(['success' => true, 'message' => 'All BatchTracking records fetched successfully']);
    }

    /**
     * Display a paginated listing of BatchTracking resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->batchTrackingService->index($perPage, $search, $filters);

        return view("inventory.batch_tracking", compact("data"));
    }

    /**
     * Store a newly created BatchTracking resource in storage.
     *
     * @param BatchTrackingStoreRequest $request
     */
    public function store(BatchTrackingStoreRequest $request)
    {
        $data = $this->batchTrackingService->store($request->validated());

        return (new BatchTrackingResource($data))->additional(['success' => true, 'message' => 'BatchTracking record created successfully']);
    }

    /**
     * Display the specified BatchTracking resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->batchTrackingService->show($id);

        return (new BatchTrackingResource($data))->additional(['success' => true, 'message' => 'BatchTracking record fetched successfully']);
    }

    /**
     * Update the specified BatchTracking resource in storage.
     *
     * @param BatchTrackingUpdateRequest $request
     * @param int $id
     */
    public function update(BatchTrackingUpdateRequest $request, $id)
    {
        $data = $this->batchTrackingService->update($request->validated(), $id);

        return (new BatchTrackingResource($data))->additional(['success' => true, 'message' => 'BatchTracking record updated successfully']);
    }

    /**
     * Remove the specified BatchTracking resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->batchTrackingService->destroy($id);

        return response()->json(["success" => true, "message" => "BatchTracking record deleted successfully"]);
    }
}
