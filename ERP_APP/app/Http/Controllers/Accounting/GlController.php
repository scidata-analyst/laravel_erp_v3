<?php

namespace App\Http\Controllers\Accounting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Accounting\GlRequest;
use App\Http\Resources\Accounting\GlResource;
use App\Services\Accounting\GlService;
use App\DTOs\Accounting\GlDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GlController extends Controller
{
    public function __construct(
        protected GlService $service
    ) {}

    public function index(GlRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $entries = $this->service->getEntries($perPage, $search, $filters);

        return GlResource::collection($entries)
            ->additional([
                'success' => true,
                'message' => 'General Ledger entries retrieved successfully'
            ]);
    }

    public function store(GlRequest $request): JsonResponse
    {
        $dto = GlDTO::fromRequest($request->validated());
        $entry = $this->service->recordEntry($dto);

        return response()->json([
            'success' => true,
            'message' => 'GL entry recorded successfully',
            'data' => new GlResource($entry)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $entry = $this->service->getEntryById($id);
        if (!$entry) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'GL entry retrieved successfully',
            'data' => new GlResource($entry)
        ]);
    }

    public function update(GlRequest $request, int $id): JsonResponse
    {
        $dto = GlDTO::fromRequest($request->validated());
        $success = $this->service->updateEntry($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'GL entry updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteEntry($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Entry not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'GL entry deleted successfully']);
    }

    public function getBalance(string $accountName): JsonResponse
    {
        $balance = $this->service->getAccountBalance($accountName);

        return response()->json([
            'success' => true,
            'message' => 'Account balance retrieved successfully',
            'data' => [
                'account_name' => $accountName,
                'balance' => $balance
            ]
        ]);
    }

    public function getTrialBalance(): JsonResponse
    {
        $trialBalance = $this->service->getTrialBalance();

        return response()->json([
            'success' => true,
            'message' => 'Trial balance retrieved successfully',
            'data' => $trialBalance
        ]);
    }

    public function getGlStats(): JsonResponse
    {
        $stats = $this->service->getAccountingStats();

        return response()->json([
            'success' => true,
            'message' => 'GL accounting statistics retrieved successfully',
            'data' => $stats
        ]);
    }
}
