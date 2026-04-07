<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\PerformanceService;
use App\Http\Requests\HR\PerformanceRequest;
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
     * Display a paginated listing of Performance resources.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Display all Performance records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Store a newly created Performance resource in storage.
     *
     * @param PerformanceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PerformanceRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param PerformanceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PerformanceRequest $request, $id)
    {
        $data = $this->performanceService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
