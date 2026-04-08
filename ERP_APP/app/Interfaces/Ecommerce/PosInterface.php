<?php

namespace App\Interfaces\Ecommerce;


/**
 * Class PosInterface
 *
 * Interface for managing Pos resources.
 * Provides CRUD operations with JSON responses.
 */
interface PosInterface
{
    /**
     * Display all Pos records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Pos resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Pos resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request);

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Pos resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
