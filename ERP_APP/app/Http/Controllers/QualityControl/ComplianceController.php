<?php

namespace App\Http\Controllers\QualityControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualityControl\ComplianceRequest;
use App\Http\Resources\QualityControl\ComplianceResource;
use App\Services\QualityControl\ComplianceService;
use App\DTOs\QualityControl\ComplianceDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ComplianceController extends Controller
{
    public function __construct(
        protected ComplianceService $service
    ) {}

    public function index(ComplianceRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $standards = $this->service->getComplianceStandards($perPage, $search, $filters);

        return ComplianceResource::collection($standards)
            ->additional([
                'success' => true,
                'message' => 'Compliance standards retrieved successfully'
            ]);
    }

    public function store(ComplianceRequest $request): JsonResponse
    {
        $dto = ComplianceDTO::fromRequest($request->validated());
        $standard = $this->service->addStandard($dto);

        return response()->json([
            'success' => true,
            'message' => 'Compliance standard added successfully',
            'data' => new ComplianceResource($standard)
        ], 201);
    }

    public function active(): JsonResponse
    {
        $standards = $this->service->getActiveComplianceItems();

        return response()->json([
            'success' => true,
            'message' => 'Active compliance standards retrieved successfully',
            'data' => ComplianceResource::collection($standards)
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $standard = $this->service->getStandardById($id);
        if (!$standard) {
            return response()->json(['success' => false, 'message' => 'Compliance standard not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Compliance standard retrieved successfully',
            'data' => new ComplianceResource($standard)
        ]);
    }

    public function update(ComplianceRequest $request, int $id): JsonResponse
    {
        $dto = ComplianceDTO::fromRequest($request->validated());
        $success = $this->service->updateStandard($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Compliance standard not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Compliance standard updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteStandard($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Compliance standard not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Compliance standard deleted successfully']);
    }
}
