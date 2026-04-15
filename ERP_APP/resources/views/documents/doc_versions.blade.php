@extends('layouts.erp')

@section('title', 'Version Control')
@section('breadcrumb', 'Version Control')

@section('content')
<form id="form-version" method="POST" action="{{ route('doc_versions.store') }}">
  @csrf
  <input type="hidden" name="_method" value="POST" />
<div class="page-header">
  <div>
    <div class="page-title">Version Control</div>
    <div class="page-subtitle">Track document revision history and access control</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalVersion" data-mode="create" data-route="{{ route('doc_versions.store') }}"><i
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
                  data-bs-target="#modalVersion" title="Edit" data-mode="edit" data-route="{{ route('doc_versions.update', $version->id) }}" data-version="{{ json_encode($version) }}"><i class="bi bi-pencil"></i></button><button
                  class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                  data-route="{{ route('doc_versions.destroy', $version->id) }}" data-label="Version" title="Delete"><i class="bi bi-trash"></i></button></div>
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
      <div class="modal-body">
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
        <button type="submit" form="form-version" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Version
        </button>
      </div>
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
</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalVersion = document.getElementById('modalVersion');
  const modalDelete = document.getElementById('modalDelete');
  const formVersion = document.getElementById('form-version');
  let deleteUrl = null;

  modalVersion.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const mode = btn?.dataset.mode || 'create';
    const route = btn?.dataset.route || '{{ route("doc_versions.store") }}';
    
    formVersion.action = route;
    formVersion.querySelector('input[name="_method"]').value = mode === 'create' ? 'POST' : 'PUT';
    
    const title = modalVersion.querySelector('.modal-title');
    const submitBtn = modalVersion.querySelector('.btn-modal-save');
    
    if (mode === 'edit') {
      title.textContent = 'Edit Version';
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update Version';
      
      const version = JSON.parse(btn.dataset.version);
      formVersion.querySelector('[name="document_id"]').value = version.document_id || '';
      formVersion.querySelector('[name="version"]').value = version.version || '';
      formVersion.querySelector('[name="change_type"]').value = version.change_type || 'Minor';
      formVersion.querySelector('[name="change_summary"]').value = version.change_summary || '';
      formVersion.querySelector('[name="approved_by"]').value = version.approved_by || '';
    } else {
      title.textContent = 'Add New Version';
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Version';
      formVersion.reset();
    }
  });

  formVersion.addEventListener('submit', async function(e) {
    e.preventDefault();
    const submitBtn = formVersion.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

    try {
      const formData = new FormData(formVersion);
      const method = formVersion.querySelector('input[name="_method"]').value;
      const url = formVersion.action;

      const response = await fetch(url, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        },
        body: method === 'PUT' ? new URLSearchParams(formData) : formData
      });

      const result = await response.json();

      if (result.success) {
        bootstrap.Modal.getInstance(modalVersion)?.hide();
        showToast(result.message || 'Version saved successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(result.message || 'Failed to save version', 'error');
      }
    } catch (error) {
      showToast('An error occurred while saving', 'error');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Version';
    }
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    deleteUrl = btn?.dataset.route;
    const label = btn?.dataset.label || 'record';
    document.getElementById('delete-target').textContent = label;
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', async function() {
    if (!deleteUrl) return;
    
    this.disabled = true;
    this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';

    try {
      const response = await fetch(deleteUrl, {
        method: 'DELETE',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json'
        }
      });

      const result = await response.json();

      if (result.success) {
        bootstrap.Modal.getInstance(modalDelete)?.hide();
        showToast(result.message || 'Deleted successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(result.message || 'Failed to delete', 'error');
      }
    } catch (error) {
      showToast('An error occurred while deleting', 'error');
    } finally {
      this.disabled = false;
      this.innerHTML = '<i class="bi bi-trash"></i> Delete';
    }
  });

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
      <div class="toast-content">
        <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i>
        <span>${message}</span>
      </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }
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
