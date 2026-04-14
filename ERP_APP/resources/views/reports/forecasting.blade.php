@extends('layouts.erp')

@section('title', 'Forecasting')
@section('breadcrumb', 'Forecasting')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Forecasting</div>
    <div class="page-subtitle">Demand forecasting and trend analysis using historical data</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalForecast"><i class="bi bi-plus-lg"></i> New Forecast</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search forecasting…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Sales</option><option>Inventory</option><option>Revenue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Forecast Name</th><th>Type</th><th>Model</th><th>Period</th><th>Accuracy</th><th>Generated On</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
      @forelse ($data as $forecast)
      <tr>
        <td>{{ $forecast->forecast_name }}</td>
        <td>{{ $forecast->forecast_type }}</td>
        <td>{{ $forecast->model }}</td>
        <td>{{ \Carbon\Carbon::parse($forecast->period_from)->format('M Y') }} – {{ \Carbon\Carbon::parse($forecast->period_to)->format('M Y') }}</td>
        <td>{{ $forecast->accuracy_percentage ? $forecast->accuracy_percentage . '%' : '—' }}</td>
        <td>{{ \Carbon\Carbon::parse($forecast->created_at)->format('Y-m-d') }}</td>
        <td>
          @if($forecast->status === 'Active')
          <span class="badge-status badge-active">Active</span>
          @elseif($forecast->status === 'Archived')
          <span class="badge-status badge-inactive">Archived</span>
          @else
          <span class="badge-status">{{ $forecast->status }}</span>
          @endif
        </td>
        <td>
          <div class="d-flex gap-1">
            <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalForecast" title="Edit"><i class="bi bi-pencil"></i></button>
            <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Forecast" title="Delete"><i class="bi bi-trash"></i></button>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8" class="text-center text-muted">No forecasts found.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="erp-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
  </div>
</div>

<div class="modal fade" id="modalForecast" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Forecast</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Forecast Name</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Forecast Type</label><select class="erp-form-control"><option>Sales</option><option>Inventory</option><option>Revenue</option><option>Expense</option></select></div><div class="col-md-4"><label class="erp-form-label">Period From</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Period To</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Model</label><select class="erp-form-control"><option>Moving Average</option><option>Linear Regression</option><option>Exponential Smoothing</option></select></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Generate Forecast
        </button>
      </div>
    </div>
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