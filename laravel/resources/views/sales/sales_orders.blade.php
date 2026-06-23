@extends('layouts.erp')

@section('title', 'Sales Orders')
@section('breadcrumb', 'Sales Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Sales Orders</div>
    <div class="page-subtitle">Track and manage all sales orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSO" data-mode="create"><i class="bi bi-plus-lg"></i> New Order</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search sales orders…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Pending</option><option>Confirmed</option><option>Dispatched</option><option>Delivered</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>SO #</th><th>Customer</th><th>Date</th><th>Items</th><th>Total</th><th>Delivery</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $order)
          <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->customer_id ?? 'N/A' }}</td>
            <td>{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1</td>
            <td>${{ number_format($order->total_amount, 2) }}</td>
            <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              @if ($order->status == 'Delivered')
                <span class="badge-status badge-active">Delivered</span>
              @elseif ($order->status == 'Dispatched')
                <span class="badge-status badge-info">Dispatched</span>
              @elseif ($order->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @else
                <span class="badge-status badge-inactive">{{ $order->status }}</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $order->id }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalSO" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $order->id }}" data-delete-label="{{ $order->order_number }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalSO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Sales Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-salesorder">
        <div class="modal-body">
          <input type="hidden" name="id" id="salesorder-id" value="" />
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="erp-form-label">Customer</label>
              <select class="erp-form-control" name="customer_id" id="customer-id">
                <option value="">Select Customer</option>
                <option value="Acme Corporation">Acme Corporation</option>
                <option value="Delta Retailers">Delta Retailers</option>
              </select>
              <div class="invalid-feedback" id="error-customer_id"></div>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Order Date</label>
              <input class="erp-form-control" type="date" name="order_date" id="order-date" />
              <div class="invalid-feedback" id="error-order_date"></div>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Delivery Date</label>
              <input class="erp-form-control" type="date" name="delivery_date" id="delivery-date" />
              <div class="invalid-feedback" id="error-delivery_date"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Due on Receipt">Due on Receipt</option>
              </select>
              <div class="invalid-feedback" id="error-payment_terms"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Discount (%)</label>
              <input class="erp-form-control" type="number" name="discount_percent" id="discount-percent" value="0" />
              <div class="invalid-feedback" id="error-discount_percent"></div>
            </div>
          </div>
          <label class="erp-form-label">Order Items</label>
          <div class="erp-table-wrap"><table class="erp-table"><thead><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Discount</th><th>Total</th></tr></thead>
          <tbody><tr>
            <td><select class="erp-form-control" name="product_id" id="product-id"><option value="">Select Product</option><option value="HP ProBook 450">HP ProBook 450</option><option value="Logitech MX Master">Logitech MX Master</option></select></td>
            <td><input class="erp-form-control" type="number" name="quantity" id="quantity" style="width:70px" value="1"/></td>
            <td style="font-family:'IBM Plex Mono',monospace">$849.00</td>
            <td><input class="erp-form-control" type="number" name="item_discount" style="width:70px" placeholder="0%"/></td>
            <td style="color:var(--accent-2);font-family:'IBM Plex Mono',monospace">$849.00</td>
          </tr></tbody></table></div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Confirm Order
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
  const modalSO = document.getElementById('modalSO');
  const formSalesOrder = document.getElementById('form-salesorder');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalSO.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formSalesOrder);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Sales Order';

      apiClient.show(API_ENDPOINTS.SALES.SALES_ORDERS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('salesorder-id').value = item.id;
          formSalesOrder.querySelector('[name="customer_id"]').value = item.customer_id || '';
          formSalesOrder.querySelector('[name="order_date"]').value = item.order_date ? item.order_date.split('T')[0] : '';
          formSalesOrder.querySelector('[name="delivery_date"]').value = item.delivery_date ? item.delivery_date.split('T')[0] : '';
          formSalesOrder.querySelector('[name="payment_terms"]').value = item.payment_terms || '';
          formSalesOrder.querySelector('[name="discount_percent"]').value = item.discount_percent || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Sales Order';
      formSalesOrder.reset();
      document.getElementById('salesorder-id').value = '';
    }
  });

  formSalesOrder.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('salesorder-id').value;

    const formData = new FormData(formSalesOrder);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.SALES.SALES_ORDERS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.SALES.SALES_ORDERS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalSO).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formSalesOrder, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.SALES.SALES_ORDERS.DESTROY, deleteId)
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