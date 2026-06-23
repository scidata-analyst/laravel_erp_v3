@extends('layouts.erp')

@section('title', 'Invoices')
@section('breadcrumb', 'Invoices')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Invoices</div>
    <div class="page-subtitle">Sales invoices and receivable tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalInvoice" data-mode="create"><i class="bi bi-plus-lg"></i> New Invoice</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search invoices…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Paid</option><option>Pending</option><option>Overdue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Invoice #</th><th>Customer</th><th>Date</th><th>Due Date</th><th>Amount</th><th>Paid</th><th>Balance</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $invoice)
          <tr>
            <td>{{ $invoice->invoice_number }}</td>
            <td>{{ $invoice->customer_id ?? 'N/A' }}</td>
            <td>{{ $invoice->invoice_date ? \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>${{ number_format($invoice->amount, 2) }}</td>
            <td>$0</td>
            <td>${{ number_format($invoice->amount, 2) }}</td>
            <td>
              @if ($invoice->status == 'Paid')
                <span class="badge-status badge-active">Paid</span>
              @elseif ($invoice->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @else
                <span class="badge-status badge-inactive">Overdue</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" title="Print"><i class="bi bi-printer"></i></button><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $invoice->id }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalInvoice" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $invoice->id }}" data-delete-label="{{ $invoice->invoice_number }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalInvoice" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Invoice</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-invoice">
        <div class="modal-body">
          <input type="hidden" name="id" id="invoice-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Customer</label>
              <select class="erp-form-control" name="customer_id" id="customer-id">
                <option value="">Select Customer</option>
                <option value="Acme Corporation">Acme Corporation</option>
                <option value="Delta Retailers">Delta Retailers</option>
              </select>
              <div class="invalid-feedback" id="error-customer_id"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Sales Order Ref</label>
              <input class="erp-form-control" type="text" name="sales_order_ref" id="sales-order-ref" placeholder="SO-2025-XXXX" />
              <div class="invalid-feedback" id="error-sales_order_ref"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Invoice Date</label>
              <input class="erp-form-control" type="date" name="invoice_date" id="invoice-date" />
              <div class="invalid-feedback" id="error-invoice_date"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Due Date</label>
              <input class="erp-form-control" type="date" name="due_date" id="due-date" />
              <div class="invalid-feedback" id="error-due_date"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Amount ($)</label>
              <input class="erp-form-control" type="number" name="amount" id="amount" placeholder="" />
              <div class="invalid-feedback" id="error-amount"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Tax (%)</label>
              <input class="erp-form-control" type="number" name="tax_percent" id="tax-percent" value="10" />
              <div class="invalid-feedback" id="error-tax_percent"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Notes</label>
              <textarea class="erp-form-control" name="notes" id="notes" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-notes"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Generate Invoice
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
  const modalInvoice = document.getElementById('modalInvoice');
  const formInvoice = document.getElementById('form-invoice');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalInvoice.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formInvoice);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Invoice';

      apiClient.show(API_ENDPOINTS.SALES.INVOICES.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('invoice-id').value = item.id;
          formInvoice.querySelector('[name="customer_id"]').value = item.customer_id || '';
          formInvoice.querySelector('[name="sales_order_ref"]').value = item.sales_order_ref || '';
          formInvoice.querySelector('[name="invoice_date"]').value = item.invoice_date ? item.invoice_date.split('T')[0] : '';
          formInvoice.querySelector('[name="due_date"]').value = item.due_date ? item.due_date.split('T')[0] : '';
          formInvoice.querySelector('[name="amount"]').value = item.amount || '';
          formInvoice.querySelector('[name="tax_percent"]').value = item.tax_percent || '';
          formInvoice.querySelector('[name="notes"]').value = item.notes || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Invoice';
      formInvoice.reset();
      document.getElementById('invoice-id').value = '';
    }
  });

  formInvoice.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('invoice-id').value;

    const formData = new FormData(formInvoice);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.SALES.INVOICES.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.SALES.INVOICES.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalInvoice).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formInvoice, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.SALES.INVOICES.DESTROY, deleteId)
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