<?php

namespace App\Services\Inventory;

use App\Repositories\Inventory\StockValuationRepository;
use App\Interfaces\Inventory\StockValuationInterface;

class StockValuationService implements StockValuationInterface
{
    protected $repository;

    public function __construct(StockValuationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function index($perPage = 15, $search = '', $filters = [])
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function store(array $data)
    {
        // Calculate total_value automatically
        $data['total_value'] = ($data['quantity_on_hand'] ?? 0) * ($data['unit_cost'] ?? 0);
        return $this->repository->store($data);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(array $data, $id)
    {
        // Recalculate total_value if quantity or unit_cost changed
        if (isset($data['quantity_on_hand']) || isset($data['unit_cost'])) {
            $record = $this->repository->show($id);
            $quantity = $data['quantity_on_hand'] ?? $record->quantity_on_hand;
            $unitCost = $data['unit_cost'] ?? $record->unit_cost;
            $data['total_value'] = $quantity * $unitCost;
        }
        return $this->repository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}