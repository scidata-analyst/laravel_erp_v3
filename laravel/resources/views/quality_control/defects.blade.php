@extends('layouts.erp')

@section('title', 'Defect Tracking')
@section('breadcrumb', 'Quality Control / Defect Tracking')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Defect Tracking</div>
    <div class="page-subtitle">Log, track and resolve product defects and non-conformances</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefect" data-mode="create"><i class="bi bi-plus-lg"></i> Log Defect</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search defect tracking…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Open</option>
      <option>In Review</option>
      <option>Resolved</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Defect #</th>
          <th>Product</th>
          <th>Batch/Lot</th>
          <th>Defect Type</th>
          <th>Severity</th>
          <th>Raised By</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $defect)
          <tr>
            <td>DEF-{{ $defect->id }}</td>
            <td>{{ $defect->product_id ?? 'N/A' }}</td>
            <td>{{ $defect->batch_lot_number ?? 'N/A' }}</td>
            <td>{{ $defect->defect_type ?? 'N/A' }}</td>
            <td>
              @if ($defect->severity == 'Critical')
                <span class="badge-status badge-inactive">Critical</span>
              @elseif ($defect->severity == 'High')
                <span class="badge-status badge-pending">High</span>
              @else
                <span class="badge-status badge-info">{{ $defect->severity }}</span>
              @endif
            </td>
            <td>—</td>
            <td>
              @if ($defect->status == 'Resolved')
                <span class="badge-status badge-active">Resolved</span>
              @elseif ($defect->status == 'Open')
                <span class="badge-status badge-pending">Open</span>
              @else
                <span class="badge-status badge-pending">In Review</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                  data-id="{{ $defect->id }}"
                  data-mode="edit"
                  data-bs-toggle="modal" data-bs-target="#modalDefect"
                  title="Edit"><i class="bi bi-pencil"></i></button>
                <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                  data-delete-id="{{ $defect->id }}"
                  data-delete-label="Defect" 
                  data-bs-toggle="modal" data-bs-target="#modalDelete"
                  title="Delete"><i class="bi bi-trash"></i></button>
              </div>
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

<div class="modal fade" id="modalDefect" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Log Defect</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-defect">
          <input type="hidden" name="id" id="defect-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Product</label>
              <select class="erp-form-control" name="product_id">
                <option value="">Select Product</option>
                <option>Assembled PCB Board</option>
                <option>Battery Pack 18V</option>
                <option>Steel Bracket</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Batch / Lot</label>
              <input class="erp-form-control" type="text" name="batch_lot_number" placeholder="LOT-XXXX-XXX" />
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Defect Type</label>
              <input class="erp-form-control" type="text" name="defect_type" placeholder="e.g. Dimensional Error" />
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Severity</label>
              <select class="erp-form-control" name="severity">
                <option value="">Select Severity</option>
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
                <option>Critical</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Qty Affected</label>
              <input class="erp-form-control" type="number" name="qty_affected" placeholder="" />
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Description / Root Cause</label>
              <textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Log Defect
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalDefect = document.getElementById('modalDefect');
  const formDefect = document.getElementById('form-defect');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalDefect.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formDefect);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Defect';

      apiClient.show(API_ENDPOINTS.QUALITY_CONTROL.DEFECTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('defect-id').value = item.id;
          formDefect.querySelector('[name="product_id"]').value = item.product_id || '';
          formDefect.querySelector('[name="batch_lot_number"]').value = item.batch_lot_number || '';
          formDefect.querySelector('[name="defect_type"]').value = item.defect_type || '';
          formDefect.querySelector('[name="severity"]').value = item.severity || '';
          formDefect.querySelector('[name="qty_affected"]').value = item.qty_affected || '';
          formDefect.querySelector('[name="description"]').value = item.description || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Log Defect';
      formDefect.reset();
      document.getElementById('defect-id').value = '';
    }
  });

  formDefect.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('defect-id').value;

    const formData = new FormData(formDefect);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.QUALITY_CONTROL.DEFECTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.QUALITY_CONTROL.DEFECTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalDefect).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formDefect, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.QUALITY_CONTROL.DEFECTS.DESTROY, deleteId)
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