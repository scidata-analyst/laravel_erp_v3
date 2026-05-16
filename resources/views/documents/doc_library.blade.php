@extends('layouts.erp')

@section('title', 'Document Library')
@section('breadcrumb', 'Document Library')

@section('content')
<form id="form-document" method="POST" action="{{ route('doc_library.store') }}">
  @csrf
  <input type="hidden" name="_method" value="POST" />
<div class="page-header">
  <div>
    <div class="page-title">Document Library</div>
    <div class="page-subtitle">Centralized document storage for contracts, POs and invoices</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDocument" data-mode="create" data-route="{{ route('doc_library.store') }}"><i
        class="bi bi-plus-lg"></i> Upload Document</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search document library…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Contract</option>
      <option>Invoice</option>
      <option>PO</option>
      <option>Report</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Document Name</th>
          <th>Type</th>
          <th>Related To</th>
          <th>Version</th>
          <th>Size</th>
          <th>Uploaded By</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $doc)
          <tr data-document="{{ json_encode($doc) }}">
            <td>{{ $doc->document_name }}</td>
            <td>{{ $doc->document_type ?? 'N/A' }}</td>
            <td>{{ $doc->related_to ?? 'N/A' }}</td>
            <td>{{ $doc->version ?? 'v1.0' }}</td>
            <td>0 KB</td>
            <td>{{ $doc->uploaded_by_user_id ?? 'N/A' }}</td>
            <td>{{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              <div class="d-flex gap-1"><button class="btn-erp btn-success btn-xs btn-icon btn-download"
                  title="Download" data-route="{{ route('doc_library.show', $doc->id) }}"><i class="bi bi-download"></i></button><button
                  class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDocument"
                  title="Edit" data-mode="edit" data-route="{{ route('doc_library.update', $doc->id) }}" data-document="{{ json_encode($doc) }}"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon"
                  data-bs-toggle="modal" data-bs-target="#modalDelete" data-route="{{ route('doc_library.destroy', $doc->id) }}" data-label="Upload Document"
                  title="Delete"><i class="bi bi-trash"></i></button></div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
    </div>
    <div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalDocument" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Upload Document</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Document Name</label><input class="erp-form-control"
              type="text" name="document_name" placeholder="" /></div>
          <div class="col-md-6"><label class="erp-form-label">Document Type</label><select class="erp-form-control"
              name="document_type">
              <option value="Contract">Contract</option>
              <option value="Invoice">Invoice</option>
              <option value="Purchase Order">Purchase Order</option>
              <option value="Report">Report</option>
              <option value="Certificate">Certificate</option>
            </select></div>
          <div class="col-md-6"><label class="erp-form-label">Related To</label><input class="erp-form-control"
              type="text" name="related_to" placeholder="Supplier, Customer, Project…" /></div>
          <div class="col-md-3"><label class="erp-form-label">Version</label><input class="erp-form-control"
              type="text" name="version" placeholder="v1.0" /></div>
          <div class="col-md-3"><label class="erp-form-label">Access Level</label><select class="erp-form-control"
              name="access_level">
              <option value="Public">Public</option>
              <option value="Private">Private</option>
              <option value="Restricted">Restricted</option>
            </select></div>
          <div class="col-md-12"><label class="erp-form-label">Upload File</label><input class="erp-form-control"
              type="file" name="file_path" placeholder="" /></div>
          <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control"
              name="notes" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="form-document" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Upload
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
  const modalDocument = document.getElementById('modalDocument');
  const modalDelete = document.getElementById('modalDelete');
  const formDocument = document.getElementById('form-document');
  let deleteUrl = null;

  modalDocument.addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    const mode = btn?.dataset.mode || 'create';
    const route = btn?.dataset.route || '{{ route("doc_library.store") }}';
    
    formDocument.action = route;
    formDocument.querySelector('input[name="_method"]').value = mode === 'create' ? 'POST' : 'PUT';
    
    const title = modalDocument.querySelector('.modal-title');
    const submitBtn = modalDocument.querySelector('.btn-modal-save');
    
    if (mode === 'edit') {
      title.textContent = 'Edit Document';
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update Document';
      
      const doc = JSON.parse(btn.dataset.document);
      formDocument.querySelector('[name="document_name"]').value = doc.document_name || '';
      formDocument.querySelector('[name="document_type"]').value = doc.document_type || '';
      formDocument.querySelector('[name="related_to"]').value = doc.related_to || '';
      formDocument.querySelector('[name="version"]').value = doc.version || '';
      formDocument.querySelector('[name="access_level"]').value = doc.access_level || 'Private';
      formDocument.querySelector('[name="notes"]').value = doc.notes || '';
    } else {
      title.textContent = 'Upload Document';
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Upload Document';
      formDocument.reset();
    }
  });

  formDocument.addEventListener('submit', async function(e) {
    e.preventDefault();
    const submitBtn = formDocument.querySelector('button[type="submit"]');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

    try {
      const formData = new FormData(formDocument);
      const method = formDocument.querySelector('input[name="_method"]').value;
      const url = formDocument.action;

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
        bootstrap.Modal.getInstance(modalDocument)?.hide();
        showToast(result.message || 'Document saved successfully', 'success');
        setTimeout(() => window.location.reload(), 1000);
      } else {
        showToast(result.message || 'Failed to save document', 'error');
      }
    } catch (error) {
      showToast('An error occurred while saving', 'error');
    } finally {
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<i class="bi bi-check2"></i> Upload Document';
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
