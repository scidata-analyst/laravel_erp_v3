<?php

namespace App\Http\Controllers\Documents;

use App\Services\Documents\DocLibraryService;
use App\Http\Requests\Documents\DocLibraryStoreRequest;
use App\Http\Requests\Documents\DocLibraryUpdateRequest;
use App\Http\Resources\Documents\DocLibraryResource;
use App\Http\Controllers\Controller;

/**
 * Class DocLibraryController
 *
 * Controller for managing DocLibrary resources.
 * Provides CRUD operations with JSON responses.
 */
class DocLibraryController extends Controller
{
    /**
     * @var DocLibraryService
     */
    protected $docLibraryService;

    /**
     * DocLibraryController constructor.
     *
     * @param DocLibraryService $docLibraryService
     */
    public function __construct(DocLibraryService $docLibraryService)
    {
        $this->docLibraryService = $docLibraryService;
    }

    /**
     * Display all DocLibrary records without pagination.
     *
     */
    public function all()
    {
        $data = $this->docLibraryService->all();

        return DocLibraryResource::collection($data)->additional([
            'success' => true,
            'message' => 'All DocLibrary records fetched successfully',
        ]);
    }

    /**
     * Display a paginated listing of DocLibrary resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->docLibraryService->index($perPage, $search, $filters);

        return view("documents.doc_library", compact("data"));
    }

    /**
     * Store a newly created DocLibrary resource in storage.
     *
     * @param DocLibraryStoreRequest $request
     */
    public function store(DocLibraryStoreRequest $request)
    {
        $data = $this->docLibraryService->store($request->validated());

        return (new DocLibraryResource($data))->additional([
            'success' => true,
            'message' => 'DocLibrary record created successfully',
        ]);
    }

    /**
     * Display the specified DocLibrary resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->docLibraryService->show($id);

        return (new DocLibraryResource($data))->additional([
            'success' => true,
            'message' => 'DocLibrary record fetched successfully',
        ]);
    }

    /**
     * Update the specified DocLibrary resource in storage.
     *
     * @param DocLibraryUpdateRequest $request
     * @param int $id
     */
    public function update(DocLibraryUpdateRequest $request, $id)
    {
        $data = $this->docLibraryService->update($request->validated(), $id);

        return (new DocLibraryResource($data))->additional([
            'success' => true,
            'message' => 'DocLibrary record updated successfully',
        ]);
    }

    /**
     * Remove the specified DocLibrary resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->docLibraryService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "DocLibrary record deleted successfully"
        ]);
    }
}