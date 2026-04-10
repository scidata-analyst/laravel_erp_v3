<?php

namespace App\Http\Controllers\Ecommerce;

use App\Services\Ecommerce\PosService;
use App\Http\Requests\Ecommerce\PosStoreRequest;
use App\Http\Requests\Ecommerce\PosUpdateRequest;
use App\Http\Resources\Ecommerce\PosResource;
use App\Http\Controllers\Controller;

/**
 * Class PosController
 *
 * Controller for managing Pos resources.
 * Provides CRUD operations with JSON responses.
 */
class PosController extends Controller
{
    /**
     * @var PosService
     */
    protected $posService;

    /**
     * PosController constructor.
     *
     * @param PosService $posService
     */
    public function __construct(PosService $posService)
    {
        $this->posService = $posService;
    }

    /**
     * Display all Pos records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->posService->all();

        return response()->json([
            "success" => true,
            "message" => "All Pos records fetched successfully",
            "data" => PosResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Pos resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->posService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Pos records fetched successfully",
            "data" => PosResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Pos resource in storage.
     *
     * @param PosStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PosStoreRequest $request)
    {
        $data = $this->posService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Pos record created successfully",
            "data" => new PosResource($data)
        ], 201);
    }

    /**
     * Display the specified Pos resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->posService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Pos record fetched successfully",
            "data" => new PosResource($data)
        ]);
    }

    /**
     * Update the specified Pos resource in storage.
     *
     * @param PosUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PosUpdateRequest $request, $id)
    {
        $data = $this->posService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Pos record updated successfully",
            "data" => new PosResource($data)
        ]);
    }

    /**
     * Remove the specified Pos resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->posService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Pos record deleted successfully"
        ]);
    }
}
