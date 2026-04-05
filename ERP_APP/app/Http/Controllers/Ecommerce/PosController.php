<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ecommerce\PosRequest;
use App\Http\Resources\Ecommerce\PosResource;
use App\Services\Ecommerce\PosService;
use App\DTOs\Ecommerce\PosDTO;
use App\Models\Ecommerce\PosTransactions;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PosController extends Controller
{
    public function __construct(
        protected PosService $service
    ) {}

    public function index(PosRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $terminals = $this->service->getPosTerminals($perPage, $search, $filters);

        return PosResource::collection($terminals)
            ->additional([
                'success' => true,
                'message' => 'POS terminals retrieved successfully'
            ]);
    }

    public function store(PosRequest $request): JsonResponse
    {
        $dto = PosDTO::fromRequest($request->validated());
        $terminal = $this->service->createPosTerminal($dto);

        return response()->json([
            'success' => true,
            'message' => 'POS terminal created successfully',
            'data' => new PosResource($terminal)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $terminal = $this->service->getPosTerminalById($id);
        if (!$terminal) {
            return response()->json(['success' => false, 'message' => 'POS terminal not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'POS terminal retrieved successfully',
            'data' => new PosResource($terminal)
        ]);
    }

    public function update(PosRequest $request, int $id): JsonResponse
    {
        $dto = PosDTO::fromRequest($request->validated());
        $success = $this->service->updatePosTerminal($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'POS terminal not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'POS terminal updated successfully',
            'data' => new PosResource($this->service->getPosTerminalById($id))
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deletePosTerminal($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'POS terminal not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'POS terminal deleted successfully'
        ]);
    }

    public function dailySummary(Request $request): JsonResponse
    {
        $date = $request->get('date', now()->toDateString());
        $totalSales = (float) PosTransactions::whereDate('transaction_date', $date)
            ->orWhereDate('created_at', $date)
            ->sum('total_amount');
        $totalTransactions = PosTransactions::whereDate('transaction_date', $date)
            ->orWhereDate('created_at', $date)
            ->count();
        $activeTerminals = $this->service->getActiveTerminalCount();
        $averageTransaction = $totalTransactions > 0 ? $totalSales / $totalTransactions : 0;

        return response()->json([
            'success' => true,
            'message' => 'Daily POS summary retrieved successfully',
            'data' => [
                'date' => $date,
                'total_sales' => number_format($totalSales, 2, '.', ''),
                'total_transactions' => $totalTransactions,
                'active_terminals' => $activeTerminals,
                'avg_transaction' => number_format($averageTransaction, 2, '.', ''),
            ]
        ]);
    }
}
