<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\HR\EmployeesRequest;
use App\Http\Resources\HR\EmployeesResource;
use App\Services\HR\EmployeesService;
use App\DTOs\HR\EmployeesDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EmployeesController extends Controller
{
    public function __construct(
        protected EmployeesService $service
    ) {}

    public function index(EmployeesRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $employees = $this->service->getEmployees($perPage, $search, $filters);

        return EmployeesResource::collection($employees)
            ->additional([
                'success' => true,
                'message' => 'Employees retrieved successfully'
            ]);
    }

    public function store(EmployeesRequest $request): JsonResponse
    {
        $dto = EmployeesDTO::fromRequest($request->validated());
        $employee = $this->service->createEmployee($dto);

        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'data' => new EmployeesResource($employee)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $employee = $this->service->getEmployeeById($id);
        if (!$employee) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee retrieved successfully',
            'data' => new EmployeesResource($employee)
        ]);
    }

    public function update(EmployeesRequest $request, int $id): JsonResponse
    {
        $dto = EmployeesDTO::fromRequest($request->validated());
        $success = $this->service->updateEmployee($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteEmployee($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Employee not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ]);
    }
}
