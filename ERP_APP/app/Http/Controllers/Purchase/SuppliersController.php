<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchase\SuppliersRequest;
use App\Http\Resources\Purchase\SuppliersResource;
use App\Services\Purchase\SuppliersService;
use App\DTOs\Purchase\SuppliersDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SuppliersController extends Controller
{
    public function __construct(
        protected SuppliersService $service
    ) {}

    public function index(SuppliersRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $suppliers = $this->service->getSuppliers($perPage, $search, $filters);

        return SuppliersResource::collection($suppliers)
            ->additional([
                'success' => true,
                'message' => 'Suppliers retrieved successfully'
            ]);
    }

    public function store(SuppliersRequest $request): JsonResponse
    {
        $dto = SuppliersDTO::fromRequest($request->validated());
        $supplier = $this->service->createSupplier($dto);

        return response()->json([
            'success' => true,
            'message' => 'Supplier created successfully',
            'data' => new SuppliersResource($supplier)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $supplier = $this->service->getSupplierById($id);
        if (!$supplier) {
            return response()->json(['success' => false, 'message' => 'Supplier not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier retrieved successfully',
            'data' => new SuppliersResource($supplier)
        ]);
    }

    public function update(SuppliersRequest $request, int $id): JsonResponse
    {
        $dto = SuppliersDTO::fromRequest($request->validated());
        $success = $this->service->updateSupplier($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Supplier not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Supplier updated successfully'
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->service->deleteSupplier($id);

        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully'
        ]);
    }
}
