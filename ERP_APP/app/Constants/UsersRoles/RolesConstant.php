<?php

namespace App\Constants\UsersRoles;

use App\Models\UsersRoles\Roles;

/**
 * Class RolesConstant
 *
 * Constant for managing Roles resources.
 * Provides CRUD operations with JSON responses.
 */
class RolesConstant
{
    /**
     * @var RolesConstant
     */
    protected $rolesConstant;

    /**
     * RolesConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Roles records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->rolesConstant->all();
    }

    /**
     * Display a paginated listing of Roles resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Roles resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Roles resource in storage.
     *
     * @param RolesRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
