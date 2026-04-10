<?php

namespace App\Http\Controllers\QualityControl;

use App\Services\QualityControl\DefectsService;
use App\Http\Requests\QualityControl\DefectsStoreRequest;
use App\Http\Requests\QualityControl\DefectsUpdateRequest;
use App\Http\Resources\QualityControl\DefectsResource;
use App\Http\Controllers\Controller;

/**
 * Class DefectsController
 *
 * Controller for managing Defects resources.
 * Provides CRUD operations with JSON responses.
 */
class DefectsController extends Controller
{
    /**
     * @var DefectsService
     */
    protected $defectsService;

    /**
     * DefectsController constructor.
     *
     * @param DefectsService $defectsService
     */
    public function __construct(DefectsService $defectsService)
    {
        $this->defectsService = $defectsService;
    }

    /**
     * Display all Defects records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->defectsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Defects records fetched successfully",
            "data" => DefectsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Defects resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->defectsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Defects records fetched successfully",
            "data" => DefectsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Defects resource in storage.
     *
     * @param DefectsStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DefectsStoreRequest $request)
    {
        $data = $this->defectsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Defects record created successfully",
            "data" => new DefectsResource($data)
        ], 201);
    }

    /**
     * Display the specified Defects resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->defectsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Defects record fetched successfully",
            "data" => new DefectsResource($data)
        ]);
    }

    /**
     * Update the specified Defects resource in storage.
     *
     * @param DefectsUpdateRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(DefectsUpdateRequest $request, $id)
    {
        $data = $this->defectsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Defects record updated successfully",
            "data" => new DefectsResource($data)
        ]);
    }

    /**
     * Remove the specified Defects resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->defectsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Defects record deleted successfully"
        ]);
    }
}
