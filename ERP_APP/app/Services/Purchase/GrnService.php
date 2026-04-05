<?php

namespace App\Services\Purchase;

use App\Interfaces\Purchase\GrnInterface;
use App\DTOs\Purchase\GrnDTO;
use App\Models\Purchase\Grn;
use App\Models\Purchase\GrnItems;
use App\Models\Purchase\PurchaseOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GrnService
{
    public function __construct(
        protected GrnInterface $repository
    ) {}

    public function getGrns(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function receiveGoods(GrnDTO $dto): Grn
    {
        return DB::transaction(function () use ($dto) {
            $order = PurchaseOrders::findOrFail($dto->purchase_order_id);
            $items = is_array($dto->items) ? $dto->items : [];

            $grn = $this->repository->create([
                'grn_number' => $dto->grn_number ?: $this->generateGrnNumber(),
                'purchase_order_id' => $dto->purchase_order_id,
                'supplier_id' => $dto->supplier_id ?? $order->supplier_id,
                'received_date' => $dto->received_date,
                'received_by' => is_numeric($dto->received_by) ? (int) $dto->received_by : optional(auth()->user())->id,
                'total_items' => count($items),
                'total_quantity' => (int) collect($items)->sum(fn ($item) => (float) ($item['quantity_received'] ?? $item['quantity'] ?? 0)),
                'status' => $dto->status ?? 'completed',
                'notes' => $dto->notes,
            ]);

            foreach ($items as $item) {
                $grn->items()->create([
                    'product_name' => $item['product_name'] ?? null,
                    'sku' => $item['sku'] ?? null,
                    'quantity_ordered' => $item['quantity_ordered'] ?? $item['quantity'] ?? 0,
                    'quantity_received' => $item['quantity_received'] ?? $item['quantity'] ?? 0,
                    'unit_price' => $item['unit_price'] ?? 0,
                    'total_value' => $item['total_value'] ?? (($item['quantity_received'] ?? $item['quantity'] ?? 0) * ($item['unit_price'] ?? 0)),
                    'batch_number' => $item['batch_number'] ?? null,
                    'expiry_date' => $item['expiry_date'] ?? null,
                    'notes' => $item['notes'] ?? null,
                ]);
            }

            $order->status = 'received';
            $order->save();

            return $grn;
        });
    }

    public function getGrnById(int $id): ?Grn
    {
        return $this->repository->read($id);
    }

    public function updateGrn(int $id, GrnDTO $dto): bool
    {
        $grn = $this->repository->read($id);

        if (!$grn) {
            return false;
        }

        $items = is_array($dto->items) && $dto->items ? $dto->items : $grn->items->map(function (GrnItems $item) {
            return [
                'quantity_received' => $item->quantity_received,
            ];
        })->all();

        return $this->repository->update($id, [
            'purchase_order_id' => $dto->purchase_order_id,
            'supplier_id' => $dto->supplier_id ?? $grn->supplier_id,
            'received_date' => $dto->received_date,
            'received_by' => is_numeric($dto->received_by) ? (int) $dto->received_by : $grn->received_by,
            'total_items' => count($items),
            'total_quantity' => (int) collect($items)->sum(fn ($item) => (float) ($item['quantity_received'] ?? 0)),
            'status' => $dto->status ?? $grn->status,
            'notes' => $dto->notes,
        ]);
    }

    public function deleteGrn(int $id): bool
    {
        return $this->repository->delete($id);
    }

    protected function generateGrnNumber(): string
    {
        do {
            $number = 'GRN-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
        } while (Grn::where('grn_number', $number)->exists());

        return $number;
    }
}
