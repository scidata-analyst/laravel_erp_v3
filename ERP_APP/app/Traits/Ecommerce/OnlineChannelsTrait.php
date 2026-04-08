<?php

namespace App\Traits\Ecommerce;

use App\Models\Ecommerce\OnlineChannels;

/**
 * Class OnlineChannelsTrait
 *
 * Trait for managing OnlineChannels resources.
 * Provides CRUD operations with JSON responses.
 */
trait OnlineChannelsTrait
{
    /**
     * @var OnlineChannelsTrait
     */
    protected $onlineChannelsTrait;

    /**
     * OnlineChannelsTrait constructor.
     *
     */
    public function __construct()
    {
        
    }

    /**
     * Display all OnlineChannels records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->onlineChannelsTrait->all();
    }

    /**
     * Display a paginated listing of OnlineChannels resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created OnlineChannels resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data)
    {
        
    }

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified OnlineChannels resource in storage.
     *
     * @param OnlineChannelsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, array $data)
    {
        
    }

    /**
     * Remove the specified OnlineChannels resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        
    }
}
