<?php

namespace App\Http\Controllers\HR;

use App\Services\HR\PayrollService;
use App\Http\Requests\HR\PayrollStoreRequest;
use App\Http\Requests\HR\PayrollUpdateRequest;
use App\Http\Resources\HR\PayrollResource;
use App\Http\Controllers\Controller;

/**
 * Class PayrollController
 *
 * Controller for managing Payroll resources.
 * Provides CRUD operations with JSON responses.
 */
class PayrollController extends Controller
{
    /**
     * @var PayrollService
     */
    protected $payrollService;

    /**
     * PayrollController constructor.
     *
     * @param PayrollService $payrollService
     */
    public function __construct(PayrollService $payrollService)
    {
        $this->payrollService = $payrollService;
    }

    /**
     * Display all Payroll records without pagination.
     *
     */
    public function all()
    {
        $data = $this->payrollService->all();

        return PayrollResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All Payroll records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of Payroll resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->payrollService->index($perPage, $search, $filters);

        return view("hr.payroll", compact("data"));
    }

    /**
     * Store a newly created Payroll resource in storage.
     *
     * @param PayrollStoreRequest $request
     */
    public function store(PayrollStoreRequest $request)
    {
        $data = $this->payrollService->store($request->validated());

        return (new PayrollResource($data))->additional([
            'success' => true,
            'message' => 'Payroll record created successfully',
        ]);
    }

    /**
     * Display the specified Payroll resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->payrollService->show($id);

        return (new PayrollResource($data))->additional([
            'success' => true,
            'message' => 'Payroll record fetched successfully',
        ]);
    }

    /**
     * Update the specified Payroll resource in storage.
     *
     * @param PayrollUpdateRequest $request
     * @param int $id
     */
    public function update(PayrollUpdateRequest $request, $id)
    {
        $data = $this->payrollService->update($request->validated(), $id);

        return (new PayrollResource($data))->additional([
            'success' => true,
            'message' => 'Payroll record updated successfully',
        ]);
    }

    /**
     * Remove the specified Payroll resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->payrollService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Payroll record deleted successfully"
        ]);
    }
}
