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

        return FinReportsResource::collection($data)->additional([
            'success' => true,
            'message' => 'All FinReports records fetched successfully',
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

        return view("accounting.fin_reports", compact("data"));
    }

    /**
     * Store a newly created FinReports resource in storage.
     *
     * @param FinReportsStoreRequest $request
     */
    public function store(FinReportsStoreRequest $request)
    {
        $data = $this->finReportsService->store($request->validated());

        return (new FinReportsResource($data))->additional([
            'success' => true,
            'message' => 'FinReports record created successfully',
        ]);
    }

    /**
     * Display the specified FinReports resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->finReportsService->show($id);

        return (new FinReportsResource($data))->additional([
            'success' => true,
            'message' => 'FinReports record fetched successfully',
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

        return (new FinReportsResource($data))->additional([
            'success' => true,
            'message' => 'FinReports record updated successfully',
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
