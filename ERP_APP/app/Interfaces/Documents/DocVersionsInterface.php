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
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of DocVersions resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created DocVersions resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request);

    /**
     * Display the specified DocVersions resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified DocVersions resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified DocVersions resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
