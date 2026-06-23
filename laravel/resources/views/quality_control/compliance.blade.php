@extends('layouts.erp')

@section('title', 'Compliance Reports')
@section('breadcrumb', 'Compliance Reports')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Compliance Reports</div>
    <div class="page-subtitle">Regulatory compliance reports and certification tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCompliance" data-mode="create"><i class="bi bi-plus-lg"></i> New Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search compliance reports…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Compliant</option><option>Non-Compliant</option><option>Pending</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Report #</th><th>Standard/Regulation</th><th>Scope</th><th>Audit Date</th><th>Next Audit</th><th>Auditor</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $compliance)
        <tr>
          <td>COMP-{{ $compliance->id }}</td>
          <td>{{ $compliance->standard_regulation }}</td>
          <td>{{ $compliance->scope }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->audit_date)->format('Y-m-d') }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->next_audit_date)->format('Y-m-d') }}</td>
          <td>{{ $compliance->auditor }}</td>
          <td>
            @if($compliance->status === 'Compliant' || $compliance->status === 'Active')
            <span class="badge-status badge-active">Compliant</span>
            @elseif($compliance->status === 'Non-Compliant' || $compliance->status === 'Failed')
            <span class="badge-status badge-inactive">Failed</span>
            @elseif($compliance->status === 'Pending')
            <span class="badge-status badge-pending">Pending</span>
            @else
            <span class="badge-status">{{ $compliance->status }}</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                data-id="{{ $compliance->id }}"
                data-mode="edit"
                data-bs-toggle="modal" data-bs-target="#modalCompliance"
                title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                data-delete-id="{{ $compliance->id }}"
                data-delete-label="Report" 
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                title="Delete"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No compliance reports found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div class="erp-pagination">
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalCompliance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New Compliance Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-compliance">
          <input type="hidden" name="id" id="compliance-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Standard / Regulation</label>
              <input class="erp-form-control" type="text" name="standard_regulation" placeholder="e.g. ISO 9001:2015"/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Scope</label>
              <input class="erp-form-control" type="text" name="scope" placeholder=""/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Audit Date</label>
              <input class="erp-form-control" type="date" name="audit_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Next Audit</label>
              <input class="erp-form-control" type="date" name="next_audit_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Auditor</label>
              <input class="erp-form-control" type="text" name="auditor" placeholder=""/>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Findings / Notes</label>
              <textarea class="erp-form-control" name="findings_notes" rows="2" placeholder=""></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalCompliance = document.getElementById('modalCompliance');
  const formCompliance = document.getElementById('form-compliance');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalCompliance.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formCompliance);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Compliance Report';

      apiClient.show(API_ENDPOINTS.QUALITY_CONTROL.COMPLIANCE.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('compliance-id').value = item.id;
          formCompliance.querySelector('[name="standard_regulation"]').value = item.standard_regulation || '';
          formCompliance.querySelector('[name="scope"]').value = item.scope || '';
          formCompliance.querySelector('[name="audit_date"]').value = item.audit_date ? item.audit_date.split('T')[0] : '';
          formCompliance.querySelector('[name="next_audit_date"]').value = item.next_audit_date ? item.next_audit_date.split('T')[0] : '';
          formCompliance.querySelector('[name="auditor"]').value = item.auditor || '';
          formCompliance.querySelector('[name="findings_notes"]').value = item.findings_notes || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Compliance Report';
      formCompliance.reset();
      document.getElementById('compliance-id').value = '';
    }
  });

  formCompliance.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('compliance-id').value;

    const formData = new FormData(formCompliance);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.QUALITY_CONTROL.COMPLIANCE.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.QUALITY_CONTROL.COMPLIANCE.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalCompliance).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formCompliance, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.QUALITY_CONTROL.COMPLIANCE.DESTROY, deleteId)
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