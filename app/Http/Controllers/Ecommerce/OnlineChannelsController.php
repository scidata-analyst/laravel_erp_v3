<?php

namespace App\Http\Controllers\Ecommerce;

use App\Services\Ecommerce\OnlineChannelsService;
use App\Http\Requests\Ecommerce\OnlineChannelsStoreRequest;
use App\Http\Requests\Ecommerce\OnlineChannelsUpdateRequest;
use App\Http\Resources\Ecommerce\OnlineChannelsResource;
use App\Http\Controllers\Controller;

/**
 * Class OnlineChannelsController
 *
 * Controller for managing OnlineChannels resources.
 * Provides CRUD operations with JSON responses.
 */
class OnlineChannelsController extends Controller
{
    /**
     * @var OnlineChannelsService
     */
    protected $onlineChannelsService;

    /**
     * OnlineChannelsController constructor.
     *
     * @param OnlineChannelsService $onlineChannelsService
     */
    public function __construct(OnlineChannelsService $onlineChannelsService)
    {
        $this->onlineChannelsService = $onlineChannelsService;
    }

    /**
     * Display all OnlineChannels records without pagination.
     *
     */
    public function all()
    {
        $data = $this->onlineChannelsService->all();

        return OnlineChannelsResource::collection($data)->additional([
            "success" => true,
            "message" => "All OnlineChannels records fetched successfully"
        ]);
    }

    /**
     * Display a paginated listing of OnlineChannels resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->onlineChannelsService->index($perPage, $search, $filters);

        return view("ecommerce.online_channels", compact("data"));
    }

    /**
     * Store a newly created OnlineChannels resource in storage.
     *
     * @param OnlineChannelsStoreRequest $request
     */
    public function store(OnlineChannelsStoreRequest $request)
    {
        $data = $this->onlineChannelsService->store($request->validated());

        return (new OnlineChannelsResource($data))->additional([
            "success" => true,
            "message" => "OnlineChannels record created successfully"
        ]);
    }

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->onlineChannelsService->show($id);

        return (new OnlineChannelsResource($data))->additional([
            "success" => true,
            "message" => "OnlineChannels record fetched successfully"
        ]);
    }

    /**
     * Update the specified OnlineChannels resource in storage.
     *
     * @param OnlineChannelsUpdateRequest $request
     * @param int $id
     */
    public function update(OnlineChannelsUpdateRequest $request, $id)
    {
        $data = $this->onlineChannelsService->update($request->validated(), $id);

        return (new OnlineChannelsResource($data))->additional([
            "success" => true,
            "message" => "OnlineChannels record updated successfully"
        ]);
    }

    /**
     * Remove the specified OnlineChannels resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->onlineChannelsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "OnlineChannels record deleted successfully"
        ]);
    }
}
