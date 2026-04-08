<?php

namespace App\Http\Interfaces\Core;

/**
 * interface SettingsInterface
 *
 * Interface for managing Settings resources.
 * Provides CRUD operations with JSON responses.
 */
interface SettingsInterface
{
    /**
     * @var SettingsService
     */

    /**
     * Display all Settings records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Settings resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Settings resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Settings resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Settings resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
