<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\ApArRequest;
use App\Http\Resources\Accounting\ApArResource;
use App\Services\Accounting\ApArService;
use App\DTOs\Accounting\ApArDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApArController extends Controller
{
    public function __construct(
        protected ApArService $service
    ) {}

    public function index(ApArRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $transactions = $this->service->getTransactions($perPage, $search, $filters);

        return ApArResource::collection($transactions)
            ->additional([
                'success' => true,
                'message' => 'AP/AR transactions retrieved successfully'
            ]);
    }

    public function store(ApArRequest $request): JsonResponse
    {
        $dto = ApArDTO::fromRequest($request->validated());
        $transaction = $this->service->recordTransaction($dto);

        return response()->json([
            'success' => true,
            'message' => 'AP/AR transaction recorded successfully',
            'data' => new ApArResource($transaction)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $transaction = $this->service->getTransactionById($id);
        if (!$transaction) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'AP/AR transaction retrieved successfully',
            'data' => new ApArResource($transaction)
        ]);
    }

    public function update(ApArRequest $request, int $id): JsonResponse
    {
        $dto = ApArDTO::fromRequest($request->validated());
        $success = $this->service->updateTransaction($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'AP/AR transaction updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteTransaction($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Transaction not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'AP/AR transaction deleted successfully']);
    }

    public function getBalance(string $partyName): JsonResponse
    {
        $balance = $this->service->getPartyBalance($partyName);

        return response()->json([
            'success' => true,
            'message' => 'Party balance retrieved successfully',
            'data' => [
                'party_name' => $partyName,
                'balance' => $balance
            ]
        ]);
    }
}
