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
                      data-id="{{ $report->id }}"
                      data-mode="edit"
                      data-bs-toggle="modal" data-bs-target="#modalCustomReport"
                      title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                      data-delete-id="{{ $report->id }}"
                      data-delete-label="Custom Report"
                      data-bs-toggle="modal" data-bs-target="#modalDelete"
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
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
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
document.addEventListener('DOMContentLoaded', function() {
  const modalCustomReport = document.getElementById('modalCustomReport');
  const formCustomReport = document.getElementById('formCustomReport');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalCustomReport.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formCustomReport);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalCustomReportTitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Custom Report';

      apiClient.show(API_ENDPOINTS.REPORTS.CUSTOM_REPORTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('custom_report_id').value = item.id;
          formCustomReport.querySelector('[name="report_name"]').value = item.report_name || '';
          formCustomReport.querySelector('[name="module"]').value = item.module || '';
          formCustomReport.querySelector('[name="selected_fields"]').value = item.selected_fields || '';
          formCustomReport.querySelector('[name="filter_by"]').value = item.filter_by || '';
          formCustomReport.querySelector('[name="schedule"]').value = item.schedule || '';
          formCustomReport.querySelector('[name="output_format"]').value = item.output_format || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Build Custom Report';
      formCustomReport.reset();
      document.getElementById('custom_report_id').value = '';
    }
  });

  formCustomReport.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('custom_report_id').value;

    const formData = new FormData(formCustomReport);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.REPORTS.CUSTOM_REPORTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.REPORTS.CUSTOM_REPORTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalCustomReport).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formCustomReport, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.REPORTS.CUSTOM_REPORTS.DESTROY, deleteId)
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