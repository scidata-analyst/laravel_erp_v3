<?php

namespace App\Http\Controllers\Reports;

use App\Services\Reports\CustomReportsService;
use App\Http\Requests\Reports\CustomReportsStoreRequest;
use App\Http\Requests\Reports\CustomReportsUpdateRequest;
use App\Http\Resources\Reports\CustomReportsResource;
use App\Http\Controllers\Controller;

/**
 * Class CustomReportsController
 *
 * Controller for managing CustomReports resources.
 * Provides CRUD operations with JSON responses.
 */
class CustomReportsController extends Controller
{
    /**
     * @var CustomReportsService
     */
    protected $customReportsService;

    /**
     * CustomReportsController constructor.
     *
     * @param CustomReportsService $customReportsService
     */
    public function __construct(CustomReportsService $customReportsService)
    {
        $this->customReportsService = $customReportsService;
    }

    /**
     * Display all CustomReports records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->customReportsService->all();

        return response()->json([
            "success" => true,
            "message" => "All CustomReports records fetched successfully",
            "data" => CustomReportsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of CustomReports resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->customReportsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "CustomReports records fetched successfully",
            "data" => CustomReportsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created CustomReports resource in storage.
     *
     * @param CustomReportsStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CustomReportsStoreRequest $request)
    {
        $data = $this->customReportsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "CustomReports record created successfully",
            "data" => new CustomReportsResource($data)
        ], 201);
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->customReportsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "CustomReports record fetched successfully",
            "data" => new CustomReportsResource($data)
        ]);
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param CustomReportsUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(CustomReportsUpdateRequest $request, $id)
    {
        $data = $this->customReportsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "CustomReports record updated successfully",
            "data" => new CustomReportsResource($data)
        ]);
    }

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->customReportsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "CustomReports record deleted successfully"
        ]);
    }
}
