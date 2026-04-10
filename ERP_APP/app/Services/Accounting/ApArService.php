<?php

namespace App\Services\Accounting;

use App\Repositories\Accounting\ApArRepository;

/**
 * Class ApArService
 *
 * Service for managing ApAr resources.
 * Provides business logic and delegates to repository.
 */
class ApArService
{
    /**
     * @var ApArRepository
     */
    protected $repository;

    /**
     * ApArService constructor.
     *
     * @param ApArRepository $repository
     */
    public function __construct(ApArRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display all ApAr records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->repository->all();
    }

    /**
     * Display a paginated listing of ApAr resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created ApAr resource in storage.
     *
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    /**
     * Display the specified ApAr resource.
     *
     * @param int $id
     * @return \App\Models\Accounting\ApAr
     */
    public function show($id)
    {
        return $this->repository->show($id);
    }

    /**
     * Update the specified ApAr resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\Accounting\ApAr
     */
    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    /**
     * Remove the specified ApAr resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
