<?php

namespace App\Interfaces\CRM;


/**
 * Class InteractionsInterface
 *
 * Interface for managing Interactions resources.
 * Provides CRUD operations with JSON responses.
 */
interface InteractionsInterface
{
    /**
     * Display all Interactions records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Interactions resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Interactions resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request);

    /**
     * Display the specified Interactions resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Interactions resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Interactions resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
