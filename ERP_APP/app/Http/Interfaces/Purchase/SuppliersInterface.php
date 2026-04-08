<?php

namespace App\Http\Interfaces\Purchase;

/**
 * interface SuppliersInterface
 *
 * Interface for managing Suppliers resources.
 * Provides CRUD operations with JSON responses.
 */
interface SuppliersInterface
{
    /**
     * @var SuppliersService
     */

    /**
     * Display all Suppliers records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of Suppliers resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created Suppliers resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified Suppliers resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified Suppliers resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified Suppliers resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
