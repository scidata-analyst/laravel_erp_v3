<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\LeadsRequest;
use App\Http\Resources\CRM\LeadsResource;
use App\Services\CRM\LeadsService;
use App\DTOs\CRM\LeadsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class LeadsController extends Controller
{
    public function __construct(
        protected LeadsService $service
    ) {}

    public function index(LeadsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $leads = $this->service->getLeads($perPage, $search, $filters);

        return LeadsResource::collection($leads)
            ->additional([
                'success' => true,
                'message' => 'Leads retrieved successfully'
            ]);
    }

    public function store(LeadsRequest $request): JsonResponse
    {
        $dto = LeadsDTO::fromRequest($request->validated());
        $lead = $this->service->createLead($dto);

        return response()->json([
            'success' => true,
            'message' => 'Lead created successfully',
            'data' => new LeadsResource($lead)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $lead = $this->service->getLeadById($id);
        if (!$lead) {
            return response()->json(['success' => false, 'message' => 'Lead not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lead retrieved successfully',
            'data' => new LeadsResource($lead)
        ]);
    }

    public function update(LeadsRequest $request, int $id): JsonResponse
    {
        $dto = LeadsDTO::fromRequest($request->validated());
        $success = $this->service->updateLead($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Lead not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Lead updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteLead($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Lead not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Lead deleted successfully']);
    }

    public function convert(int $id): JsonResponse
    {
        $customer = $this->service->convertToCustomer($id);

        if (!$customer) {
            return response()->json(['success' => false, 'message' => 'Lead not found or conversion failed'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lead converted to customer successfully',
            'data' => $customer
        ]);
    }
}
