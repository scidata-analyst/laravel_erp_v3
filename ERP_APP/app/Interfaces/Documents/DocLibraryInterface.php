<?php

namespace App\Interfaces\Documents;


/**
 * Class DocLibraryInterface
 *
 * Interface for managing DocLibrary resources.
 * Provides CRUD operations with JSON responses.
 */
interface DocLibraryInterface
{
    /**
     * Display all DocLibrary records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of DocLibrary resources.
     *
     */
    public function index();

    /**
     * Store a newly created DocLibrary resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified DocLibrary resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified DocLibrary resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified DocLibrary resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
