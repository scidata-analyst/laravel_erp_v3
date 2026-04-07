<?php

namespace App\Http\Controllers\Core;

use App\Services\Core\SettingsService;
use App\Http\Requests\Core\SettingsRequest;
use App\Http\Resources\Core\SettingsResource;
use App\Http\Controllers\Controller;

/**
 * Class SettingsController
 *
 * Controller for managing Settings resources.
 * Provides CRUD operations with JSON responses.
 */
class SettingsController extends Controller
{
    /**
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * SettingsController constructor.
     *
     * @param SettingsService $settingsService
     */
    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    /**
     * Display a paginated listing of Settings resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->settingsService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Settings records fetched successfully",
            "data" => SettingsResource::collection($data)
        ]);
    }

    /**
     * Display all Settings records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->settingsService->all();

        return response()->json([
            "success" => true,
            "message" => "All Settings records fetched successfully",
            "data" => SettingsResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Settings resource in storage.
     *
     * @param SettingsRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SettingsRequest $request)
    {
        $data = $this->settingsService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Settings record created successfully",
            "data" => new SettingsResource($data)
        ], 201);
    }

    /**
     * Display the specified Settings resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->settingsService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Settings record fetched successfully",
            "data" => new SettingsResource($data)
        ]);
    }

    /**
     * Update the specified Settings resource in storage.
     *
     * @param SettingsRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SettingsRequest $request, $id)
    {
        $data = $this->settingsService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Settings record updated successfully",
            "data" => new SettingsResource($data)
        ]);
    }

    /**
     * Remove the specified Settings resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->settingsService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Settings record deleted successfully"
        ]);
    }
}
