<?php

namespace App\Http\Controllers\Ecommerce;

use App\Services\Ecommerce\InvSyncService;
use App\Http\Requests\Ecommerce\InvSyncRequest;
use App\Http\Resources\Ecommerce\InvSyncResource;
use App\Http\Controllers\Controller;

/**
 * Class InvSyncController
 *
 * Controller for managing InvSync resources.
 * Provides CRUD operations with JSON responses.
 */
class InvSyncController extends Controller
{
    /**
     * @var InvSyncService
     */
    protected $invSyncService;

    /**
     * InvSyncController constructor.
     *
     * @param InvSyncService $invSyncService
     */
    public function __construct(InvSyncService $invSyncService)
    {
        $this->invSyncService = $invSyncService;
    }

    /**
     * Display a paginated listing of InvSync resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->invSyncService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "InvSync records fetched successfully",
            "data" => InvSyncResource::collection($data)
        ]);
    }

    /**
     * Display all InvSync records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->invSyncService->all();

        return response()->json([
            "success" => true,
            "message" => "All InvSync records fetched successfully",
            "data" => InvSyncResource::collection($data)
        ]);
    }

    /**
     * Store a newly created InvSync resource in storage.
     *
     * @param InvSyncRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(InvSyncRequest $request)
    {
        $data = $this->invSyncService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "InvSync record created successfully",
            "data" => new InvSyncResource($data)
        ], 201);
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->invSyncService->show($id);

        return response()->json([
            "success" => true,
            "message" => "InvSync record fetched successfully",
            "data" => new InvSyncResource($data)
        ]);
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param InvSyncRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(InvSyncRequest $request, $id)
    {
        $data = $this->invSyncService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "InvSync record updated successfully",
            "data" => new InvSyncResource($data)
        ]);
    }

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->invSyncService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "InvSync record deleted successfully"
        ]);
    }
}
