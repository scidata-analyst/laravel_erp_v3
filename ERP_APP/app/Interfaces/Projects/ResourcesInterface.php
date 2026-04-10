<?php

namespace App\Interfaces\Projects;


/**
 * Class ResourcesInterface
 *
 * Interface for managing Resources resources.
 * Provides CRUD operations with JSON responses.
 */
interface ResourcesInterface
{
    /**
     * Display all Resources records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Resources resources.
     *
     */
    public function index();

    /**
     * Store a newly created Resources resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Resources resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
