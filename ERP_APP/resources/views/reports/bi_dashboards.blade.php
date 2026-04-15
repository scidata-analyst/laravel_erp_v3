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
                      data-bs-toggle="modal"
                      data-bs-target="#modalBI"
                      data-mode="edit"
                      data-id="{{ $widget->id }}"
                      data-name="{{ $widget->widget_name }}"
                      data-type="{{ $widget->chart_type }}"
                      data-source="{{ $widget->data_source_module }}"
                      data-refresh="{{ $widget->refresh_rate }}"
                      data-dashboard="{{ $widget->dashboard_name }}"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-bs-toggle="modal"
                      data-bs-target="#modalDelete"
                      data-id="{{ $widget->id }}"
                      data-label="Widget"
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
  <div class="erp-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
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
    fetch('{{ route("bi_dashboards.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#bi-dashboards-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#bi-dashboards-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalBI"]').forEach(btn => {
    btn.addEventListener('click', function() {
      const mode = this.dataset.mode || 'create';
      const form = document.getElementById('formBI');
      form.reset();
      document.getElementById('bi_widget_id').value = '';
      document.getElementById('modalBITitle').textContent = mode === 'edit' ? 'Edit BI Widget' : 'Add BI Widget';
    });
  });

  document.querySelector('#tbl-bi-dashboards').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      document.getElementById('modalBITitle').textContent = 'Edit BI Widget';
      document.getElementById('bi_widget_id').value = btn.dataset.id;
      document.getElementById('bi_widget_name').value = btn.dataset.name || '';
      document.getElementById('bi_chart_type').value = btn.dataset.type || '';
      document.getElementById('bi_data_source').value = btn.dataset.source || '';
      document.getElementById('bi_refresh_rate').value = btn.dataset.refresh || '';
      document.getElementById('bi_dashboard_name').value = btn.dataset.dashboard || '';
    }
  });

  document.querySelector('#tbl-bi-dashboards').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formBI').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('bi_widget_id').value;
    const url = id ? '{{ route("bi_dashboards.update", ["id" => ":id"]) }}'.replace(':id', id) : '{{ route("bi_dashboards.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      widget_name: document.getElementById('bi_widget_name').value,
      chart_type: document.getElementById('bi_chart_type').value,
      data_source_module: document.getElementById('bi_data_source').value,
      refresh_rate: document.getElementById('bi_refresh_rate').value,
      dashboard_name: document.getElementById('bi_dashboard_name').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'BI widget updated successfully' : 'BI widget added successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalBI')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving BI widget', 'error');
      }
    })
    .catch(() => showToast('Error saving BI widget', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("bi_dashboards.destroy", ["id" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('BI widget deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting BI widget', 'error');
      }
    })
    .catch(() => showToast('Error deleting BI widget', 'error'));
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