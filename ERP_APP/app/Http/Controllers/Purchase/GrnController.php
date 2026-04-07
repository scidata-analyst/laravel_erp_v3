<?php

namespace App\Http\Controllers\Purchase;

use App\Services\Purchase\GrnService;
use App\Http\Requests\Purchase\GrnRequest;
use App\Http\Resources\Purchase\GrnResource;
use App\Http\Controllers\Controller;

/**
 * Class GrnController
 *
 * Controller for managing Grn resources.
 * Provides CRUD operations with JSON responses.
 */
class GrnController extends Controller
{
    /**
     * @var GrnService
     */
    protected $grnService;

    /**
     * GrnController constructor.
     *
     * @param GrnService $grnService
     */
    public function __construct(GrnService $grnService)
    {
        $this->grnService = $grnService;
    }

    /**
     * Display a paginated listing of Grn resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->grnService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Grn records fetched successfully",
            "data" => GrnResource::collection($data)
        ]);
    }

    /**
     * Display all Grn records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->grnService->all();

        return response()->json([
            "success" => true,
            "message" => "All Grn records fetched successfully",
            "data" => GrnResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Grn resource in storage.
     *
     * @param GrnRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GrnRequest $request)
    {
        $data = $this->grnService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Grn record created successfully",
            "data" => new GrnResource($data)
        ], 201);
    }

    /**
     * Display the specified Grn resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->grnService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Grn record fetched successfully",
            "data" => new GrnResource($data)
        ]);
    }

    /**
     * Update the specified Grn resource in storage.
     *
     * @param GrnRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(GrnRequest $request, $id)
    {
        $data = $this->grnService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Grn record updated successfully",
            "data" => new GrnResource($data)
        ]);
    }

    /**
     * Remove the specified Grn resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->grnService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Grn record deleted successfully"
        ]);
    }
}
