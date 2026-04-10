<?php

namespace App\Interfaces\Projects;


/**
 * Class TasksInterface
 *
 * Interface for managing Tasks resources.
 * Provides CRUD operations with JSON responses.
 */
interface TasksInterface
{
    /**
     * Display all Tasks records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Tasks resources.
     *
     */
    public function index();

    /**
     * Store a newly created Tasks resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
