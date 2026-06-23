@extends('layouts.erp')

@section('title', 'Document Library')
@section('breadcrumb', 'Document Library')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Document Library</div>
    <div class="page-subtitle">Centralized document storage for contracts, POs and invoices</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDocument" data-mode="create"><i
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
                  title="Edit" data-mode="edit" data-id="{{ $doc->id }}"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon"
                  data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-id="{{ $doc->id }}" data-delete-label="Upload Document"
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
      <form id="form-document">
        <div class="modal-body">
          <input type="hidden" name="id" id="document_id">
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
          <button type="submit" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Upload
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
  const modalDocument = document.getElementById('modalDocument');
  const formDocument = document.getElementById('form-document');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalDocument.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formDocument);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalDocument.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Document';

      apiClient.show(API_ENDPOINTS.DOCUMENTS.DOC_LIBRARY.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('document_id').value = item.id;
          formDocument.querySelector('[name="document_name"]').value = item.document_name || '';
          formDocument.querySelector('[name="document_type"]').value = item.document_type || '';
          formDocument.querySelector('[name="related_to"]').value = item.related_to || '';
          formDocument.querySelector('[name="version"]').value = item.version || '';
          formDocument.querySelector('[name="access_level"]').value = item.access_level || 'Private';
          formDocument.querySelector('[name="notes"]').value = item.notes || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Upload Document';
      formDocument.reset();
      document.getElementById('document_id').value = '';
    }
  });

  formDocument.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('document_id').value;

    const formData = new FormData(formDocument);

    let request;
    if (id) {
      const payload = Object.fromEntries(formData.entries());
      request = apiClient.update(API_ENDPOINTS.DOCUMENTS.DOC_LIBRARY.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.DOCUMENTS.DOC_LIBRARY.STORE, formData);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalDocument).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formDocument, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.DOCUMENTS.DOC_LIBRARY.DESTROY, deleteId)
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
