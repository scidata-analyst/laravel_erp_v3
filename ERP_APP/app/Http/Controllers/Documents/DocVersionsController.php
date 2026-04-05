<?php

namespace App\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Http\Requests\Documents\DocVersionsRequest;
use App\Http\Resources\Documents\DocVersionsResource;
use App\Services\Documents\DocVersionsService;
use App\DTOs\Documents\DocVersionsDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class DocVersionsController extends Controller
{
    public function __construct(
        protected DocVersionsService $service
    ) {}

    public function index(DocVersionsRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $versions = $this->service->getVersions($perPage, $search, $filters);

        return DocVersionsResource::collection($versions)
            ->additional([
                'success' => true,
                'message' => 'Document versions retrieved successfully'
            ]);
    }

    public function store(DocVersionsRequest $request): JsonResponse
    {
        $dto = DocVersionsDTO::fromRequest($request->validated());
        $version = $this->service->createVersion($dto);

        return response()->json([
            'success' => true,
            'message' => 'Document version created successfully',
            'data' => new DocVersionsResource($version)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $version = $this->service->getVersionById($id);
        if (!$version) {
            return response()->json(['success' => false, 'message' => 'Document version not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Document version retrieved successfully',
            'data' => new DocVersionsResource($version)
        ]);
    }

    public function update(DocVersionsRequest $request, int $id): JsonResponse
    {
        $dto = DocVersionsDTO::fromRequest($request->validated());
        $success = $this->service->updateVersion($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Document version not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Document version updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteVersion($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Document version not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Document version deleted successfully']);
    }

    public function history(int $documentId): JsonResponse
    {
        $versions = $this->service->getVersionsByDocumentId($documentId);

        return response()->json([
            'success' => true,
            'message' => 'Document version history retrieved successfully',
            'data' => DocVersionsResource::collection($versions)
        ]);
    }
}
