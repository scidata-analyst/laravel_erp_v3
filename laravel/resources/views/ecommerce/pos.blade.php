@extends('layouts.erp')

@section('title', 'POS Terminals')
@section('breadcrumb', 'POS Terminals')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">POS Terminals</div>
      <div class="page-subtitle">Point-of-sale terminal management and session tracking</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPOS" data-mode="create"><i
          class="bi bi-plus-lg"></i> Add Terminal</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search pos terminals…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Online</option>
        <option>Offline</option>
        <option>Closed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Terminal ID</th>
            <th>Location</th>
            <th>Cashier</th>
            <th>Session Start</th>
            <th>Sales (Today)</th>
            <th>Transactions</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $pos)
            <tr>
              <td>{{ $pos->terminal_id }}</td>
              <td>{{ $pos->location ?? 'N/A' }}</td>
              <td>{{ $pos->assigned_cashier_id ?? '—' }}</td>
              <td>{{ $pos->created_at ? \Carbon\Carbon::parse($pos->created_at)->format('Y-m-d H:i') : '—' }}</td>
              <td>$0</td>
              <td>0 txns</td>
              <td>
                @if ($pos->status == 'Online' || $pos->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($pos->status == 'Offline')
                  <span class="badge-status badge-inactive">Offline</span>
                @else
                  <span class="badge-status badge-pending">{{ $pos->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalPOS" data-mode="edit" data-id="{{ $pos->id }}" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-id="{{ $pos->id }}" data-delete-label="Terminal" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalPOS" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add POS Terminal</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-pos">
          <div class="modal-body">
            <input type="hidden" name="id" id="pos_id">
            <div class="row g-3">
              <div class="col-md-6"><label class="erp-form-label">Terminal ID</label><input class="erp-form-control"
                  type="text" name="terminal_id" placeholder="POS-XXX" /></div>
              <div class="col-md-6"><label class="erp-form-label">Location</label><input class="erp-form-control"
                  type="text" name="location" placeholder="" /></div>
              <div class="col-md-6"><label class="erp-form-label">Assigned Cashier</label><select
                  class="erp-form-control" name="assigned_cashier_id">
                  <option value="">Select Cashier</option>
                  <option value="Anika R.">Anika R.</option>
                  <option value="Farhan S.">Farhan S.</option>
                  <option value="Tania M.">Tania M.</option>
                </select></div>
              <div class="col-md-6"><label class="erp-form-label">Warehouse / Inventory</label><select
                  class="erp-form-control" name="warehouse_id">
                  <option value="">Select Warehouse</option>
                  <option value="WH-A">WH-A</option>
                  <option value="WH-B">WH-B</option>
                </select></div>
              <div class="col-md-6"><label class="erp-form-label">Receipt Printer</label><input class="erp-form-control"
                  type="text" name="printer_ip" placeholder="Printer IP or model" /></div>
              <div class="col-md-6"><label class="erp-form-label">Status</label><select
                  class="erp-form-control" name="status">
                  <option value="Active">Active</option>
                  <option value="Offline">Offline</option>
                </select></div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Terminal
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
  const modalPOS = document.getElementById('modalPOS');
  const formPOS = document.getElementById('form-pos');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalPOS.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formPOS);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalPOS.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit POS Terminal';

      apiClient.show(API_ENDPOINTS.ECOMMERCE.POS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('pos_id').value = item.id;
          formPOS.querySelector('[name="terminal_id"]').value = item.terminal_id || '';
          formPOS.querySelector('[name="location"]').value = item.location || '';
          formPOS.querySelector('[name="assigned_cashier_id"]').value = item.assigned_cashier_id || '';
          formPOS.querySelector('[name="warehouse_id"]').value = item.warehouse_id || '';
          formPOS.querySelector('[name="printer_ip"]').value = item.printer_ip || '';
          formPOS.querySelector('[name="status"]').value = item.status || 'Active';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add POS Terminal';
      formPOS.reset();
      document.getElementById('pos_id').value = '';
    }
  });

  formPOS.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('pos_id').value;

    const formData = new FormData(formPOS);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.ECOMMERCE.POS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.ECOMMERCE.POS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalPOS).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formPOS, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.ECOMMERCE.POS.DESTROY, deleteId)
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