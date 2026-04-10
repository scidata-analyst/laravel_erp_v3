<?php

namespace App\Http\Controllers\QualityControl;

use App\Services\QualityControl\ComplianceService;
use App\Http\Requests\QualityControl\ComplianceStoreRequest;
use App\Http\Requests\QualityControl\ComplianceUpdateRequest;
use App\Http\Resources\QualityControl\ComplianceResource;
use App\Http\Controllers\Controller;

/**
 * Class ComplianceController
 *
 * Controller for managing Compliance resources.
 * Provides CRUD operations with JSON responses.
 */
class ComplianceController extends Controller
{
    /**
     * @var ComplianceService
     */
    protected $complianceService;

    /**
     * ComplianceController constructor.
     *
     * @param ComplianceService $complianceService
     */
    public function __construct(ComplianceService $complianceService)
    {
        $this->complianceService = $complianceService;
    }

    /**
     * Display all Compliance records without pagination.
     *
     */
    public function all()
    {
        $data = $this->complianceService->all();

        return response()->json([
            "success" => true,
            "message" => "All Compliance records fetched successfully",
            "data" => ComplianceResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Compliance resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->complianceService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Compliance records fetched successfully",
            "data" => ComplianceResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Compliance resource in storage.
     *
     * @param ComplianceStoreRequest $request
     */
    public function store(ComplianceStoreRequest $request)
    {
        $data = $this->complianceService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Compliance record created successfully",
            "data" => new ComplianceResource($data)
        ], 201);
    }

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->complianceService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Compliance record fetched successfully",
            "data" => new ComplianceResource($data)
        ]);
    }

    /**
     * Update the specified Compliance resource in storage.
     *
     * @param ComplianceUpdateRequest $request
     * @param int $id
     */
    public function update(ComplianceUpdateRequest $request, $id)
    {
        $data = $this->complianceService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Compliance record updated successfully",
            "data" => new ComplianceResource($data)
        ]);
    }

    /**
     * Remove the specified Compliance resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->complianceService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Compliance record deleted successfully"
        ]);
    }
}
