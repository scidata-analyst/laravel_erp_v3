<?php

namespace App\Http\Interfaces\Ecommerce;

/**
 * interface OnlineChannelsInterface
 *
 * Interface for managing OnlineChannels resources.
 * Provides CRUD operations with JSON responses.
 */
interface OnlineChannelsInterface
{
    /**
     * @var OnlineChannelsService
     */

    /**
     * Display all OnlineChannels records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all();

    /**
     * Display a paginated listing of OnlineChannels resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index();

    /**
     * Store a newly created OnlineChannels resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(array $data);

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id);

    /**
     * Update the specified OnlineChannels resource in storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(array $data, $id);

    /**
     * Remove the specified OnlineChannels resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id);
}
