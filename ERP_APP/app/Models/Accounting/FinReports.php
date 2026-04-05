<?php

namespace App\Models\Accounting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FinReports extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_name',
        'name',
        'report_type',
        'type',
        'description',
        'report_data',
        'start_date',
        'end_date',
        'created_by',
        'status',
    ];

    protected $casts = [
        'report_data' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function isBalanceSheet(): bool
    {
        return $this->report_type === 'balance_sheet';
    }

    public function isIncomeStatement(): bool
    {
        return $this->report_type === 'income_statement';
    }

    public function isCashFlow(): bool
    {
        return $this->report_type === 'cash_flow';
    }

    public function isTrialBalance(): bool
    {
        return $this->report_type === 'trial_balance';
    }

    public function isProfitLoss(): bool
    {
        return $this->report_type === 'profit_loss';
    }

    public function isGenerated(): bool
    {
        return $this->status === 'generated';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function getProfitMarginAttribute(): float
    {
        $totalRevenue = (float) data_get($this->report_data, 'total_revenue', 0);
        $netIncome = (float) data_get($this->report_data, 'net_income', 0);

        if ($totalRevenue > 0) {
            return ($netIncome / $totalRevenue) * 100;
        }
        return 0;
    }

    public function getFormattedRevenueAttribute(): string
    {
        return '$' . number_format((float) data_get($this->report_data, 'total_revenue', 0), 2);
    }

    public function getFormattedExpensesAttribute(): string
    {
        return '$' . number_format((float) data_get($this->report_data, 'total_expenses', 0), 2);
    }

    public function getFormattedNetIncomeAttribute(): string
    {
        return '$' . number_format((float) data_get($this->report_data, 'net_income', 0), 2);
    }

    public function getReportPeriodAttribute(): string
    {
        return ($this->start_date?->format('M Y') ?? '') . ' - ' . ($this->end_date?->format('M Y') ?? '');
    }

    public function getNameAttribute(): string
    {
        return (string) $this->report_name;
    }

    public function setNameAttribute(?string $value): void
    {
        $this->attributes['report_name'] = $value;
    }

    public function getTypeAttribute(): string
    {
        return (string) $this->report_type;
    }

    public function setTypeAttribute(?string $value): void
    {
        $this->attributes['report_type'] = $value;
    }

    public function getPeriodStartAttribute(): ?string
    {
        return $this->start_date?->toDateString();
    }

    public function setPeriodStartAttribute(?string $value): void
    {
        $this->attributes['start_date'] = $value;
    }

    public function getPeriodEndAttribute(): ?string
    {
        return $this->end_date?->toDateString();
    }

    public function setPeriodEndAttribute(?string $value): void
    {
        $this->attributes['end_date'] = $value;
    }
}
