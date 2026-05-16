@extends('layouts.erp')

@section('title', 'Customer Management')
@section('breadcrumb', 'Customer Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Customer Management</div>
    <div class="page-subtitle">Customer info, credit limits and receivables</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-customer"><i class="bi bi-plus-lg"></i> Add Customer</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Blocked</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Customer</th><th>Contact</th><th>Email</th><th>Credit Limit</th><th>Outstanding</th><th>Sales Rep</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $customer)
          <tr>
            <td>{{ $customer->company_name }}</td>
            <td>{{ $customer->contact_person }}</td>
            <td>{{ $customer->email }}</td>
            <td>${{ number_format($customer->credit_limit, 2) }}</td>
            <td>$0</td>
            <td>{{ $customer->sales_rep_id ?? 'N/A' }}</td>
            <td><span class="badge-status badge-active">Active</span></td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $customer->id }}" data-company_name="{{ $customer->company_name }}" data-contact_person="{{ $customer->contact_person }}" data-email="{{ $customer->email }}" data-phone="{{ $customer->phone }}" data-credit_limit="{{ $customer->credit_limit }}" data-sales_rep_id="{{ $customer->sales_rep_id }}" data-billing_address="{{ $customer->billing_address }}" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $customer->id }}" data-company_name="{{ $customer->company_name }}" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Customer</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-customer">
        <div class="modal-body">
          <input type="hidden" name="id" id="customer-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Company Name</label>
              <input class="erp-form-control" type="text" name="company_name" id="company-name" placeholder="Company name" required />
              <div class="invalid-feedback" id="error-company_name"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Contact Person</label>
              <input class="erp-form-control" type="text" name="contact_person" id="contact-person" placeholder="Contact name" />
              <div class="invalid-feedback" id="error-contact_person"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Email</label>
              <input class="erp-form-control" type="email" name="email" id="email" placeholder="" />
              <div class="invalid-feedback" id="error-email"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Phone</label>
              <input class="erp-form-control" type="text" name="phone" id="phone" placeholder="" />
              <div class="invalid-feedback" id="error-phone"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Credit Limit ($)</label>
              <input class="erp-form-control" type="number" name="credit_limit" id="credit-limit" placeholder="" />
              <div class="invalid-feedback" id="error-credit_limit"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Sales Rep</label>
              <select class="erp-form-control" name="sales_rep_id" id="sales-rep">
                <option value="">Select Sales Rep</option>
                <option value="Sara L.">Sara L.</option>
                <option value="James R.">James R.</option>
              </select>
              <div class="invalid-feedback" id="error-sales_rep_id"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Billing Address</label>
              <textarea class="erp-form-control" name="billing_address" id="billing-address" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-billing_address"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Customer
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
    store: '{{ route("customers.store") }}',
    update: '{{ route("customers.update", ":id") }}',
    destroy: '{{ route("customers.destroy", ":id") }}'
  };

  var $modal = $('#modalCustomer');
  var $form = $('#form-customer');
  var $btnSave = $('#btn-save');
  var customerId = null;
  var isEdit = false;

  $('#btn-add-customer').on('click', function () {
    resetForm();
    isEdit = false;
    $('#modal-title').text('Add Customer');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    customerId = $(this).data('id');
    $('#modal-title').text('Edit Customer');

    $('#customer-id').val(customerId);
    $('#company-name').val($(this).data('company_name'));
    $('#contact-person').val($(this).data('contact_person'));
    $('#email').val($(this).data('email'));
    $('#phone').val($(this).data('phone'));
    $('#credit-limit').val($(this).data('credit_limit'));
    $('#sales-rep').val($(this).data('sales_rep_id'));
    $('#billing-address').val($(this).data('billing_address'));

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    customerId = $(this).data('id');
    var company_name = $(this).data('company_name');
    $('#delete-target').text(company_name || 'this customer');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', customerId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Customer deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', customerId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Customer updated' : 'Customer created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Customer');
      }
    });
  });

  function resetForm() {
    customerId = null;
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