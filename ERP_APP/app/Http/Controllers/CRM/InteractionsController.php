<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\InteractionsRequest;
use App\Http\Resources\CRM\InteractionsResource;
use App\Services\CRM\InteractionsService;
use App\DTOs\CRM\InteractionsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class InteractionsController extends Controller
{
    public function __construct(
        protected InteractionsService $service
    ) {}

    public function index(InteractionsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $interactions = $this->service->getInteractions($perPage, $search, $filters);

        return InteractionsResource::collection($interactions)
            ->additional([
                'success' => true,
                'message' => 'Interactions retrieved successfully'
            ]);
    }

    public function store(InteractionsRequest $request): JsonResponse
    {
        $dto = InteractionsDTO::fromRequest($request->validated());
        $interaction = $this->service->addInteraction($dto);

        return response()->json([
            'success' => true,
            'message' => 'Interaction added successfully',
            'data' => new InteractionsResource($interaction)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $interaction = $this->service->getInteractionById($id);
        if (!$interaction) {
            return response()->json(['success' => false, 'message' => 'Interaction not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Interaction retrieved successfully',
            'data' => new InteractionsResource($interaction)
        ]);
    }

    public function update(InteractionsRequest $request, int $id): JsonResponse
    {
        $dto = InteractionsDTO::fromRequest($request->validated());
        $success = $this->service->updateInteraction($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Interaction not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Interaction updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteInteraction($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Interaction not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Interaction deleted successfully']);
    }

    public function getBySubject(Request $request): JsonResponse
    {
        $request->validate([
            'subject_id' => 'required_without:id|integer',
            'id' => 'required_without:subject_id|integer',
            'subject_type' => 'required_without:type|string',
            'type' => 'required_without:subject_type|string'
        ]);

        $subjectId = (int) ($request->subject_id ?? $request->id);
        $subjectType = (string) ($request->subject_type ?? $request->type);
        $interactions = $this->service->getInteractionsBySubject($subjectId, $subjectType);

        return response()->json([
            'success' => true,
            'message' => 'Subject interactions retrieved successfully',
            'data' => InteractionsResource::collection($interactions)
        ]);
    }
}
