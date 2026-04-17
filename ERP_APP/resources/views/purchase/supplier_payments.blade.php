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
    <button class="btn-erp btn-primary" id="btn-add-payment"><i class="bi bi-plus-lg"></i> New Payment</button>
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
                data-payment_number="{{ $payment->payment_number }}"
                data-supplier_id="{{ $payment->supplier_id }}"
                data-invoice_reference="{{ $payment->invoice_reference }}"
                data-amount="{{ $payment->amount }}"
                data-payment_date="{{ $payment->payment_date }}"
                data-payment_method="{{ $payment->payment_method }}"
                data-status="{{ $payment->status }}"
                title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-id="{{ $payment->id }}"
                data-payment_number="{{ $payment->payment_number }}"
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
$(function() {
  var routes = {
    store: '{{ route("supplier_payments.store") }}',
    update: '{{ route("supplier_payments.update", ":id") }}',
    destroy: '{{ route("supplier_payments.destroy", ":id") }}',
    suppliersAll: '{{ route("suppliers.all") }}'
  };

  var $modal = $('#modalSupplierPay');
  var $form = $('#form-payment');
  var $btnSave = $('#btn-save');
  var paymentId = null;
  var isEdit = false;

  // Load suppliers dropdown via AJAX
  function loadSuppliers(selectedId = null) {
    $.ajax({
      url: routes.suppliersAll,
      method: 'GET',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        var $supplierSelect = $('#supplier-id');
        $supplierSelect.find('option:not(:first)').remove();
        if (res.success && res.data) {
          $.each(res.data, function(index, supplier) {
            var option = $('<option>').val(supplier.id).text(supplier.company_name);
            $supplierSelect.append(option);
          });
          if (selectedId) {
            $supplierSelect.val(selectedId);
          }
        }
      },
      error: function() {
        showToast('Failed to load suppliers', 'error');
      }
    });
  }

  // Load suppliers when modal opens
  $modal.on('show.bs.modal', function() {
    loadSuppliers();
  });

  $('#btn-add-payment').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Supplier Payment');
    loadSuppliers();
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    paymentId = $(this).data('id');
    $('#modal-title').text('Edit Supplier Payment');

    $('#payment-id').val(paymentId);
    $('#payment-number').val($(this).data('payment_number'));
    loadSuppliers($(this).data('supplier_id'));
    $('#invoice-reference').val($(this).data('invoice_reference'));
    $('#amount').val($(this).data('amount'));
    $('#payment-date').val($(this).data('payment_date'));
    $('#payment-method').val($(this).data('payment_method') || '');
    $('#status').val($(this).data('status') || '');

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    paymentId = $(this).data('id');
    var payment_number = $(this).data('payment_number');
    $('#delete-target').text(payment_number || 'this payment');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', paymentId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Payment deleted', 'success');
          $('#modalDelete').modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
      }
    });
  });

  $form.on('submit', function(e) {
    e.preventDefault();
    $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

    // Clear previous inline errors
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').text('');

    var url = isEdit ? routes.update.replace(':id', paymentId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Payment updated' : 'Payment created'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function(xhr) {
        var res = xhr.responseJSON;
        if (res && res.errors) {
          // Show inline errors for each field
          $.each(res.errors, function(field, messages) {
            var $input = $form.find('[name="' + field + '"]');
            $input.addClass('is-invalid');
            var $feedback = $('#error-' + field);
            if ($feedback.length) {
              $feedback.text(messages[0]);
            }
          });
          // Show first error in toast
          var firstField = Object.keys(res.errors)[0];
          showToast(res.errors[firstField][0], 'error');
        } else if (res && res.message) {
          showToast(res.message, 'error');
        } else {
          showToast('An error occurred', 'error');
        }
      },
      complete: function() {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Record Payment');
      }
    });
  });

  function resetForm() {
    paymentId = null;
    isEdit = false;
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').text('');
  }

  function showToast(msg, type) {
    type = type || 'info';
    var icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
    var color = type === 'success' ? 'var(--accent-2)' : type === 'error' ? 'var(--accent-3)' : 'var(--accent)';
    var $t = $('<div class="erp-toast ' + type + '"></div>')
      .html('<span style="font-weight:700;color:' + color + '">' + icon + '</span> ' + msg);
    $('#toast-container').append($t);
    setTimeout(function() { $t.css('opacity', 0); }, 2500);
    setTimeout(function() { $t.remove(); }, 2800);
  }
});
</script>
@endpush
@endsection