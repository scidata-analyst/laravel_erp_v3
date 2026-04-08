<?php

namespace App\Constants\CRM;

use App\Models\CRM\Support;

/**
 * Class SupportConstant
 *
 * Constant for managing Support resources.
 * Provides CRUD operations with JSON responses.
 */
class SupportConstant
{
    /**
     * @var SupportConstant
     */
    protected $supportConstant;

    /**
     * SupportConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Support records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->supportConstant->all();
    }

    /**
     * Display a paginated listing of Support resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Support resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param SupportRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
