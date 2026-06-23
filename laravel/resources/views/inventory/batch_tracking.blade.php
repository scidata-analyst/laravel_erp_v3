@extends('layouts.erp')

@section('title', 'Batch / Expiry Tracking')
@section('breadcrumb', 'Inventory / Batch / Expiry Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Batch / Expiry / Serial Tracking</div>
      <div class="page-subtitle">Track lot numbers, serial IDs and expiry dates</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBatch" data-mode="create"><i
          class="bi bi-plus-lg"></i> Add Batch</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main"
          placeholder="Search batch / expiry / serial tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Expiring Soon</option>
        <option>Expired</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Batch/Lot #</th>
            <th>Serial</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Mfg Date</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $batch)
            <tr>
              <td>{{ $batch->batch_lot_number }}</td>
              <td>{{ $batch->serial_number ?? 'N/A' }}</td>
               <td>{{ $batch->product->product_name ?? 'N/A' }}</td>
              <td>{{ $batch->quantity }}</td>
              <td>{{ $batch->manufacture_date ? \Carbon\Carbon::parse($batch->manufacture_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $batch->expiry_date ? \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if (\Carbon\Carbon::parse($batch->expiry_date)->isPast())
                  <span class="badge-status badge-inactive">Expired</span>
                @else
                  <span class="badge-status badge-active">Active</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $batch->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalBatch" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $batch->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Batch" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalBatch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add Batch / Serial</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-batch">
            @csrf
            <input type="hidden" name="id" id="batch-id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product</label>
                <select class="erp-form-control" name="product_id" id="product_id" required>
                  <option value="">Select Product</option>
                </select>
                <div class="invalid-feedback" id="error-product_id"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Batch / Lot #</label>
                <input class="erp-form-control" name="batch_lot_number" id="batch_lot_number" type="text" placeholder="LOT-XXXX-XXX" required />
                <div class="invalid-feedback" id="error-batch_lot_number"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Serial Number</label>
                <input class="erp-form-control" name="serial_number" id="serial_number" type="text" placeholder="SN-XXXXX" />
                <div class="invalid-feedback" id="error-serial_number"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Quantity</label>
                <input class="erp-form-control" name="quantity" id="quantity" type="number" placeholder="" required min="1" />
                <div class="invalid-feedback" id="error-quantity"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Manufacturing Date</label>
                <input class="erp-form-control" name="manufacture_date" id="manufacture_date" type="date" placeholder="" />
                <div class="invalid-feedback" id="error-manufacture_date"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Expiry Date</label>
                <input class="erp-form-control" name="expiry_date" id="expiry_date" type="date" placeholder="" />
                <div class="invalid-feedback" id="error-expiry_date"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" form="form-batch" class="btn-erp btn-primary btn-modal-save" id="btn-save">
            <i class="bi bi-check2"></i> Save Batch
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

   @push('scripts')
     <script>
document.addEventListener('DOMContentLoaded', function() {
  const modalBatch = document.getElementById('modalBatch');
  const formBatch = document.getElementById('form-batch');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');
  const productSelect = document.getElementById('product_id');

  let deleteId = null;

  apiClient.get(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.ALL)
    .then(data => {
      if (data.success && data.data) {
        productSelect.innerHTML = '<option value="">Select Product</option>';
        data.data.forEach(p => {
          productSelect.innerHTML += `<option value="${p.id}">${p.product_name} (${p.sku})</option>`;
        });
      }
    })
    .catch(() => console.warn('Failed to load products'));

  modalBatch.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formBatch);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Batch / Serial';

      apiClient.show(API_ENDPOINTS.INVENTORY.BATCH_TRACKING.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('batch-id').value = item.id;
          formBatch.querySelector('[name="product_id"]').value = item.product_id || '';
          formBatch.querySelector('[name="batch_lot_number"]').value = item.batch_lot_number || '';
          formBatch.querySelector('[name="serial_number"]').value = item.serial_number || '';
          formBatch.querySelector('[name="quantity"]').value = item.quantity || '';
          formBatch.querySelector('[name="manufacture_date"]').value = item.manufacture_date ? item.manufacture_date.substring(0, 10) : '';
          formBatch.querySelector('[name="expiry_date"]').value = item.expiry_date ? item.expiry_date.substring(0, 10) : '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Batch / Serial';
      formBatch.reset();
      document.getElementById('batch-id').value = '';
    }
  });

  formBatch.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('batch-id').value;

    const formData = new FormData(formBatch);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.INVENTORY.BATCH_TRACKING.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.INVENTORY.BATCH_TRACKING.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalBatch).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formBatch, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.INVENTORY.BATCH_TRACKING.DESTROY, deleteId)
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
@endsection