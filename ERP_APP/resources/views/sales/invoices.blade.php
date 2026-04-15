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
    <button class="btn-erp btn-primary" id="btn-add-invoice"><i class="bi bi-plus-lg"></i> New Invoice</button>
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
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" title="Print"><i class="bi bi-printer"></i></button><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $invoice->id }}" data-invoice_number="{{ $invoice->invoice_number }}" data-customer_id="{{ $invoice->customer_id }}" data-sales_order_ref="{{ $invoice->sales_order_ref }}" data-invoice_date="{{ $invoice->invoice_date }}" data-due_date="{{ $invoice->due_date }}" data-amount="{{ $invoice->amount }}" data-tax_percent="{{ $invoice->tax_percent }}" data-notes="{{ $invoice->notes }}" data-status="{{ $invoice->status }}" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $invoice->id }}" data-invoice_number="{{ $invoice->invoice_number }}" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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
$(function () {
  var routes = {
    store: '{{ route("invoice.store") }}',
    update: '{{ route("invoice.update", ":id") }}',
    destroy: '{{ route("invoice.destroy", ":id") }}'
  };

  var $modal = $('#modalInvoice');
  var $form = $('#form-invoice');
  var $btnSave = $('#btn-save');
  var invoiceId = null;
  var isEdit = false;

  $('#btn-add-invoice').on('click', function () {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Invoice');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    invoiceId = $(this).data('id');
    $('#modal-title').text('Edit Invoice');

    $('#invoice-id').val(invoiceId);
    $('#customer-id').val($(this).data('customer_id'));
    $('#sales-order-ref').val($(this).data('sales_order_ref'));
    $('#invoice-date').val($(this).data('invoice_date'));
    $('#due-date').val($(this).data('due_date'));
    $('#amount').val($(this).data('amount'));
    $('#tax-percent').val($(this).data('tax_percent'));
    $('#notes').val($(this).data('notes'));

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    invoiceId = $(this).data('id');
    var invoice_number = $(this).data('invoice_number');
    $('#delete-target').text(invoice_number || 'this invoice');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', invoiceId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Invoice deleted', 'success');
          $('#modalDelete').modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function (xhr) {
        showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
      }
    });
  });

  $form.on('submit', function (e) {
    e.preventDefault();
    $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    var url = isEdit ? routes.update.replace(':id', invoiceId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Invoice updated' : 'Invoice created'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function (xhr) {
        var res = xhr.responseJSON;
        if (res && res.errors) {
          $.each(res.errors, function (field, messages) {
            var $input = $form.find('[name="' + field + '"]');
            $input.addClass('is-invalid');
            $('#error-' + field).text(messages[0]).show();
          });
        } else if (res && res.message) {
          showToast(res.message, 'error');
        } else {
          showToast('An error occurred', 'error');
        }
      },
      complete: function () {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Generate Invoice');
      }
    });
  });

  function resetForm() {
    invoiceId = null;
    isEdit = false;
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').hide().text('');
  }

  function showToast(msg, type) {
    type = type || 'info';
    var icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
    var color = type === 'success' ? 'var(--accent-2)' : type === 'error' ? 'var(--accent-3)' : 'var(--accent)';
    var $t = $('<div class="erp-toast ' + type + '"></div>')
      .html('<span style="font-weight:700;color:' + color + '">' + icon + '</span> ' + msg);
    $('#toast-container').append($t);
    setTimeout(function () { $t.css('opacity', 0); }, 2500);
    setTimeout(function () { $t.remove(); }, 2800);
  }
});
</script>
@endpush
@endsection