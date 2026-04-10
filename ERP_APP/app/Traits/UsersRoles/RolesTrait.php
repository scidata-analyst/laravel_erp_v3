<?php

namespace App\Traits\UsersRoles;

use App\Services\UsersRoles\RolesService;

trait RolesTrait
{
    /**
     * @var RolesService
     */
    protected $service;

    /**
     * Set the service for this trait.
     *
     * @param RolesService $service
     * @return $this
     */
    public function setRolesService(RolesService $service)
    {
        $this->service = $service;
        return $this;
    }

    /**
     * Display all Roles records without pagination.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->service->all();
    }

    /**
     * Display a paginated listing of Roles resources.
     *
     * @param int $perPage
     * @param string $search
     * @param array $filters
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index($perPage = 15, $search = '', $filters = [])
    {
        return $this->service->index($perPage, $search, $filters);
    }

    /**
     * Store a newly created Roles resource in storage.
     *
     * @param array $data
     * @return \App\Models\UsersRoles\Roles
     */
    public function store(array $data)
    {
        return $this->service->store($data);
    }

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     * @return \App\Models\UsersRoles\Roles
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified Roles resource in storage.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\UsersRoles\Roles
     */
    public function update(array $data, $id)
    {
        return $this->service->update($data, $id);
    }

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     * @return bool
     */
    public function destroy($id)
    {
        return $this->service->destroy($id);
    }
}