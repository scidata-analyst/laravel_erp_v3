<?php

namespace App\Interfaces\UsersRoles;


/**
 * Class RolesInterface
 *
 * Interface for managing Roles resources.
 * Provides CRUD operations with JSON responses.
 */
interface RolesInterface
{
    /**
     * Display all Roles records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Roles resources.
     *
     */
    public function index();

    /**
     * Store a newly created Roles resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Roles resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Roles resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Roles resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
