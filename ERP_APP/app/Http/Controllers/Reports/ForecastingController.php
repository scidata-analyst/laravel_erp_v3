<?php

namespace App\Http\Controllers\Reports;

use App\Services\Reports\ForecastingService;
use App\Http\Requests\Reports\ForecastingRequest;
use App\Http\Resources\Reports\ForecastingResource;
use App\Http\Controllers\Controller;

/**
 * Class ForecastingController
 *
 * Controller for managing Forecasting resources.
 * Provides CRUD operations with JSON responses.
 */
class ForecastingController extends Controller
{
    /**
     * @var ForecastingService
     */
    protected $forecastingService;

    /**
     * ForecastingController constructor.
     *
     * @param ForecastingService $forecastingService
     */
    public function __construct(ForecastingService $forecastingService)
    {
        $this->forecastingService = $forecastingService;
    }

    /**
     * Display a paginated listing of Forecasting resources.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->forecastingService->index($perPage, $search, $filters);

        return response()->json([
            "success" => true,
            "message" => "Forecasting records fetched successfully",
            "data" => ForecastingResource::collection($data)
        ]);
    }

    /**
     * Display all Forecasting records without pagination.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        $data = $this->forecastingService->all();

        return response()->json([
            "success" => true,
            "message" => "All Forecasting records fetched successfully",
            "data" => ForecastingResource::collection($data)
        ]);
    }

    /**
     * Store a newly created Forecasting resource in storage.
     *
     * @param ForecastingRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ForecastingRequest $request)
    {
        $data = $this->forecastingService->store($request->validated());

        return response()->json([
            "success" => true,
            "message" => "Forecasting record created successfully",
            "data" => new ForecastingResource($data)
        ], 201);
    }

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->forecastingService->show($id);

        return response()->json([
            "success" => true,
            "message" => "Forecasting record fetched successfully",
            "data" => new ForecastingResource($data)
        ]);
    }

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param ForecastingRequest $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ForecastingRequest $request, $id)
    {
        $data = $this->forecastingService->update($id, $request->validated());

        return response()->json([
            "success" => true,
            "message" => "Forecasting record updated successfully",
            "data" => new ForecastingResource($data)
        ]);
    }

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $this->forecastingService->destroy($id);

        return response()->json([
            "success" => true,
            "message" => "Forecasting record deleted successfully"
        ]);
    }
}
