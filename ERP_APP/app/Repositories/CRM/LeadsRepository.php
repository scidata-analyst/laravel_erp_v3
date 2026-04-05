<?php

namespace App\Repositories\CRM;

use App\Interfaces\CRM\LeadsInterface;
use App\Models\CRM\Leads;
use App\Models\Sales\Customers;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LeadsRepository implements LeadsInterface
{
    public function all(): Collection
    {
        return Leads::all();
    }

    public function index(int $perPage = 15): LengthAwarePaginator
    {
        return Leads::with(['assignedUser'])->paginate($perPage);
    }

    public function create(array $data): Leads
    {
        return Leads::create($data);
    }

    public function read(int $id): ?Leads
    {
        return Leads::with(['assignedUser'])->find($id);
    }

    public function update(int $id, array $data): bool
    {
        $lead = $this->read($id);
        return $lead ? $lead->update($data) : false;
    }

    public function delete(int $id): bool
    {
        $lead = $this->read($id);
        return $lead ? $lead->delete() : false;
    }

    public function getByStage(string $stage): Collection
    {
        return Leads::where('stage', $stage)->get();
    }

    public function convertToCustomer(int $leadId): ?Customers
    {
        return DB::transaction(function () use ($leadId) {
            $lead = $this->read($leadId);
            if (!$lead) return null;

            $customer = Customers::create([
                'company_name' => $lead->company ?? $lead->lead_name,
                'email' => $lead->email,
                'phone' => $lead->phone,
                'status' => 'active'
            ]);

            $lead->update(['stage' => 'Closed', 'status' => 'Converted']);
            
            return $customer;
        });
    }
}