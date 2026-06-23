@extends('layouts.erp')

@section('title', 'Goods Receipt Notes')
@section('breadcrumb', 'Goods Receipt Notes')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Goods Receipt Notes</div>
    <div class="page-subtitle">Record goods received from suppliers against purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalGRN" data-mode="create"><i class="bi bi-plus-lg"></i> New GRN</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search goods receipt notes…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Received</option><option>Partial</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>GRN #</th><th>PO Reference</th><th>Supplier</th><th>Received Date</th><th>Items</th><th>Total Value</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $grn)
          <tr>
            <td>{{ $grn->grn_number }}</td>
             <td>{{ $grn->purchaseOrder->po_number ?? 'N/A' }}</td>
             <td>{{ $grn->supplier_name ?? 'N/A' }}</td>
            <td>{{ $grn->receipt_date ? \Carbon\Carbon::parse($grn->receipt_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1 items</td>
            <td>$0</td>
            <td>
              @if ($grn->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @elseif ($grn->status == 'Partial')
                <span class="badge-status badge-pending">Partial</span>
              @else
                <span class="badge-status badge-info">Draft</span>
              @endif
            </td>
            <td><div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                data-id="{{ $grn->id }}"
                data-mode="edit"
                data-bs-toggle="modal" data-bs-target="#modalGRN"
                title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-delete-id="{{ $grn->id }}"
                data-delete-label="{{ $grn->grn_number }}"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No GRN records found.</td>
          </tr>
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

<div class="modal fade" id="modalGRN" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Goods Receipt Note</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-grn">
        <div class="modal-body">
          <input type="hidden" name="id" id="grn-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Purchase Order</label>
              <select class="erp-form-control" name="purchase_order_id" id="purchase-order-id" required>
                <option value="">Select PO</option>
              </select>
              <div class="invalid-feedback" id="error-purchase_order_id"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Supplier</label>
               <input class="erp-form-control" type="text" name="supplier_name" id="supplier-name" placeholder="TechSource Ltd." required />
               <div class="invalid-feedback" id="error-supplier_name"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">GRN Number</label>
               <input class="erp-form-control" type="text" name="grn_number" id="grn-number" placeholder="GRN-XXX" required />
               <div class="invalid-feedback" id="error-grn_number"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">Receipt Date</label>
               <input class="erp-form-control" type="date" name="receipt_date" id="receipt-date" required />
               <div class="invalid-feedback" id="error-receipt_date"></div>
             </div>
            <div class="col-md-6">
              <label class="erp-form-label">Warehouse</label>
              <select class="erp-form-control" name="warehouse_id" id="warehouse-id" required>
                <option value="">Select Warehouse</option>
              </select>
              <div class="invalid-feedback" id="error-warehouse_id"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Notes</label>
              <textarea class="erp-form-control" name="notes" id="notes" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-notes"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Status</label>
               <select class="erp-form-control" name="status" id="status">
                 <option value="Draft">Draft</option>
                 <option value="Partial">Partial</option>
                 <option value="Received">Received</option>
               </select>
               <div class="invalid-feedback" id="error-status"></div>
             </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save GRN
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
  const modalGRN = document.getElementById('modalGRN');
  const formGRN = document.getElementById('form-grn');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  function loadPurchaseOrders() {
    fetch('{{ route("purchase_orders.all") }}')
      .then(res => res.json())
      .then(res => {
        if (res.success && res.data) {
          const select = document.getElementById('purchase-order-id');
          select.innerHTML = '<option value="">Select PO</option>';
          res.data.forEach(po => {
            select.innerHTML += `<option value="${po.id}">${po.po_number}</option>`;
          });
        }
      })
      .catch(e => console.warn('Failed to load purchase orders'));
  }

  function loadWarehouses() {
    fetch('{{ route("warehouses.all") }}')
      .then(res => res.json())
      .then(res => {
        if (res.success && res.data) {
          const select = document.getElementById('warehouse-id');
          select.innerHTML = '<option value="">Select Warehouse</option>';
          res.data.forEach(w => {
            select.innerHTML += `<option value="${w.id}">${w.warehouse_name} (${w.warehouse_code})</option>`;
          });
        }
      })
      .catch(e => console.warn('Failed to load warehouses'));
  }

  loadPurchaseOrders();
  loadWarehouses();

  modalGRN.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formGRN);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Goods Receipt Note';

      apiClient.show(API_ENDPOINTS.PURCHASE.GRN.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('grn-id').value = item.id;
          formGRN.querySelector('[name="purchase_order_id"]').value = item.purchase_order_id || '';
          formGRN.querySelector('[name="supplier_name"]').value = item.supplier_name || '';
          formGRN.querySelector('[name="grn_number"]').value = item.grn_number || '';
          formGRN.querySelector('[name="receipt_date"]').value = item.receipt_date ? item.receipt_date.split('T')[0] : '';
          formGRN.querySelector('[name="warehouse_id"]').value = item.warehouse_id || '';
          formGRN.querySelector('[name="notes"]').value = item.notes || '';
          formGRN.querySelector('[name="status"]').value = item.status || 'Draft';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Goods Receipt Note';
      formGRN.reset();
      document.getElementById('grn-id').value = '';
    }
  });

  formGRN.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('grn-id').value;

    const formData = new FormData(formGRN);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PURCHASE.GRN.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PURCHASE.GRN.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalGRN).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formGRN, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'this GRN';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.PURCHASE.GRN.DESTROY, deleteId)
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