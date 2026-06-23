@extends('layouts.erp')

@section('title', 'BI Dashboards')
@section('breadcrumb', 'BI Dashboards')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">BI Dashboards</div>
    <div class="page-subtitle">Custom BI dashboard widgets and visualization management</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBI" data-mode="create">
      <i class="bi bi-plus-lg"></i> Add Widget
    </button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-bi-dashboards" placeholder="Search bi dashboards…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Chart</option><option>KPI</option><option>Table</option><option>Map</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-bi-dashboards">
      <thead><tr><th>Widget Name</th><th>Type</th><th>Data Source</th><th>Refresh Rate</th><th>Dashboard</th><th>Created By</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="bi-dashboards-tbody">
      @forelse ($data as $widget)
        <tr data-id="{{ $widget->id }}">
          <td>{{ $widget->widget_name }}</td>
          <td>{{ $widget->chart_type }}</td>
          <td>{{ $widget->data_source_module }}</td>
          <td>{{ $widget->refresh_rate }}</td>
          <td>{{ $widget->dashboard_name }}</td>
          <td>{{ $widget->created_by_user_id }}</td>
          <td>
            @if($widget->status === 'Active')
            <span class="badge-status badge-active">Active</span>
            @elseif($widget->status === 'Inactive')
            <span class="badge-status badge-inactive">Inactive</span>
            @else
            <span class="badge-status">{{ $widget->status }}</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                      data-id="{{ $widget->id }}"
                      data-mode="edit"
                      data-bs-toggle="modal" data-bs-target="#modalBI"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-delete-id="{{ $widget->id }}"
                      data-delete-label="Widget"
                      data-bs-toggle="modal" data-bs-target="#modalDelete"
                      title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      @empty
      <tr><td colspan="8" class="text-center text-muted">No BI widgets found.</td></tr>
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

<div class="modal fade" id="modalBI" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modalBITitle" style="color:var(--text-primary);font-weight:600">Add BI Widget</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formBI">
        <div class="modal-body">
          <input type="hidden" id="bi_widget_id" name="id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Widget Name</label>
              <input class="erp-form-control" type="text" id="bi_widget_name" name="widget_name" placeholder=""/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Chart Type</label>
              <select class="erp-form-control" id="bi_chart_type" name="chart_type">
                <option value="">Select Type</option>
                <option value="Bar Chart">Bar Chart</option>
                <option value="Line Chart">Line Chart</option>
                <option value="Pie/Donut">Pie/Donut</option>
                <option value="KPI Tile">KPI Tile</option>
                <option value="Table">Table</option>
                <option value="Map">Map</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Data Source / Module</label>
              <select class="erp-form-control" id="bi_data_source" name="data_source_module">
                <option value="">Select Source</option>
                <option value="Sales">Sales</option>
                <option value="Finance">Finance</option>
                <option value="Inventory">Inventory</option>
                <option value="HR">HR</option>
                <option value="CRM">CRM</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Refresh Rate</label>
              <select class="erp-form-control" id="bi_refresh_rate" name="refresh_rate">
                <option value="">Select Rate</option>
                <option value="Real-time">Real-time</option>
                <option value="Hourly">Hourly</option>
                <option value="Daily">Daily</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Dashboard</label>
              <input class="erp-form-control" type="text" id="bi_dashboard_name" name="dashboard_name" placeholder="Dashboard name"/>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Add Widget
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
  const modalBI = document.getElementById('modalBI');
  const formBI = document.getElementById('formBI');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalBI.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formBI);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalBITitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit BI Widget';

      apiClient.show(API_ENDPOINTS.REPORTS.BI_DASHBOARDS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('bi_widget_id').value = item.id;
          formBI.querySelector('[name="widget_name"]').value = item.widget_name || '';
          formBI.querySelector('[name="chart_type"]').value = item.chart_type || '';
          formBI.querySelector('[name="data_source_module"]').value = item.data_source_module || '';
          formBI.querySelector('[name="refresh_rate"]').value = item.refresh_rate || '';
          formBI.querySelector('[name="dashboard_name"]').value = item.dashboard_name || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add BI Widget';
      formBI.reset();
      document.getElementById('bi_widget_id').value = '';
    }
  });

  formBI.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('bi_widget_id').value;

    const formData = new FormData(formBI);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.REPORTS.BI_DASHBOARDS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.REPORTS.BI_DASHBOARDS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalBI).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formBI, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.REPORTS.BI_DASHBOARDS.DESTROY, deleteId)
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