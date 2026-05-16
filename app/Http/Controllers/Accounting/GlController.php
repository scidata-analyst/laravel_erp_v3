<?php

namespace App\Http\Controllers\Accounting;

use App\Services\Accounting\GlService;
use App\Http\Requests\Accounting\GlStoreRequest;
use App\Http\Requests\Accounting\GlUpdateRequest;
use App\Http\Resources\Accounting\GlResource;
use App\Http\Controllers\Controller;

/**
 * Class GlController
 *
 * Controller for managing Gl resources.
 * Provides CRUD operations with JSON responses.
 */
class GlController extends Controller
{
    /**
     * @var GlService
     */
    protected $glService;

    /**
     * GlController constructor.
     *
     * @param GlService $glService
     */
    public function __construct(GlService $glService)
    {
        $this->glService = $glService;
    }

    /**
     * Display all Gl records without pagination.
     *
     */
    public function all()
    {
        $data = $this->glService->all();

        return GlResource::collection($data)->additional([
            'success' => true,
            'message' => 'All Gl records fetched successfully',
        ]);
    }

    /**
     * Display a paginated listing of Gl resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->glService->index($perPage, $search, $filters);

        return view("accounting.gl", compact("data"));
    }

    /**
     * Store a newly created Gl resource in storage.
     *
     * @param GlStoreRequest $request
     */
    public function store(GlStoreRequest $request)
    {
        $data = $this->glService->store($request->validated());

        return (new GlResource($data))->additional([
            'success' => true,
            'message' => 'Gl record created successfully',
        ]);
    }

    /**
     * Display the specified Gl resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->glService->show($id);

        return (new GlResource($data))->additional([
            'success' => true,
            'message' => 'Gl record fetched successfully',
        ]);
    }

    /**
     * Update the specified Gl resource in storage.
     *
     * @param GlUpdateRequest $request
     * @param int $id
     */
    public function update(GlUpdateRequest $request, $id)
    {
        $data = $this->glService->update($request->validated(), $id);

        return (new GlResource($data))->additional([
            'success' => true,
            'message' => 'Gl record updated successfully',
        ]);
    }

    /**
     * Remove the specified Gl resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->glService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Gl record deleted successfully"
        ]);
    }
}
