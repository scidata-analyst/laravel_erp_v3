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
     */
    public function all()
    {
        $data = $this->customReportsService->all();

        return CustomReportsResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All CustomReports records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of CustomReports resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 5);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->customReportsService->index($perPage, $search, $filters);

        return view("reports.custom_reports", compact("data"));
    }

    /**
     * Store a newly created CustomReports resource in storage.
     *
     * @param CustomReportsStoreRequest $request
     */
    public function store(CustomReportsStoreRequest $request)
    {
        $data = $this->customReportsService->store($request->validated());

        return (new CustomReportsResource($data))->additional([
            'success' => true,
            'message' => 'CustomReports record created successfully',
        ]);
    }

    /**
     * Display the specified CustomReports resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->customReportsService->show($id);

        return (new CustomReportsResource($data))->additional([
            'success' => true,
            'message' => 'CustomReports record fetched successfully',
        ]);
    }

    /**
     * Update the specified CustomReports resource in storage.
     *
     * @param CustomReportsUpdateRequest $request
     * @param int $id
     */
    public function update(CustomReportsUpdateRequest $request, $id)
    {
        $data = $this->customReportsService->update($request->validated(), $id);

        return (new CustomReportsResource($data))->additional([
            'success' => true,
            'message' => 'CustomReports record updated successfully',
        ]);
    }

    /**
     * Remove the specified CustomReports resource from storage.
     *
     * @param int $id
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
