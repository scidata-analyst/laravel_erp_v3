<?php

namespace App\Interfaces\UsersRoles;


/**
 * Class UserInterface
 *
 * Interface for managing User resources.
 * Provides CRUD operations with JSON responses.
 */
interface UserInterface
{
    /**
     * Display all User records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of User resources.
     *
     */
    public function index();

    /**
     * Store a newly created User resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified User resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified User resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified User resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
