<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\CRM\SupportRequest;
use App\Http\Resources\CRM\SupportResource;
use App\Services\CRM\SupportService;
use App\DTOs\CRM\SupportDTO;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SupportController extends Controller
{
    public function __construct(
        protected SupportService $service
    ) {}

    public function index(SupportRequest $request): JsonResource|JsonResponse
    {
        $perPage = $request->get('per_page', 20);
        $search = $request->get('search', '');
        $filters = json_decode($request->get('filters', '[]'), true);
        $tickets = $this->service->getTickets($perPage, $search, $filters);

        return SupportResource::collection($tickets)
            ->additional([
                'success' => true,
                'message' => 'Support tickets retrieved successfully'
            ]);
    }

    public function store(SupportRequest $request): JsonResponse
    {
        $dto = SupportDTO::fromRequest($request->validated());
        $ticket = $this->service->createTicket($dto);

        return response()->json([
            'success' => true,
            'message' => 'Support ticket created successfully',
            'data' => new SupportResource($ticket)
        ], 201);
    }

    public function show(int $id): JsonResponse
    {
        $ticket = $this->service->getTicketById($id);
        if (!$ticket) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Support ticket retrieved successfully',
            'data' => new SupportResource($ticket)
        ]);
    }

    public function update(SupportRequest $request, int $id): JsonResponse
    {
        $dto = SupportDTO::fromRequest($request->validated());
        $success = $this->service->updateTicket($id, $dto);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Support ticket updated successfully']);
    }

    public function destroy(int $id): JsonResponse
    {
        $success = $this->service->deleteTicket($id);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Support ticket deleted successfully']);
    }

    public function resolve(Request $request, int $id): JsonResponse
    {
        $request->validate(['resolution' => 'required|string']);
        $success = $this->service->resolveTicket($id, $request->resolution);

        if (!$success) {
            return response()->json(['success' => false, 'message' => 'Ticket not found'], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Support ticket resolved successfully'
        ]);
    }
}
