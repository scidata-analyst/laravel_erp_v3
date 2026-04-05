<?php

namespace App\Repositories\Logistics;

use App\Interfaces\Logistics\ShipmentsInterface;
use App\Models\Logistics\Shipments;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ShipmentsRepository implements ShipmentsInterface
{
    public function all(): Collection
    {
        return Shipments::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Shipments::with('salesOrder')->paginate($perPage);
    }

    public function create(array $data): Shipments
    {
        return Shipments::create($data);
    }

    public function read(int $id): ?Shipments
    {
        return Shipments::with('salesOrder')->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $shipment = $this->read($id);
        return $shipment ? $shipment->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $shipment = $this->read($id);
        return $shipment ? $shipment->delete() : false;
    }

    public function updateStatus(int $id, string $status): bool
    {
        $shipment = $this->read($id);
        if (!$shipment) return false;

        $updateData = ['status' => $status];
        if ($status === 'Delivered') {
            $updateData['actual_delivery_date'] = now()->toDateString();
        }

        return $shipment->update($updateData);
    }
}
