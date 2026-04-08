<?php

namespace App\Http\Interfaces\Projects;

/**
 * interface ResourcesInterface
 *
 * Interface for managing Resources resources.
 * Provides CRUD operations with JSON responses.
 */
interface ResourcesInterface
{
    /**
     * @var ResourcesService
     */

    /**
     * Display all Resources records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Resources resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Resources resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Resources resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Resources resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Resources resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
