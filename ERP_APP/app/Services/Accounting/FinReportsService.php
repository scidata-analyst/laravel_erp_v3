<?php

namespace App\Services\Accounting;

use App\Interfaces\Accounting\FinReportsInterface;
use App\DTOs\Accounting\FinReportsDTO;
use App\Models\Accounting\FinReports;
use App\Models\Accounting\Gl;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FinReportsService
{
    public function __construct(
        protected FinReportsInterface $repository
    ) {}

    public function getReports(int $perPage = 15, string $search = '', array $filters = []): LengthAwarePaginator
    {
        return $this->repository->index($perPage, $search, $filters);
    }

    public function generateReport(FinReportsDTO $dto): FinReports
    {
        $reportData = $this->calculateReportData($dto->report_type, $dto->start_date, $dto->end_date);
        
        $data = $dto->toArray();
        $data['report_data'] = $reportData;
        $data['status'] = 'generated';

        return $this->repository->create($data);
    }

    protected function calculateReportData(string $type, string $start, string $end): array
    {
        // Complex logic to aggregate GL data based on type
        // For now, returning dummy summarized data
        return [
            'summary' => "Summarized $type from $start to $end",
            'total_assets' => Gl::where('account_type', 'Asset')->sum('balance'),
            'total_liabilities' => Gl::where('account_type', 'Liability')->sum('balance'),
            'net_income' => 50000.00 // Example
        ];
    }

    public function getReportById(int $id): ?FinReports
    {
        return $this->repository->read($id);
    }

    public function deleteReport(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
