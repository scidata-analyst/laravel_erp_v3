<?php

namespace App\Constants\Core;

use App\Models\Core\Settings;

/**
 * Class SettingsConstant
 *
 * Constant for managing Settings resources.
 * Provides CRUD operations with JSON responses.
 */
class SettingsConstant
{
    /**
     * @var SettingsConstant
     */
    protected $settingsConstant;

    /**
     * SettingsConstant constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all Settings records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->settingsConstant->all();
    }

    /**
     * Display a paginated listing of Settings resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created Settings resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified Settings resource in storage.
     *
     * @param SettingsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified Settings resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
