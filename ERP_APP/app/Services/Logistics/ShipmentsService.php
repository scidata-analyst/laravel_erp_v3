<?php

namespace App\Services\Logistics;

use App\Repositories\Logistics\ShipmentsRepository;
use App\Interfaces\Logistics\ShipmentsInterface;

class ShipmentsService implements ShipmentsInterface
{
    protected $repository;

    public function __construct(ShipmentsRepository $repository)
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
        return $this->repository->store($data);
    }

    public function show($id)
    {
        return $this->repository->show($id);
    }

    public function update(array $data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}