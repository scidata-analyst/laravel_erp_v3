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
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalForecast" data-mode="create">
      <i class="bi bi-plus-lg"></i> New Forecast
    </button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-forecasting" placeholder="Search forecasting…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Sales</option><option>Inventory</option><option>Revenue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-forecasting">
      <thead><tr><th>Forecast Name</th><th>Type</th><th>Model</th><th>Period</th><th>Accuracy</th><th>Generated On</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="forecasting-tbody">
      @forelse ($data as $forecast)
        <tr data-id="{{ $forecast->id }}">
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
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                      data-id="{{ $forecast->id }}"
                      data-mode="edit"
                      data-bs-toggle="modal" data-bs-target="#modalForecast"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-delete-id="{{ $forecast->id }}"
                      data-delete-label="Forecast"
                      data-bs-toggle="modal" data-bs-target="#modalDelete"
                      title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      @empty
      <tr><td colspan="8" class="text-center text-muted">No forecasts found.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalForecast" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modalForecastTitle" style="color:var(--text-primary);font-weight:600">New Forecast</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formForecast">
        <div class="modal-body">
          <input type="hidden" id="forecast_id" name="id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Forecast Name</label>
              <input class="erp-form-control" type="text" id="forecast_name" name="forecast_name" placeholder=""/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Forecast Type</label>
              <select class="erp-form-control" id="forecast_type" name="forecast_type">
                <option value="">Select Type</option>
                <option value="Sales">Sales</option>
                <option value="Inventory">Inventory</option>
                <option value="Revenue">Revenue</option>
                <option value="Expense">Expense</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Period From</label>
              <input class="erp-form-control" type="date" id="forecast_period_from" name="period_from" placeholder=""/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Period To</label>
              <input class="erp-form-control" type="date" id="forecast_period_to" name="period_to" placeholder=""/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Model</label>
              <select class="erp-form-control" id="forecast_model" name="model">
                <option value="">Select Model</option>
                <option value="Moving Average">Moving Average</option>
                <option value="Linear Regression">Linear Regression</option>
                <option value="Exponential Smoothing">Exponential Smoothing</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Generate Forecast
          </button>
        </div>
      </form>
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
        <input type="hidden" id="delete_id">
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalForecast = document.getElementById('modalForecast');
  const formForecast = document.getElementById('formForecast');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalForecast.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formForecast);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalForecastTitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Forecast';

      apiClient.show(API_ENDPOINTS.REPORTS.FORECASTING.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('forecast_id').value = item.id;
          formForecast.querySelector('[name="forecast_name"]').value = item.forecast_name || '';
          formForecast.querySelector('[name="forecast_type"]').value = item.forecast_type || '';
          formForecast.querySelector('[name="period_from"]').value = item.period_from ? item.period_from.split('T')[0] : '';
          formForecast.querySelector('[name="period_to"]').value = item.period_to ? item.period_to.split('T')[0] : '';
          formForecast.querySelector('[name="model"]').value = item.model || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Forecast';
      formForecast.reset();
      document.getElementById('forecast_id').value = '';
    }
  });

  formForecast.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('forecast_id').value;

    const formData = new FormData(formForecast);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.REPORTS.FORECASTING.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.REPORTS.FORECASTING.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalForecast).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formForecast, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'record';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.REPORTS.FORECASTING.DESTROY, deleteId)
    .then(data => {
      if (data.success || !data.error) {
        bootstrap.Modal.getInstance(modalDelete).hide();
        showToast(data.message || 'Deleted successfully', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => showToast(error.message || 'An error occurred', 'error'));
  });
});
</script>
@endpush