<?php

namespace App\Repositories\CRM;

use App\Interfaces\CRM\SupportInterface;
use App\Models\CRM\Support;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SupportRepository implements SupportInterface
{
    public function all(): Collection
    {
        return Support::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Support::with(['customer', 'lead', 'assignedTo'])->paginate($perPage);
    }

    public function create(array $data): Support
    {
        return Support::create($data);
    }

    public function read(int $id): ?Support
    {
        return Support::with(['customer', 'lead', 'assignedTo', 'interactions'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $ticket = $this->read($id);
        return $ticket ? $ticket->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $ticket = $this->read($id);
        return $ticket ? $ticket->delete() : false;
    }

    public function getByCustomer(int $customerId): Collection
    {
        return Support::where('customer_id', $customerId)->get();
    }

    public function resolveTicket(int $id, string $resolution): bool
    {
        $ticket = $this->read($id);
        if (!$ticket) return false;

        return $ticket->update([
            'status' => 'resolved',
            'resolution' => $resolution,
            'resolution_date' => now()
        ]);
    }
}
