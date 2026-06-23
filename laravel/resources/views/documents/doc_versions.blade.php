@extends('layouts.erp')

@section('title', 'Version Control')
@section('breadcrumb', 'Version Control')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Version Control</div>
    <div class="page-subtitle">Track document revision history and access control</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalVersion" data-mode="create"><i
        class="bi bi-plus-lg"></i> New Version</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search version control…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Latest</option>
      <option>Archived</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Document</th>
          <th>Version</th>
          <th>Changed By</th>
          <th>Change Summary</th>
          <th>Date</th>
          <th>Approved By</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $version)
          <tr data-version="{{ json_encode($version) }}">
            <td>{{ $version->document_id ?? 'N/A' }}</td>
            <td>{{ $version->version ?? 'v1.0' }}</td>
            <td>{{ $version->changed_by ?? 'N/A' }}</td>
            <td>{{ $version->change_summary ?? 'N/A' }}</td>
            <td>{{ $version->created_at ? \Carbon\Carbon::parse($version->created_at)->format('Y-m-d') : 'N/A' }}</td>
            <td>—</td>
            <td>
              @if ($version->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Archived</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                  data-bs-target="#modalVersion" title="Edit" data-mode="edit" data-id="{{ $version->id }}"><i class="bi bi-pencil"></i></button><button
                  class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                  data-delete-id="{{ $version->id }}" data-delete-label="Version" title="Delete"><i class="bi bi-trash"></i></button></div>
            </td>
          </tr>
        @endforeach
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

<div class="modal fade" id="modalVersion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add New Version</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-version">
        <div class="modal-body">
          <input type="hidden" name="id" id="version_id">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Document</label><select class="erp-form-control"
                name="document_id">
                <option value="Supplier Agreement – TechSource">Supplier Agreement – TechSource</option>
                <option value="Employee Handbook">Employee Handbook</option>
                <option value="Quality Manual">Quality Manual</option>
              </select></div>
            <div class="col-md-3"><label class="erp-form-label">New Version</label><input class="erp-form-control"
                type="text" name="version" placeholder="v2.2" /></div>
            <div class="col-md-3"><label class="erp-form-label">Change Type</label><select class="erp-form-control"
                name="change_type">
                <option value="Minor">Minor</option>
                <option value="Major">Major</option>
                <option value="Correction">Correction</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Change Summary</label><textarea
                class="erp-form-control" name="change_summary" rows="2" placeholder="Describe what changed…"></textarea></div>
            <div class="col-md-6"><label class="erp-form-label">Approver</label><select class="erp-form-control"
                name="approved_by">
                <option value="Adam K.">Adam K.</option>
                <option value="Sara L.">Sara L.</option>
                <option value="Maya P.">Maya P.</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Upload New File</label><input class="erp-form-control"
                type="file" name="file_path" placeholder="" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Version
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm
          Delete</h5>
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
  const modalVersion = document.getElementById('modalVersion');
  const formVersion = document.getElementById('form-version');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalVersion.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formVersion);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalVersion.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Version';

      apiClient.show(API_ENDPOINTS.DOCUMENTS.DOC_VERSIONS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('version_id').value = item.id;
          formVersion.querySelector('[name="document_id"]').value = item.document_id || '';
          formVersion.querySelector('[name="version"]').value = item.version || '';
          formVersion.querySelector('[name="change_type"]').value = item.change_type || 'Minor';
          formVersion.querySelector('[name="change_summary"]').value = item.change_summary || '';
          formVersion.querySelector('[name="approved_by"]').value = item.approved_by || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add New Version';
      formVersion.reset();
      document.getElementById('version_id').value = '';
    }
  });

  formVersion.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('version_id').value;

    const formData = new FormData(formVersion);

    let request;
    if (id) {
      const payload = Object.fromEntries(formData.entries());
      request = apiClient.update(API_ENDPOINTS.DOCUMENTS.DOC_VERSIONS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.DOCUMENTS.DOC_VERSIONS.STORE, formData);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalVersion).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formVersion, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.DOCUMENTS.DOC_VERSIONS.DESTROY, deleteId)
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
<style>
.toast-notification {
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  padding: 12px 20px;
  border-radius: 6px;
  color: white;
  animation: slideIn 0.3s ease;
}
.toast-success { background: #28a745; }
.toast-error { background: #dc3545; }
.toast-content { display: flex; align-items: center; gap: 10px; }
@keyframes slideIn {
  from { transform: translateX(100%); opacity: 0; }
  to { transform: translateX(0); opacity: 1; }
}
</style>
@endpush
