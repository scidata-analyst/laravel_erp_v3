<?php

namespace App\Http\Controllers\CRM;

use App\Services\CRM\LeadsService;
use App\Http\Requests\CRM\LeadsStoreRequest;
use App\Http\Requests\CRM\LeadsUpdateRequest;
use App\Http\Resources\CRM\LeadsResource;
use App\Http\Controllers\Controller;

/**
 * Class LeadsController
 *
 * Controller for managing Leads resources.
 * Provides CRUD operations with JSON responses.
 */
class LeadsController extends Controller
{
    /**
     * @var LeadsService
     */
    protected $leadsService;

    /**
     * LeadsController constructor.
     *
     * @param LeadsService $leadsService
     */
    public function __construct(LeadsService $leadsService)
    {
        $this->leadsService = $leadsService;
    }

    /**
     * Display all Leads records without pagination.
     *
     */
    public function all()
    {
        $data = $this->leadsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Leads records fetched successfully",
            "data" => LeadsResource::collection($data)
        ]);
    }

    /**
     * Display a paginated listing of Leads resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->leadsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Leads records fetched successfully",
            "data" => LeadsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Leads resource in storage.
     *
     * @param LeadsStoreRequest $request
     */
    public function store(LeadsStoreRequest $request)
    {
        $data = $this->leadsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Leads record created successfully",
            "data" => new LeadsResource($data)
        ], 201);
    }

    /**
     * Display the specified Leads resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->leadsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Leads record fetched successfully",
            "data" => new LeadsResource($data)
        ]);
    }

    /**
     * Update the specified Leads resource in storage.
     *
     * @param LeadsUpdateRequest $request
     * @param int $id
     */
    public function update(LeadsUpdateRequest $request, $id)
    {
        $data = $this->leadsService->update($request->validated(), $id);

        return response()->json([
            "success" => true,
            "message" => "Leads record updated successfully",
            "data" => new LeadsResource($data)
        ]);
    }

    /**
     * Remove the specified Leads resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        $this->leadsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Leads record deleted successfully"
        ]);
    }
}
