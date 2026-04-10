<?php

namespace App\Interfaces\Documents;


/**
 * Class DocVersionsInterface
 *
 * Interface for managing DocVersions resources.
 * Provides CRUD operations with JSON responses.
 */
interface DocVersionsInterface
{
    /**
     * Display all DocVersions records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of DocVersions resources.
     *
     */
    public function index();

    /**
     * Store a newly created DocVersions resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified DocVersions resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified DocVersions resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified DocVersions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
