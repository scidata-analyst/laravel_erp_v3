<?php

namespace App\Http\Controllers\QualityControl;

use App\Services\QualityControl\QcChecklistsService;
use App\Http\Requests\QualityControl\QcChecklistsRequest;
use App\Http\Resources\QualityControl\QcChecklistsResource;
use App\Http\Controllers\Controller;

/**
 * Class QcChecklistsController
 *
 * Controller for managing QcChecklists resources.
 * Provides CRUD operations with JSON responses.
 */
class QcChecklistsController extends Controller
{
    /**
     * @var QcChecklistsService
     */
    protected $qcChecklistsService;

    /**
     * QcChecklistsController constructor.
     *
     * @param QcChecklistsService $qcChecklistsService
     */
    public function __construct(QcChecklistsService $qcChecklistsService)
    {
        $this->qcChecklistsService = $qcChecklistsService;
    }

    /**
     * Display a paginated listing of QcChecklists resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->qcChecklistsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "QcChecklists records fetched successfully",
            "data" => QcChecklistsResource::collection($data)
        ]);
    }

    /**
     * Display all QcChecklists records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->qcChecklistsService->all();

        return response()->json([
            "success" => true,
            "message" => "All QcChecklists records fetched successfully",
            "data" => QcChecklistsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created QcChecklists resource in storage.
     *
     * @param QcChecklistsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(QcChecklistsRequest $request)
    {
        $data = $this->qcChecklistsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "QcChecklists record created successfully",
            "data" => new QcChecklistsResource($data)
        ], 201);
    }

    /**
     * Display the specified QcChecklists resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->qcChecklistsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "QcChecklists record fetched successfully",
            "data" => new QcChecklistsResource($data)
        ]);
    }

    /**
     * Update the specified QcChecklists resource in storage.
     *
     * @param QcChecklistsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(QcChecklistsRequest $request, $id)
    {
        $data = $this->qcChecklistsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "QcChecklists record updated successfully",
            "data" => new QcChecklistsResource($data)
        ]);
    }

    /**
     * Remove the specified QcChecklists resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->qcChecklistsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "QcChecklists record deleted successfully"
        ]);
    }
}
