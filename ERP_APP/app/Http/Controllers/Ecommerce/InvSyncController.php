<?php

namespace App\Http\Controllers\Ecommerce;

use App\Services\Ecommerce\InvSyncService;
use App\Http\Requests\Ecommerce\InvSyncStoreRequest;
use App\Http\Requests\Ecommerce\InvSyncUpdateRequest;
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
     * Display all InvSync records without pagination.
     *
     */
    public function all()
    {
        $data = $this->invSyncService->all();

        return InvSyncResource::collection($data)->additional([
            "success" => true,
            "message" => "All InvSync records fetched successfully"
        ]);
    }

    /**
     * Display a paginated listing of InvSync resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->invSyncService->index($perPage, $search, $filters);

        return view("ecommerce.inv_sync", compact("data"));
    }

    /**
     * Store a newly created InvSync resource in storage.
     *
     * @param InvSyncStoreRequest $request
     */
    public function store(InvSyncStoreRequest $request)
    {
        $data = $this->invSyncService->store($request->validated());

        return (new InvSyncResource($data))->additional([
            "success" => true,
            "message" => "InvSync record created successfully"
        ]);
    }

    /**
     * Display the specified InvSync resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->invSyncService->show($id);

        return (new InvSyncResource($data))->additional([
            "success" => true,
            "message" => "InvSync record fetched successfully"
        ]);
    }

    /**
     * Update the specified InvSync resource in storage.
     *
     * @param InvSyncUpdateRequest $request
     * @param int $id
     */
    public function update(InvSyncUpdateRequest $request, $id)
    {
        $data = $this->invSyncService->update($request->validated(), $id);

        return (new InvSyncResource($data))->additional([
            "success" => true,
            "message" => "InvSync record updated successfully"
        ]);
    }

    /**
     * Remove the specified InvSync resource from storage.
     *
     * @param int $id
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
