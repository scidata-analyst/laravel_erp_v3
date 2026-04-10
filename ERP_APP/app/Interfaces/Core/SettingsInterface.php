<?php

namespace App\Interfaces\Core;


/**
 * Class SettingsInterface
 *
 * Interface for managing Settings resources.
 * Provides CRUD operations with JSON responses.
 */
interface SettingsInterface
{
    /**
     * Display all Settings records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of Settings resources.
     *
     */
    public function index();

    /**
     * Store a newly created Settings resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified Settings resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Settings resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
