<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\HR\PayrollRequest;
use App\Http\Resources\HR\PayrollResource;
use App\Services\HR\PayrollService;
use App\DTOs\HR\PayrollDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PayrollController extends Controller
{
    public function __construct(
        protected PayrollService $service
    ) {}

    public function index(PayrollRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $payrolls = $this->service->getPayrolls($perPage, $search, $filters);

        return PayrollResource::collection($payrolls)
            ->additional([
                'success' => true,
                'message' => 'Payrolls retrieved successfully'
            ]);
    }

    public function store(PayrollRequest $request): JsonResponse
    {
        $dto = PayrollDTO::fromRequest($request->validated());
        $payroll = $this->service->processPayroll($dto);

        return response()->json([
            'success' => true,
            'message' => 'Payroll processed successfully',
            'data' => new PayrollResource($payroll)
        ], 201);
    }

    public function generate(Request $request): JsonResponse
    {
        $request->validate([
            'period_start' => 'required|date',
            'period_end' => 'required|date'
        ]);

        $payrolls = $this->service->generatePayrollForPeriod($request->period_start, $request->period_end);

        return response()->json([
            'success' => true,
            'message' => 'Payrolls generated successfully for the period',
            'count' => count($payrolls)
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $payroll = $this->service->getPayrollById($id);
        if (!$payroll) {
            return response()->json(['success' => false, 'message' => 'Payroll not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payroll retrieved successfully',
            'data' => new PayrollResource($payroll)
        ]);
    }

    public function update(PayrollRequest $request, int $id): JsonResponse
    {
        $dto = PayrollDTO::fromRequest($request->validated());
        $success = $this->service->updatePayroll($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Payroll not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Payroll updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deletePayroll($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Payroll not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Payroll deleted successfully']);
    }
}
