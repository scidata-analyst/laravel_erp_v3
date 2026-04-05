<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Http\Requests\HR\PerformanceRequest;
use App\Http\Resources\HR\PerformanceResource;
use App\Services\HR\PerformanceService;
use App\DTOs\HR\PerformanceDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PerformanceController extends Controller
{
    public function __construct(
        protected PerformanceService $service
    ) {}

    public function index(PerformanceRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $reviews = $this->service->getPerformanceReviews($perPage, $search, $filters);

        return PerformanceResource::collection($reviews)
            ->additional([
                'success' => true,
                'message' => 'Performance reviews retrieved successfully'
            ]);
    }

    public function store(PerformanceRequest $request): JsonResponse
    {
        $dto = PerformanceDTO::fromRequest($request->validated());
        $review = $this->service->addReview($dto);

        return response()->json([
            'success' => true,
            'message' => 'Performance review added successfully',
            'data' => new PerformanceResource($review)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $review = $this->service->getReviewById($id);
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Performance review retrieved successfully',
            'data' => new PerformanceResource($review)
        ]);
    }

    public function update(PerformanceRequest $request, int $id): JsonResponse
    {
        $dto = PerformanceDTO::fromRequest($request->validated());
        $success = $this->service->updateReview($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Review not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Performance review updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteReview($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Review not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Performance review deleted successfully']);
    }
}
