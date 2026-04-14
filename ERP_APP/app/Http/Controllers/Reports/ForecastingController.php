<?php

namespace App\Http\Controllers\Reports;

use App\Services\Reports\ForecastingService;
use App\Http\Requests\Reports\ForecastingStoreRequest;
use App\Http\Requests\Reports\ForecastingUpdateRequest;
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
     * Display all Forecasting records without pagination.
     *
     */
    public function all()
    {
        $data = $this->forecastingService->all();

        return ForecastingResource::collection($data)
            ->additional([
                'success' => true,
                'message' => 'All Forecasting records fetched successfully',
            ]);
    }

    /**
     * Display a paginated listing of Forecasting resources.
     *
     */
    public function index()
    {
        $perPage = request()->get("per_page", 15);
        $search = request()->get("search", "");
        $filters = request()->get("filters", []);

        $data = $this->forecastingService->index($perPage, $search, $filters);

        return view("reports.forecasting", compact("data"));
    }

    /**
     * Store a newly created Forecasting resource in storage.
     *
     * @param ForecastingStoreRequest $request
     */
    public function store(ForecastingStoreRequest $request)
    {
        $data = $this->forecastingService->store($request->validated());

        return (new ForecastingResource($data))->additional([
            'success' => true,
            'message' => 'Forecasting record created successfully',
        ]);
    }

    /**
     * Display the specified Forecasting resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $data = $this->forecastingService->show($id);

        return (new ForecastingResource($data))->additional([
            'success' => true,
            'message' => 'Forecasting record fetched successfully',
        ]);
    }

    /**
     * Update the specified Forecasting resource in storage.
     *
     * @param ForecastingUpdateRequest $request
     * @param int $id
     */
    public function update(ForecastingUpdateRequest $request, $id)
    {
        $data = $this->forecastingService->update($request->validated(), $id);

        return (new ForecastingResource($data))->additional([
            'success' => true,
            'message' => 'Forecasting record updated successfully',
        ]);
    }

    /**
     * Remove the specified Forecasting resource from storage.
     *
     * @param int $id
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
