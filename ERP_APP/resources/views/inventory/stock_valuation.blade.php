@extends('layouts.erp')

@section('title', 'Stock Valuation')
@section('breadcrumb', 'Stock Valuation')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Stock Valuation</div>
    <div class="page-subtitle">FIFO / LIFO / Average Cost methods</div>
  </div>
  <div class="d-flex gap-2">
    <select class="erp-form-control" style="width:150px">
      <option>FIFO</option>
      <option>LIFO</option>
      <option>Average Cost</option>
    </select>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="kpi-tile blue">
      <div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div>
      <div class="kpi-value">$1.24M</div>
      <div class="kpi-label">Total Stock Value (FIFO)</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile yellow">
      <div class="kpi-icon yellow"><i class="bi bi-stack"></i></div>
      <div class="kpi-value">14,230</div>
      <div class="kpi-label">Total Units</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile green">
      <div class="kpi-icon green"><i class="bi bi-graph-up"></i></div>
      <div class="kpi-value">$87.24</div>
      <div class="kpi-label">Avg Unit Value</div>
    </div>
  </div>
</div>
<div class="erp-card">
  <div class="erp-table-wrap">
    <table class="erp-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>SKU</th>
          <th>Qty on Hand</th>
          <th>Cost Method</th>
          <th>Unit Cost</th>
          <th>Total Value</th>
          <th>Last Updated</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $valuation)
        <tr>
          <td>{{ $valuation->product_id ?? 'N/A' }}</td>
          <td>—</td>
          <td>{{ $valuation->quantity_on_hand ?? 0 }}</td>
          <td>{{ $valuation->valuation_method ?? 'FIFO' }}</td>
          <td>${{ number_format($valuation->unit_cost ?? 0, 2) }}</td>
          <td>${{ number_format($valuation->total_value ?? 0, 2) }}</td>
          <td>{{ $valuation->updated_at ? \Carbon\Carbon::parse($valuation->updated_at)->format('Y-m-d') : 'N/A' }}</td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted">No stock valuations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary);font-size:14px">
          Are you sure you want to delete this
          <strong id="delete-target" style="color:var(--text-primary)">record</strong>?
          This action cannot be undone.
        </p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger" id="btn-confirm-delete">
          <i class="bi bi-trash"></i> Delete
        </button>
      </div>
    </div>
  </div>
</div>
@endsection