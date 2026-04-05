<?php

namespace App\Http\Controllers\QualityControl;

use App\Http\Controllers\Controller;
use App\Http\Requests\QualityControl\QcChecklistsRequest;
use App\Http\Resources\QualityControl\QcChecklistsResource;
use App\Services\QualityControl\QcChecklistsService;
use App\DTOs\QualityControl\QcChecklistsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class QcChecklistsController extends Controller
{
    public function __construct(
        protected QcChecklistsService $service
    ) {}

    public function index(QcChecklistsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $checklists = $this->service->getChecklists($perPage, $search, $filters);

        return QcChecklistsResource::collection($checklists)
            ->additional([
                'success' => true,
                'message' => 'QC Checklists retrieved successfully'
            ]);
    }

    public function store(QcChecklistsRequest $request): JsonResponse
    {
        $dto = QcChecklistsDTO::fromRequest($request->validated());
        $checklist = $this->service->createChecklist($dto);

        return response()->json([
            'success' => true,
            'message' => 'QC Checklist created successfully',
            'data' => new QcChecklistsResource($checklist)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $checklist = $this->service->getChecklistById($id);
        if (!$checklist) {
            return response()->json(['success' => false, 'message' => 'Checklist not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'QC Checklist retrieved successfully',
            'data' => new QcChecklistsResource($checklist)
        ]);
    }

    public function update(QcChecklistsRequest $request, int $id): JsonResponse
    {
        $dto = QcChecklistsDTO::fromRequest($request->validated());
        $success = $this->service->updateChecklist($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Checklist not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'QC Checklist updated successfully',
            'data' => new QcChecklistsResource($this->service->getChecklistById($id))
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteChecklist($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Checklist not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'QC Checklist deleted successfully'
        ]);
    }
}
