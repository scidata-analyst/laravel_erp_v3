<?php

namespace App\Http\Controllers\Reports;

use App\Services\Reports\BiDashboardsService;
use App\Http\Requests\Reports\BiDashboardsStoreRequest;
use App\Http\Requests\Reports\BiDashboardsUpdateRequest;
use App\Http\Resources\Reports\BiDashboardsResource;
use App\Http\Controllers\Controller;

/**
 * Class BiDashboardsController
 *
 * Controller for managing BiDashboards resources.
 * Provides CRUD operations with JSON responses.
 */
class BiDashboardsController extends Controller
{
    /**
     * @var BiDashboardsService
     */
    protected $biDashboardsService;

    /**
     * BiDashboardsController constructor.
     *
     * @param BiDashboardsService $biDashboardsService
     */
    public function __construct(BiDashboardsService $biDashboardsService)
    {
        $this->biDashboardsService = $biDashboardsService;
    }

    /**
     * Display all BiDashboards records without pagination.
     *
     */
    public function all()
    {
        $data = $this->biDashboardsService->all();

        return BiDashboardsResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All BiDashboards records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of BiDashboards resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->biDashboardsService->index($perPage, $search, $filters);

        return view("reports.bi_dashboards", compact("data"));
    }

    /**
     * Store a newly created BiDashboards resource in storage.
     *
     * @param BiDashboardsStoreRequest $request
     */
    public function store(BiDashboardsStoreRequest $request)
    {
        $data = $this->biDashboardsService->store($request->validated());

        return (new BiDashboardsResource($data))->additional([
            'success' => true,
            'message' => 'BiDashboards record created successfully',
        ]);
    }

    /**
     * Display the specified BiDashboards resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->biDashboardsService->show($id);

        return (new BiDashboardsResource($data))->additional([
            'success' => true,
            'message' => 'BiDashboards record fetched successfully',
        ]);
    }

    /**
     * Update the specified BiDashboards resource in storage.
     *
     * @param BiDashboardsUpdateRequest $request
     * @param int $id
     */
    public function update(BiDashboardsUpdateRequest $request, $id)
    {
        $data = $this->biDashboardsService->update($request->validated(), $id);

        return (new BiDashboardsResource($data))->additional([
            'success' => true,
            'message' => 'BiDashboards record updated successfully',
        ]);
    }

    /**
     * Remove the specified BiDashboards resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->biDashboardsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "BiDashboards record deleted successfully"
        ]);
    }
}
