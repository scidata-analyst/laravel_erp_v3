<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sales\InvoicesRequest;
use App\Http\Resources\Sales\InvoicesResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Services\Sales\InvoicesService;
use App\DTOs\Sales\InvoicesDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InvoicesController extends Controller
{
    public function __construct(
        protected InvoicesService $service
    ) {}

    public function index(InvoicesRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $invoices = $this->service->getInvoices($perPage, $search, $filters);

        return InvoicesResource::collection($invoices)
            ->additional([
                'success' => true,
                'message' => 'Invoices retrieved successfully'
            ]);
    }

    public function store(InvoicesRequest $request): JsonResponse
    {
        $dto = InvoicesDTO::fromRequest($request->validated());
        $invoice = $this->service->generateInvoice($dto);

        return response()->json([
            'success' => true,
            'message' => 'Invoice generated successfully',
            'data' => new InvoicesResource($invoice)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $invoice = $this->service->getInvoiceById($id);
        if (!$invoice) {
            return response()->json(['success' => false, 'message' => 'Invoice not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Invoice retrieved successfully',
            'data' => new InvoicesResource($invoice)
        ]);
    }

    public function markPaid(int $id): JsonResponse
    {
        $success = $this->service->markAsPaid($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Invoice not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Invoice marked as paid successfully'
        ]);
    }

    public function getOverdue(): JsonResponse
    {
        $invoices = $this->service->getOverdueInvoices();

        return response()->json([
            'success' => true,
            'message' => 'Overdue invoices retrieved successfully',
            'data' => InvoicesResource::collection($invoices),
            'count' => $invoices->count()
        ]);
    }
}
