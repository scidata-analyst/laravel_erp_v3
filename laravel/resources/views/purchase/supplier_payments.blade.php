@extends('layouts.erp')

@section('title', 'Supplier Payments')
@section('breadcrumb', 'Supplier Payments')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Payments</div>
    <div class="page-subtitle">Track all outgoing payments to suppliers</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplierPay" data-mode="create"><i class="bi bi-plus-lg"></i> New Payment</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier payments…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Paid</option><option>Pending</option><option>Overdue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Payment #</th><th>Supplier</th><th>Invoice Ref</th><th>Amount</th><th>Payment Date</th><th>Method</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $payment)
          <tr>
            <td>{{ $payment->payment_number }}</td>
            <td>{{ $payment->supplier->company_name ?? 'N/A' }}</td>
            <td>{{ $payment->invoice_reference ?? 'N/A' }}</td>
            <td>${{ number_format($payment->amount, 2) }}</td>
            <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $payment->payment_method ?? 'N/A' }}</td>
            <td>
              @if ($payment->status == 'Paid')
                <span class="badge-status badge-active">Paid</span>
              @elseif ($payment->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @else
                <span class="badge-status badge-inactive">Overdue</span>
              @endif
            </td>
            <td><div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                data-id="{{ $payment->id }}"
                data-mode="edit"
                data-bs-toggle="modal" data-bs-target="#modalSupplierPay"
                title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-delete-id="{{ $payment->id }}"
                data-delete-label="{{ $payment->payment_number }}"
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No payments found.</td>
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

<div class="modal fade" id="modalSupplierPay" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Supplier Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-payment">
        <div class="modal-body">
          <input type="hidden" name="id" id="payment-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Payment Number</label>
              <input class="erp-form-control" type="text" name="payment_number" id="payment-number" placeholder="PAY-XXX" required />
              <div class="invalid-feedback" id="error-payment_number"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Supplier</label>
              <select class="erp-form-control" name="supplier_id" id="supplier-id" required>
                <option value="">Select Supplier</option>
              </select>
              <div class="invalid-feedback" id="error-supplier_id"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Invoice Reference</label>
              <input class="erp-form-control" type="text" name="invoice_reference" id="invoice-reference" placeholder="INV-SUP-XXX" />
              <div class="invalid-feedback" id="error-invoice_reference"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Amount ($)</label>
              <input class="erp-form-control" type="number" name="amount" id="amount" step="0.01" placeholder="" required />
              <div class="invalid-feedback" id="error-amount"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Payment Date</label>
              <input class="erp-form-control" type="date" name="payment_date" id="payment-date" required />
              <div class="invalid-feedback" id="error-payment_date"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Method</label>
              <select class="erp-form-control" name="payment_method" id="payment-method" required>
                <option value="">Select Method</option>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="Cheque">Cheque</option>
                <option value="Cash">Cash</option>
              </select>
              <div class="invalid-feedback" id="error-payment_method"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Status</label>
              <select class="erp-form-control" name="status" id="status">
                <option value="">Select Status</option>
                <option value="Pending">Pending</option>
                <option value="Paid">Paid</option>
                <option value="Overdue">Overdue</option>
              </select>
              <div class="invalid-feedback" id="error-status"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Record Payment
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
  const modalSupplierPay = document.getElementById('modalSupplierPay');
  const formPayment = document.getElementById('form-payment');
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

  loadSuppliers();

  modalSupplierPay.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formPayment);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Supplier Payment';

      apiClient.show(API_ENDPOINTS.PURCHASE.SUPPLIER_PAYMENTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('payment-id').value = item.id;
          formPayment.querySelector('[name="payment_number"]').value = item.payment_number || '';
          formPayment.querySelector('[name="supplier_id"]').value = item.supplier_id || '';
          formPayment.querySelector('[name="invoice_reference"]').value = item.invoice_reference || '';
          formPayment.querySelector('[name="amount"]').value = item.amount || '';
          formPayment.querySelector('[name="payment_date"]').value = item.payment_date ? item.payment_date.split('T')[0] : '';
          formPayment.querySelector('[name="payment_method"]').value = item.payment_method || '';
          formPayment.querySelector('[name="status"]').value = item.status || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Supplier Payment';
      formPayment.reset();
      document.getElementById('payment-id').value = '';
    }
  });

  formPayment.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('payment-id').value;

    const formData = new FormData(formPayment);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PURCHASE.SUPPLIER_PAYMENTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PURCHASE.SUPPLIER_PAYMENTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalSupplierPay).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formPayment, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'this payment';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.PURCHASE.SUPPLIER_PAYMENTS.DESTROY, deleteId)
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