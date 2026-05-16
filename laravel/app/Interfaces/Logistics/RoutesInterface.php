<?php

namespace App\Interfaces\Logistics;


/**
 * Class RoutesInterface
 *
 * Interface for managing Routes resources.
 * Provides CRUD operations with JSON responses.
 */
interface RoutesInterface
{
    /**
     * Display all Routes records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Routes resources.
     *
     */
    public function index();

    /**
     * Store a newly created Routes resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Routes resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Routes resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Routes resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
