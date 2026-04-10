<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\PerformanceService;
use App\Http\Requests\HR\PerformanceStoreRequest;
use App\Http\Requests\HR\PerformanceUpdateRequest;
use App\Http\Resources\HR\PerformanceResource;
use App\Http\Controllers\Controller;

/**
 * Class PerformanceController
 *
 * Controller for managing Performance resources.
 * Provides CRUD operations with JSON responses.
 */
class PerformanceController extends Controller
{
    /**
     * @var PerformanceService
     */
    protected $performanceService;

    /**
     * PerformanceController constructor.
     *
     * @param PerformanceService $performanceService
     */
    public function __construct(PerformanceService $performanceService)
    {
        $this->performanceService = $performanceService;
    }

    /**
     * Display all Performance records without pagination.
     *
     */
    public function all()
    {
        $data = $this->performanceService->all();

        return response()->json([
            "success" => true,
            "message" => "All Performance records fetched successfully",
            "data" => PerformanceResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Performance resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->performanceService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Performance records fetched successfully",
            "data" => PerformanceResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Performance resource in storage.
     *
     * @param PerformanceStoreRequest $request
     */
    public function store(PerformanceStoreRequest $request)
    {
        $data = $this->performanceService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Performance record created successfully",
            "data" => new PerformanceResource($data)
        ], 201);
    }

    /**
     * Display the specified Performance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->performanceService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Performance record fetched successfully",
            "data" => new PerformanceResource($data)
        ]);
    }

    /**
     * Update the specified Performance resource in storage.
     *
     * @param PerformanceUpdateRequest $request
     * @param int $id
     */
    public function update(PerformanceUpdateRequest $request, $id)
    {
        $data = $this->performanceService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Performance record updated successfully",
            "data" => new PerformanceResource($data)
        ]);
    }

    /**
     * Remove the specified Performance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->performanceService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Performance record deleted successfully"
        ]);
    }
}
