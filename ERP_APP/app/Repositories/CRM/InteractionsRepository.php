<?php

namespace App\Repositories\CRM;

use App\Interfaces\CRM\InteractionsInterface;
use App\Models\CRM\Interactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class InteractionsRepository implements InteractionsInterface
{
    public function all(): Collection
    {
        return Interactions::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Interactions::with(['lead', 'customer', 'salesOrder', 'supportTicket', 'assignedTo', 'createdBy'])->paginate($perPage);
    }

    public function create(array $data): Interactions
    {
        return Interactions::create($data);
    }

    public function read(int $id): ?Interactions
    {
        return Interactions::with(['lead', 'customer', 'salesOrder', 'supportTicket', 'assignedTo', 'createdBy'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $interaction = $this->read($id);
        return $interaction ? $interaction->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $interaction = $this->read($id);
        return $interaction ? $interaction->delete() : false;
    }

    public function getBySubject(int $id, string $type): Collection
    {
        $column = match ($type) {
            'lead' => 'lead_id',
            'customer' => 'customer_id',
            'sales_order' => 'sales_order_id',
            'support' => 'support_ticket_id',
            default => null,
        };

        if ($column === null) {
            return collect();
        }

        return Interactions::where($column, $id)->get();
    }
}
