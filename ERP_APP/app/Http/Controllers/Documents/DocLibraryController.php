<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Documents\DocLibraryRequest;
use App\Http\Resources\Documents\DocLibraryResource;
use App\Services\Documents\DocLibraryService;
use App\DTOs\Documents\DocLibraryDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocLibraryController extends Controller
{
    public function __construct(
        protected DocLibraryService $service
    ) {}

    public function index(DocLibraryRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $docs = $this->service->getDocuments($perPage, $search, $filters);

        return DocLibraryResource::collection($docs)
            ->additional([
                'success' => true,
                'message' => 'Documents retrieved successfully'
            ]);
    }

    public function store(DocLibraryRequest $request): JsonResponse
    {
        $dto = DocLibraryDTO::fromRequest($request->validated());
        $doc = $this->service->uploadDocument($dto);

        return response()->json([
            'success' => true,
            'message' => 'Document uploaded successfully',
            'data' => new DocLibraryResource($doc)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $doc = $this->service->getDocumentById($id);
        if (!$doc) {
            return response()->json(['success' => false, 'message' => 'Document not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Document retrieved successfully',
            'data' => new DocLibraryResource($doc)
        ]);
    }

    public function update(DocLibraryRequest $request, int $id): JsonResponse
    {
        $dto = DocLibraryDTO::fromRequest($request->validated());
        $success = $this->service->updateDocument($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Document not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Document updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteDocument($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Document not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Document deleted successfully']);
    }
}
