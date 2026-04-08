<?php

namespace App\Constants\Documents;

use App\Models\Documents\DocLibrary;

/**
 * Class DocLibraryConstant
 *
 * Constant for managing DocLibrary resources.
 * Provides CRUD operations with JSON responses.
 */
class DocLibraryConstant
{
    /**
     * @var DocLibraryConstant
     */
    protected $docLibraryConstant;

    /**
     * DocLibraryConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all DocLibrary records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->docLibraryConstant->all();
    }

    /**
     * Display a paginated listing of DocLibrary resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created DocLibrary resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified DocLibrary resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified DocLibrary resource in storage.
     *
     * @param DocLibraryRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified DocLibrary resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
