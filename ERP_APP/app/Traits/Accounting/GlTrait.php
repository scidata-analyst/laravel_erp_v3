<?php

namespace App\Traits\Accounting;

use App\Models\Accounting\Gl;

/**
 * Class GlTrait
 *
 * Trait for managing Gl resources.
 * Provides CRUD operations with JSON responses.
 */
trait GlTrait
{
    /**
     * @var GlTrait
     */
    protected $glTrait;

    /**
     * GlTrait constructor.
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
        $data = $this->glTrait->all();
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
