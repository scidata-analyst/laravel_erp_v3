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
                      data-bs-toggle="modal"
                      data-bs-target="#modalForecast"
                      data-mode="edit"
                      data-id="{{ $forecast->id }}"
                      data-name="{{ $forecast->forecast_name }}"
                      data-type="{{ $forecast->forecast_type }}"
                      data-from="{{ $forecast->period_from }}"
                      data-to="{{ $forecast->period_to }}"
                      data-model="{{ $forecast->model }}"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-bs-toggle="modal"
                      data-bs-target="#modalDelete"
                      data-id="{{ $forecast->id }}"
                      data-label="Forecast"
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
  <div class="erp-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
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
(function() {
  let deleteId = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 300); }, 3000);
  }

  function reloadTable() {
    fetch('{{ route("forecasting.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#forecasting-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#forecasting-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalForecast"]').forEach(btn => {
    btn.addEventListener('click', function() {
      const mode = this.dataset.mode || 'create';
      const form = document.getElementById('formForecast');
      form.reset();
      document.getElementById('forecast_id').value = '';
      document.getElementById('modalForecastTitle').textContent = mode === 'edit' ? 'Edit Forecast' : 'New Forecast';
    });
  });

  document.querySelector('#tbl-forecasting').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      document.getElementById('modalForecastTitle').textContent = 'Edit Forecast';
      document.getElementById('forecast_id').value = btn.dataset.id;
      document.getElementById('forecast_name').value = btn.dataset.name || '';
      document.getElementById('forecast_type').value = btn.dataset.type || '';
      document.getElementById('forecast_period_from').value = btn.dataset.from || '';
      document.getElementById('forecast_period_to').value = btn.dataset.to || '';
      document.getElementById('forecast_model').value = btn.dataset.model || '';
    }
  });

  document.querySelector('#tbl-forecasting').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formForecast').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('forecast_id').value;
    const url = id ? '{{ route("forecasting.update", ["forecasting" => ":id"]) }}'.replace(':id', id) : '{{ route("forecasting.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      forecast_name: document.getElementById('forecast_name').value,
      forecast_type: document.getElementById('forecast_type').value,
      period_from: document.getElementById('forecast_period_from').value,
      period_to: document.getElementById('forecast_period_to').value,
      model: document.getElementById('forecast_model').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'Forecast updated successfully' : 'Forecast generated successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalForecast')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving forecast', 'error');
      }
    })
    .catch(() => showToast('Error saving forecast', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("forecasting.destroy", ["forecasting" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Forecast deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting forecast', 'error');
      }
    })
    .catch(() => showToast('Error deleting forecast', 'error'));
  });
})();
</script>
<style>
.toast-notification {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 12px 20px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  color: var(--text-primary);
  font-size: 14px;
  z-index: 9999;
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}
.toast-notification.show { opacity: 1; transform: translateY(0); }
.toast-success i { color: var(--accent-2); }
.toast-error i { color: var(--accent-3); }
</style>
@endpush