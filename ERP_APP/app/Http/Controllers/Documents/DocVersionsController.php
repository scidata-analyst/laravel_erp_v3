<?php

namespace App\Http\Controllers\Documents;

use App\Services\Documents\DocVersionsService;
use App\Http\Requests\Documents\DocVersionsStoreRequest;
use App\Http\Requests\Documents\DocVersionsUpdateRequest;
use App\Http\Resources\Documents\DocVersionsResource;
use App\Http\Controllers\Controller;

/**
 * Class DocVersionsController
 *
 * Controller for managing DocVersions resources.
 * Provides CRUD operations with JSON responses.
 */
class DocVersionsController extends Controller
{
    /**
     * @var DocVersionsService
     */
    protected $docVersionsService;

    /**
     * DocVersionsController constructor.
     *
     * @param DocVersionsService $docVersionsService
     */
    public function __construct(DocVersionsService $docVersionsService)
    {
        $this->docVersionsService = $docVersionsService;
    }

    /**
     * Display all DocVersions records without pagination.
     *
     */
    public function all()
    {
        $data = $this->docVersionsService->all();

        return DocVersionsResource::collection($data)->additional([
            'success' => true,
            'message' => 'All DocVersions records fetched successfully',
        ]);
    }

    /**
     * Display a paginated listing of DocVersions resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->docVersionsService->index($perPage, $search, $filters);

        return view("documents.doc_versions", compact("data"));
    }

    /**
     * Store a newly created DocVersions resource in storage.
     *
     * @param DocVersionsStoreRequest $request
     */
    public function store(DocVersionsStoreRequest $request)
    {
        $data = $this->docVersionsService->store($request->validated());

        return (new DocVersionsResource($data))->additional([
            'success' => true,
            'message' => 'DocVersions record created successfully',
        ]);
    }

    /**
     * Display the specified DocVersions resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->docVersionsService->show($id);

        return (new DocVersionsResource($data))->additional([
            'success' => true,
            'message' => 'DocVersions record fetched successfully',
        ]);
    }

    /**
     * Update the specified DocVersions resource in storage.
     *
     * @param DocVersionsUpdateRequest $request
     * @param int $id
     */
    public function update(DocVersionsUpdateRequest $request, $id)
    {
        $data = $this->docVersionsService->update($request->validated(), $id);

        return (new DocVersionsResource($data))->additional([
            'success' => true,
            'message' => 'DocVersions record updated successfully',
        ]);
    }

    /**
     * Remove the specified DocVersions resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->docVersionsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "DocVersions record deleted successfully"
        ]);
    }
}
