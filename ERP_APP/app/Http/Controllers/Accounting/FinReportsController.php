<?php

namespace App\Http\Controllers\Accounting;

use App\Services\Accounting\FinReportsService;
use App\Http\Requests\Accounting\FinReportsStoreRequest;
use App\Http\Requests\Accounting\FinReportsUpdateRequest;
use App\Http\Resources\Accounting\FinReportsResource;
use App\Http\Controllers\Controller;

/**
 * Class FinReportsController
 *
 * Controller for managing FinReports resources.
 * Provides CRUD operations with JSON responses.
 */
class FinReportsController extends Controller
{
    /**
     * @var FinReportsService
     */
    protected $finReportsService;

    /**
     * FinReportsController constructor.
     *
     * @param FinReportsService $finReportsService
     */
    public function __construct(FinReportsService $finReportsService)
    {
        $this->finReportsService = $finReportsService;
    }

    /**
     * Display all FinReports records without pagination.
     *
     */
    public function all()
    {
        $data = $this->finReportsService->all();

        return response()->json([
            "success" => true,
            "message" => "All FinReports records fetched successfully",
            "data" => FinReportsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of FinReports resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->finReportsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "FinReports records fetched successfully",
            "data" => FinReportsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created FinReports resource in storage.
     *
     * @param FinReportsStoreRequest $request
     */
    public function store(FinReportsStoreRequest $request)
    {
        $data = $this->finReportsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "FinReports record created successfully",
            "data" => new FinReportsResource($data)
        ], 201);
    }

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->finReportsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "FinReports record fetched successfully",
            "data" => new FinReportsResource($data)
        ]);
    }

    /**
     * Update the specified FinReports resource in storage.
     *
     * @param FinReportsUpdateRequest $request
     * @param int $id
     */
    public function update(FinReportsUpdateRequest $request, $id)
    {
        $data = $this->finReportsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "FinReports record updated successfully",
            "data" => new FinReportsResource($data)
        ]);
    }

    /**
     * Remove the specified FinReports resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->finReportsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "FinReports record deleted successfully"
        ]);
    }
}
