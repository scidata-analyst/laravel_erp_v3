<?php

namespace App\Http\Controllers\QualityControl;

use App\Services\QualityControl\ComplianceService;
use App\Http\Requests\QualityControl\ComplianceRequest;
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
     * Display a paginated listing of Compliance resources.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Display all Compliance records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
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
     * Store a newly created Compliance resource in storage.
     *
     * @param ComplianceRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ComplianceRequest $request)
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
     * @return \Illuminate\Http\JsonResponse
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
     * @param ComplianceRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ComplianceRequest $request, $id)
    {
        $data = $this->complianceService->update($id, $request->validated());

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
     * @return \Illuminate\Http\JsonResponse
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
