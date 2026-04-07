<?php

namespace App\Http\Controllers\CRM;

use App\Services\CRM\SupportService;
use App\Http\Requests\CRM\SupportRequest;
use App\Http\Resources\CRM\SupportResource;
use App\Http\Controllers\Controller;

/**
 * Class SupportController
 *
 * Controller for managing Support resources.
 * Provides CRUD operations with JSON responses.
 */
class SupportController extends Controller
{
    /**
     * @var SupportService
     */
    protected $supportService;

    /**
     * SupportController constructor.
     *
     * @param SupportService $supportService
     */
    public function __construct(SupportService $supportService)
    {
        $this->supportService = $supportService;
    }

    /**
     * Display a paginated listing of Support resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->supportService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Support records fetched successfully",
            "data" => SupportResource::collection($data)
        ]);
    }

    /**
     * Display all Support records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->supportService->all();

        return response()->json([
            "success" => true,
            "message" => "All Support records fetched successfully",
            "data" => SupportResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Support resource in storage.
     *
     * @param SupportRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SupportRequest $request)
    {
        $data = $this->supportService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Support record created successfully",
            "data" => new SupportResource($data)
        ], 201);
    }

    /**
     * Display the specified Support resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->supportService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Support record fetched successfully",
            "data" => new SupportResource($data)
        ]);
    }

    /**
     * Update the specified Support resource in storage.
     *
     * @param SupportRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SupportRequest $request, $id)
    {
        $data = $this->supportService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Support record updated successfully",
            "data" => new SupportResource($data)
        ]);
    }

    /**
     * Remove the specified Support resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->supportService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Support record deleted successfully"
        ]);
    }
}
