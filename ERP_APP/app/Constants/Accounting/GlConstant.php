<?php

namespace App\Constants\Accounting;

use App\Models\Accounting\Gl;

/**
 * Class GlConstant
 *
 * Constant for managing Gl resources.
 * Provides CRUD operations with JSON responses.
 */
class GlConstant
{
    /**
     * @var GlConstant
     */
    protected $glConstant;

    /**
     * GlConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Gl records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->glConstant->all();
    }

    /**
     * Display a paginated listing of Gl resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Gl resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Gl resource in storage.
     *
     * @param GlRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Gl resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
