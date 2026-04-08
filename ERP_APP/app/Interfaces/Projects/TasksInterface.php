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
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Tasks resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Tasks resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request);

    /**
     * Display the specified Tasks resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Tasks resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Tasks resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
