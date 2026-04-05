<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\TaxRequest;
use App\Http\Resources\Accounting\TaxResource;
use App\Services\Accounting\TaxService;
use App\DTOs\Accounting\TaxDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaxController extends Controller
{
    public function __construct(
        protected TaxService $service
    ) {}

    public function index(TaxRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $taxes = $this->service->getTaxes($perPage, $search, $filters);

        return TaxResource::collection($taxes)
            ->additional([
                'success' => true,
                'message' => 'Tax configurations retrieved successfully'
            ]);
    }

    public function store(TaxRequest $request): JsonResponse
    {
        $dto = TaxDTO::fromRequest($request->validated());
        $tax = $this->service->createTax($dto);

        return response()->json([
            'success' => true,
            'message' => 'Tax configuration created successfully',
            'data' => new TaxResource($tax)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $tax = $this->service->getTaxById($id);
        if (!$tax) {
            return response()->json(['success' => false, 'message' => 'Tax configuration not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tax configuration retrieved successfully',
            'data' => new TaxResource($tax),
        ]);
    }

    public function update(TaxRequest $request, int $id): JsonResponse
    {
        $dto = TaxDTO::fromRequest($request->validated());
        $success = $this->service->updateTax($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Tax configuration not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tax configuration updated successfully',
            'data' => new TaxResource($this->service->getTaxById($id)),
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteTax($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Tax configuration not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tax configuration deleted successfully',
        ]);
    }

    public function calculate(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric',
            'tax_id' => 'nullable|integer',
            'rate' => 'nullable|numeric|min:0',
        ]);

        if (!empty($validated['tax_id'])) {
            $taxAmount = $this->service->calculateTax((float) $validated['amount'], (int) $validated['tax_id']);
        } else {
            $rate = (float) ($validated['rate'] ?? 0);
            $taxAmount = ((float) $validated['amount']) * ($rate / 100);
        }

        return response()->json([
            'success' => true,
            'message' => 'Tax calculated successfully',
            'data' => [
                'amount' => $validated['amount'],
                'tax_amount' => $taxAmount,
                'total_amount' => ((float) $validated['amount']) + $taxAmount
            ]
        ]);
    }
}
