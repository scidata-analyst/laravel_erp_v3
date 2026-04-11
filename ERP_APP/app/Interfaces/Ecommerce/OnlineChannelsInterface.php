<?php

namespace App\Interfaces\Ecommerce;


/**
 * Class OnlineChannelsInterface
 *
 * Interface for managing OnlineChannels resources.
 * Provides CRUD operations with JSON responses.
 */
interface OnlineChannelsInterface
{
    /**
     * Display all OnlineChannels records without pagination.
     *
     */
    public function all();

    /**
     * Display a paginated listing of OnlineChannels resources.
     *
     */
    public function index();

    /**
     * Store a newly created OnlineChannels resource in storage.
     *
     */
    public function store(array $request);

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     */
    public function show($id);

    /**
     * Update the specified OnlineChannels resource in storage.
     *
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Remove the specified OnlineChannels resource from storage.
     *
     * @param int $id
     */
    public function destroy($id);
}
