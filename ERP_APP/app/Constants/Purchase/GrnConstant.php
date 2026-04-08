<?php

namespace App\Constants\Purchase;

use App\Models\Purchase\Grn;

/**
 * Class GrnConstant
 *
 * Constant for managing Grn resources.
 * Provides CRUD operations with JSON responses.
 */
class GrnConstant
{
    /**
     * @var GrnConstant
     */
    protected $grnConstant;

    /**
     * GrnConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Grn records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->grnConstant->all();
    }

    /**
     * Display a paginated listing of Grn resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Grn resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param GrnRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
