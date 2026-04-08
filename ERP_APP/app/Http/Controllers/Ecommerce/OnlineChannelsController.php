<?php

namespace App\Http\Controllers\Ecommerce;

use App\Services\Ecommerce\OnlineChannelsService;
use App\Http\Requests\Ecommerce\OnlineChannelsRequest;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->onlineChannelsService->all();

        return response()->json([
            "success" => true,
            "message" => "All OnlineChannels records fetched successfully",
            "data" => OnlineChannelsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of OnlineChannels resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->onlineChannelsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "OnlineChannels records fetched successfully",
            "data" => OnlineChannelsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created OnlineChannels resource in storage.
     *
     * @param OnlineChannelsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OnlineChannelsRequest $request)
    {
        $data = $this->onlineChannelsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "OnlineChannels record created successfully",
            "data" => new OnlineChannelsResource($data)
        ], 201);
    }

    /**
     * Display the specified OnlineChannels resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->onlineChannelsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "OnlineChannels record fetched successfully",
            "data" => new OnlineChannelsResource($data)
        ]);
    }

    /**
     * Update the specified OnlineChannels resource in storage.
     *
     * @param OnlineChannelsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(OnlineChannelsRequest $request, $id)
    {
        $data = $this->onlineChannelsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "OnlineChannels record updated successfully",
            "data" => new OnlineChannelsResource($data)
        ]);
    }

    /**
     * Remove the specified OnlineChannels resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
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
