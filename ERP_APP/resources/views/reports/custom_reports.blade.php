@extends('layouts.erp')

@section('title', 'Custom Reports')
@section('breadcrumb', 'Custom Reports')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Custom Reports</div>
    <div class="page-subtitle">Build and schedule custom reports from any module</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCustomReport" data-mode="create">
      <i class="bi bi-plus-lg"></i> Build Report
    </button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-custom-reports" placeholder="Search custom reports…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Sales</option><option>Inventory</option><option>Finance</option><option>HR</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-custom-reports">
      <thead><tr><th>Report Name</th><th>Module</th><th>Fields</th><th>Schedule</th><th>Last Run</th><th>Format</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="custom-reports-tbody">
      @forelse ($data as $report)
        <tr data-id="{{ $report->id }}">
          <td>{{ $report->report_name }}</td>
          <td>{{ $report->module }}</td>
          <td>{{ $report->selected_fields }}</td>
          <td>{{ $report->schedule }}</td>
          <td>{{ \Carbon\Carbon::parse($report->created_at)->format('Y-m-d') }}</td>
          <td>{{ $report->output_format }}</td>
          <td>
            @if($report->status === 'Active')
            <span class="badge-status badge-active">Active</span>
            @elseif($report->status === 'Inactive')
            <span class="badge-status badge-inactive">Inactive</span>
            @else
            <span class="badge-status">{{ $report->status }}</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                      data-bs-toggle="modal"
                      data-bs-target="#modalCustomReport"
                      data-mode="edit"
                      data-id="{{ $report->id }}"
                      data-name="{{ $report->report_name }}"
                      data-module="{{ $report->module }}"
                      data-fields="{{ $report->selected_fields }}"
                      data-filter="{{ $report->filter_by }}"
                      data-schedule="{{ $report->schedule }}"
                      data-format="{{ $report->output_format }}"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-bs-toggle="modal"
                      data-bs-target="#modalDelete"
                      data-id="{{ $report->id }}"
                      data-label="Custom Report"
                      title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div>
          </td>
        </tr>
      @empty
      <tr><td colspan="8" class="text-center text-muted">No custom reports found.</td></tr>
      @endforelse
      </tbody>
    </table>
  </div>
  <div class="erp-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
  </div>
</div>

<div class="modal fade" id="modalCustomReport" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modalCustomReportTitle" style="color:var(--text-primary);font-weight:600">Build Custom Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="formCustomReport">
        <div class="modal-body">
          <input type="hidden" id="custom_report_id" name="id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Report Name</label>
              <input class="erp-form-control" type="text" id="custom_report_name" name="report_name" placeholder=""/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Module</label>
              <select class="erp-form-control" id="custom_report_module" name="module">
                <option value="">Select Module</option>
                <option value="Sales">Sales</option>
                <option value="Purchase">Purchase</option>
                <option value="Inventory">Inventory</option>
                <option value="Finance">Finance</option>
                <option value="HR">HR</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Select Fields</label>
              <input class="erp-form-control" type="text" id="custom_report_fields" name="selected_fields" placeholder="e.g. Customer Name, Order Date, Total Amount"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Filter By</label>
              <select class="erp-form-control" id="custom_report_filter" name="filter_by">
                <option value="">Select Filter</option>
                <option value="Date Range">Date Range</option>
                <option value="Status">Status</option>
                <option value="Department">Department</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Schedule</label>
              <select class="erp-form-control" id="custom_report_schedule" name="schedule">
                <option value="">Select Schedule</option>
                <option value="Manual">Manual</option>
                <option value="Daily">Daily</option>
                <option value="Weekly">Weekly</option>
                <option value="Monthly">Monthly</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Output Format</label>
              <select class="erp-form-control" id="custom_report_format" name="output_format">
                <option value="">Select Format</option>
                <option value="PDF">PDF</option>
                <option value="Excel">Excel</option>
                <option value="Both">Both</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Build Report
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
    fetch('{{ route("custom_reports.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#custom-reports-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#custom-reports-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalCustomReport"]').forEach(btn => {
    btn.addEventListener('click', function() {
      const mode = this.dataset.mode || 'create';
      const form = document.getElementById('formCustomReport');
      form.reset();
      document.getElementById('custom_report_id').value = '';
      document.getElementById('modalCustomReportTitle').textContent = mode === 'edit' ? 'Edit Custom Report' : 'Build Custom Report';
    });
  });

  document.querySelector('#tbl-custom-reports').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      document.getElementById('modalCustomReportTitle').textContent = 'Edit Custom Report';
      document.getElementById('custom_report_id').value = btn.dataset.id;
      document.getElementById('custom_report_name').value = btn.dataset.name || '';
      document.getElementById('custom_report_module').value = btn.dataset.module || '';
      document.getElementById('custom_report_fields').value = btn.dataset.fields || '';
      document.getElementById('custom_report_filter').value = btn.dataset.filter || '';
      document.getElementById('custom_report_schedule').value = btn.dataset.schedule || '';
      document.getElementById('custom_report_format').value = btn.dataset.format || '';
    }
  });

  document.querySelector('#tbl-custom-reports').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formCustomReport').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('custom_report_id').value;
    const url = id ? '{{ route("custom_reports.update", ["custom_report" => ":id"]) }}'.replace(':id', id) : '{{ route("custom_reports.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      report_name: document.getElementById('custom_report_name').value,
      module: document.getElementById('custom_report_module').value,
      selected_fields: document.getElementById('custom_report_fields').value,
      filter_by: document.getElementById('custom_report_filter').value,
      schedule: document.getElementById('custom_report_schedule').value,
      output_format: document.getElementById('custom_report_format').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'Custom report updated successfully' : 'Custom report created successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalCustomReport')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving custom report', 'error');
      }
    })
    .catch(() => showToast('Error saving custom report', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("custom_reports.destroy", ["custom_report" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Custom report deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting custom report', 'error');
      }
    })
    .catch(() => showToast('Error deleting custom report', 'error'));
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