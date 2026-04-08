<?php

namespace App\Constants\Ecommerce;

use App\Models\Ecommerce\InvSync;

/**
 * Class InvSyncConstant
 *
 * Constant for managing InvSync resources.
 * Provides CRUD operations with JSON responses.
 */
class InvSyncConstant
{
    /**
     * @var InvSyncConstant
     */
    protected $invSyncConstant;

    /**
     * InvSyncConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all InvSync records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->invSyncConstant->all();
    }

    /**
     * Display a paginated listing of InvSync resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created InvSync resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param InvSyncRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
