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

        return ComplianceResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All Compliance records fetched successfully',
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

        return view("quality_control.compliance", compact("data"));
    }

    /**
     * Store a newly created Compliance resource in storage.
     *
     * @param ComplianceStoreRequest $request
     */
    public function store(ComplianceStoreRequest $request)
    {
        $data = $this->complianceService->store($request->validated());

        return (new ComplianceResource($data))->additional([
            'success' => true,
            'message' => 'Compliance record created successfully',
        ]);
    }

    /**
     * Display the specified Compliance resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->complianceService->show($id);

        return (new ComplianceResource($data))->additional([
            'success' => true,
            'message' => 'Compliance record fetched successfully',
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

        return (new ComplianceResource($data))->additional([
            'success' => true,
            'message' => 'Compliance record updated successfully',
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
