<?php

namespace App\Services\Projects;

use App\Repositories\Projects\ResourcesRepository;
use App\Interfaces\Projects\ResourcesInterface;

class ResourcesService implements ResourcesInterface
{
    protected $repository;

    public function __construct(ResourcesRepository $repository)
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