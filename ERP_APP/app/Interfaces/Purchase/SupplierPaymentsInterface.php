<?php

namespace App\Interfaces\Purchase;


/**
 * Class SupplierPaymentsInterface
 *
 * Interface for managing SupplierPayments resources.
 * Provides CRUD operations with JSON responses.
 */
interface SupplierPaymentsInterface
{
    /**
     * Display all SupplierPayments records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of SupplierPayments resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created SupplierPayments resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $request);

    /**
     * Display the specified SupplierPayments resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified SupplierPayments resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified SupplierPayments resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
