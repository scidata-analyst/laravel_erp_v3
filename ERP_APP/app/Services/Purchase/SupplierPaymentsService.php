<?php

namespace App\Services\Purchase;

use App\Interfaces\Purchase\SupplierPaymentsInterface;
use App\DTOs\Purchase\SupplierPaymentsDTO;
use App\Models\Purchase\SupplierPayments;
use App\Models\Purchase\PurchaseOrders;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SupplierPaymentsService
{
    public function __construct(
        protected SupplierPaymentsInterface $repository
    ) {}

    public function getPayments(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function recordPayment(SupplierPaymentsDTO $dto): SupplierPayments
    {
        return DB::transaction(function () use ($dto) {
            $data = $dto->toArray();
            $data['payment_number'] = $data['payment_number'] ?? $this->generatePaymentNumber();
            $data['status'] = $data['status'] ?? 'completed';
            $data['approved_by'] = $data['approved_by'] ?? optional(auth()->user())->id;

            $payment = $this->repository->create($data);

            $order = PurchaseOrders::find($dto->purchase_order_id);
            if ($order && $payment->status === 'completed') {
                $order->status = $order->status === 'received' ? 'received' : 'approved';
                $order->save();
            }

            return $payment;
        });
    }

    public function getPaymentById(int $id): ?SupplierPayments
    {
        return $this->repository->read($id);
    }

    public function getPaymentsBySupplier(int $supplierId): Collection
    {
        return $this->repository->getBySupplier($supplierId);
    }

    public function updatePayment(int $id, SupplierPaymentsDTO $dto): bool
    {
        $payment = $this->repository->read($id);

        if (!$payment) {
            return false;
        }

        $data = $dto->toArray();
        $data['approved_by'] = $data['approved_by'] ?? $payment->approved_by ?? optional(auth()->user())->id;

        return $this->repository->update($id, array_filter($data, static fn ($value) => $value !== null));
    }

    public function deletePayment(int $id): bool
    {
        return $this->repository->delete($id);
    }

    protected function generatePaymentNumber(): string
    {
        do {
            $number = 'PAY-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
        } while (SupplierPayments::where('payment_number', $number)->exists());

        return $number;
    }
}
