@extends('layouts.erp')

@section('title', 'Purchase Orders')
@section('breadcrumb', 'Purchase Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Purchase Orders</div>
    <div class="page-subtitle">Create, approve and track purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPO" data-mode="create"><i class="bi bi-plus-lg"></i> New PO</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search purchase orders…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Pending</option><option>Approved</option><option>Received</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>PO #</th><th>Supplier</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Approved By</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $po)
          <tr>
            <td>{{ $po->po_number }}</td>
             <td>{{ $po->supplier->company_name ?? 'N/A' }}</td>
            <td>{{ $po->order_date ? \Carbon\Carbon::parse($po->order_date)->format('Y-m-d') : 'N/A' }}</td>
             <td>{{ $po->warehouse->warehouse_name ?? 'N/A' }}</td>
            <td>${{ number_format($po->total_amount, 2) }}</td>
            <td>
              @if ($po->status == 'Approved')
                <span class="badge-status badge-info">Approved</span>
              @elseif ($po->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @elseif ($po->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @else
                <span class="badge-status badge-inactive">{{ $po->status }}</span>
              @endif
            </td>
            <td>—</td>
            <td><div class="d-flex gap-1">
               <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                 data-id="{{ $po->id }}"
                 data-mode="edit"
                 data-bs-toggle="modal" data-bs-target="#modalPO"
                 title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-delete-id="{{ $po->id }}"
                data-delete-label="{{ $po->po_number }}"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No purchase orders found.</td>
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

<div class="modal fade" id="modalPO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Create Purchase Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-po">
        <div class="modal-body">
          <input type="hidden" name="id" id="po-id" value="" />
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="erp-form-label">Supplier</label>
              <select class="erp-form-control" name="supplier_id" id="supplier-id" required>
                <option value="">Select Supplier</option>
              </select>
              <div class="invalid-feedback" id="error-supplier_id"></div>
            </div>
             <div class="col-md-3">
               <label class="erp-form-label">Order Date</label>
               <input class="erp-form-control" type="date" name="order_date" id="order-date" required />
               <div class="invalid-feedback" id="error-order_date"></div>
             </div>
             <div class="col-md-3">
               <label class="erp-form-label">Expected Delivery</label>
               <input class="erp-form-control" type="date" name="expected_delivery_date" id="expected-delivery" />
               <div class="invalid-feedback" id="error-expected_delivery_date"></div>
             </div>
            <div class="col-md-6">
              <label class="erp-form-label">Warehouse</label>
              <select class="erp-form-control" name="warehouse_id" id="warehouse-id" required>
                <option value="">Select Warehouse</option>
              </select>
              <div class="invalid-feedback" id="error-warehouse_id"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Prepaid">Prepaid</option>
              </select>
              <div class="invalid-feedback" id="error-payment_terms"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Status</label>
               <select class="erp-form-control" name="status" id="status">
                 <option value="Draft">Draft</option>
                 <option value="Pending">Pending</option>
                 <option value="Approved">Approved</option>
                 <option value="Received">Received</option>
               </select>
               <div class="invalid-feedback" id="error-status"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">PO Number</label>
               <input class="erp-form-control" type="text" name="po_number" id="po-number" placeholder="PO-XXX" required />
               <div class="invalid-feedback" id="error-po_number"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">Total Amount ($)</label>
               <input class="erp-form-control" type="number" name="total_amount" id="total-amount" step="0.01" required />
               <div class="invalid-feedback" id="error-total_amount"></div>
             </div>
          </div>
          <label class="erp-form-label">Order Items</label>
          <div class="erp-table-wrap"><table class="erp-table"><thead><tr><th>Product</th><th>Qty</th><th>Unit Cost</th><th>Total</th></tr></thead>
          <tbody><tr>
            <td><input class="erp-form-control" placeholder="Product name" style="min-width:160px"/></td>
            <td><input class="erp-form-control" type="number" style="width:80px" placeholder="1"/></td>
            <td><input class="erp-form-control" type="number" style="width:100px" placeholder="0.00"/></td>
            <td style="color:var(--accent);font-family:'IBM Plex Mono',monospace">$0.00</td>
          </tr></tbody></table></div>
          <button class="btn-erp btn-outline btn-sm mt-2"><i class="bi bi-plus"></i> Add Line</button>
          <div class="d-flex justify-content-end mt-3"><div class="text-end">
            <div class="stat-row-label">Subtotal: <span class="stat-row-val">$0.00</span></div>
            <div class="stat-row-label">Tax (10%): <span class="stat-row-val">$0.00</span></div>
            <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-top:6px">Total: $0.00</div>
          </div></div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Submit PO
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
  const modalPO = document.getElementById('modalPO');
  const formPO = document.getElementById('form-po');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  function loadSuppliers() {
    fetch('{{ route("suppliers.all") }}')
      .then(res => res.json())
      .then(res => {
        if (res.success && res.data) {
          const select = document.getElementById('supplier-id');
          select.innerHTML = '<option value="">Select Supplier</option>';
          res.data.forEach(s => {
            select.innerHTML += `<option value="${s.id}">${s.company_name}</option>`;
          });
        }
      })
      .catch(e => console.warn('Failed to load suppliers'));
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

  loadSuppliers();
  loadWarehouses();

  modalPO.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formPO);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Purchase Order';

      apiClient.show(API_ENDPOINTS.PURCHASE.PURCHASE_ORDERS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('po-id').value = item.id;
          formPO.querySelector('[name="po_number"]').value = item.po_number || '';
          formPO.querySelector('[name="supplier_id"]').value = item.supplier_id || '';
          formPO.querySelector('[name="order_date"]').value = item.order_date ? item.order_date.split('T')[0] : '';
          formPO.querySelector('[name="expected_delivery_date"]').value = item.expected_delivery_date ? item.expected_delivery_date.split('T')[0] : '';
          formPO.querySelector('[name="warehouse_id"]').value = item.warehouse_id || '';
          formPO.querySelector('[name="payment_terms"]').value = item.payment_terms || 'Net 30';
          formPO.querySelector('[name="total_amount"]').value = item.total_amount || '';
          formPO.querySelector('[name="status"]').value = item.status || 'Draft';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Create Purchase Order';
      formPO.reset();
      document.getElementById('po-id').value = '';
    }
  });

  formPO.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('po-id').value;

    const formData = new FormData(formPO);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PURCHASE.PURCHASE_ORDERS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PURCHASE.PURCHASE_ORDERS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalPO).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formPO, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'this PO';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.PURCHASE.PURCHASE_ORDERS.DESTROY, deleteId)
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