<?php

namespace App\Http\Controllers\QualityControl;

use App\Services\QualityControl\QcChecklistsService;
use App\Http\Requests\QualityControl\QcChecklistsStoreRequest;
use App\Http\Requests\QualityControl\QcChecklistsUpdateRequest;
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
     * Display all QcChecklists records without pagination.
     *
     */
    public function all()
    {
        $data = $this->qcChecklistsService->all();

        return QcChecklistsResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All QcChecklists records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of QcChecklists resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->qcChecklistsService->index($perPage, $search, $filters);

        return view("quality_control.qc_checklists", compact("data"));
    }

    /**
     * Store a newly created QcChecklists resource in storage.
     *
     * @param QcChecklistsStoreRequest $request
     */
    public function store(QcChecklistsStoreRequest $request)
    {
        $data = $this->qcChecklistsService->store($request->validated());

        return (new QcChecklistsResource($data))->additional([
            'success' => true,
            'message' => 'QcChecklists record created successfully',
        ]);
    }

    /**
     * Display the specified QcChecklists resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->qcChecklistsService->show($id);

        return (new QcChecklistsResource($data))->additional([
            'success' => true,
            'message' => 'QcChecklists record fetched successfully',
        ]);
    }

    /**
     * Update the specified QcChecklists resource in storage.
     *
     * @param QcChecklistsUpdateRequest $request
     * @param int $id
     */
    public function update(QcChecklistsUpdateRequest $request, $id)
    {
        $data = $this->qcChecklistsService->update($request->validated(), $id);

        return (new QcChecklistsResource($data))->additional([
            'success' => true,
            'message' => 'QcChecklists record updated successfully',
        ]);
    }

    /**
     * Remove the specified QcChecklists resource from storage.
     *
     * @param int $id
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
