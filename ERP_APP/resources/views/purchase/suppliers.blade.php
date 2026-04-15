@extends('layouts.erp')

@section('title', 'Supplier Management')
@section('breadcrumb', 'Supplier Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Management</div>
    <div class="page-subtitle">Manage supplier info, contacts and ratings</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-supplier"><i class="bi bi-plus-lg"></i> Add Supplier</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Supplier</th><th>Contact</th><th>Email</th><th>Country</th><th>Payment Terms</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $supplier)
          <tr>
            <td>{{ $supplier->company_name }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->country }}</td>
            <td>{{ $supplier->payment_terms }}</td>
            <td>⭐⭐⭐⭐</td>
            <td>
              @if ($supplier->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Inactive</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $supplier->id }}" data-company_name="{{ $supplier->company_name }}" data-contact_person="{{ $supplier->contact_person }}" data-email="{{ $supplier->email }}" data-phone="{{ $supplier->phone }}" data-country="{{ $supplier->country }}" data-payment_terms="{{ $supplier->payment_terms }}" data-currency="{{ $supplier->currency }}" data-address="{{ $supplier->address }}" data-status="{{ $supplier->status }}" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $supplier->id }}" data-company_name="{{ $supplier->company_name }}" title="Delete"><i class="bi bi-trash"></i></button></div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No suppliers found.</td>
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

<div class="modal fade" id="modalSupplier" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Supplier</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-supplier">
        <div class="modal-body">
          <input type="hidden" name="id" id="supplier-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Company Name</label>
              <input class="erp-form-control" type="text" name="company_name" id="company-name" placeholder="Supplier Ltd." required />
              <div class="invalid-feedback" id="error-company_name"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Contact Person</label>
              <input class="erp-form-control" type="text" name="contact_person" id="contact-person" placeholder="Contact name" />
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Email</label>
              <input class="erp-form-control" type="email" name="email" id="email" placeholder="contact@supplier.com" required />
              <div class="invalid-feedback" id="error-email"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Phone</label>
              <input class="erp-form-control" type="text" name="phone" id="phone" placeholder="+1-555-0000" />
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Country</label>
              <input class="erp-form-control" type="text" name="country" id="country" placeholder="USA" />
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Net 90">Net 90</option>
                <option value="Prepaid">Prepaid</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Currency</label>
              <select class="erp-form-control" name="currency" id="currency">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="BDT">BDT</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Address</label>
              <textarea class="erp-form-control" name="address" id="address" rows="2" placeholder=""></textarea>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Status</label>
              <select class="erp-form-control" name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Supplier
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
    store: '{{ route("supplier.store") }}',
    update: '{{ route("supplier.update", ":id") }}',
    destroy: '{{ route("supplier.destroy", ":id") }}'
  };

  var $modal = $('#modalSupplier');
  var $form = $('#form-supplier');
  var $btnSave = $('#btn-save');
  var supplierId = null;
  var isEdit = false;

  $('#btn-add-supplier').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('Add Supplier');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    supplierId = $(this).data('id');
    $('#modal-title').text('Edit Supplier');

    $('#supplier-id').val(supplierId);
    $('#company-name').val($(this).data('company_name'));
    $('#contact-person').val($(this).data('contact_person'));
    $('#email').val($(this).data('email'));
    $('#phone').val($(this).data('phone'));
    $('#country').val($(this).data('country'));
    $('#payment-terms').val($(this).data('payment_terms') || 'Net 30');
    $('#currency').val($(this).data('currency') || 'USD');
    $('#address').val($(this).data('address'));
    $('#status').val($(this).data('status') || 'Active');

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    supplierId = $(this).data('id');
    var company_name = $(this).data('company_name');
    $('#delete-target').text(company_name || 'this supplier');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', supplierId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Supplier deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', supplierId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Supplier updated' : 'Supplier created'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function(xhr) {
        var res = xhr.responseJSON;
        if (res && res.errors) {
          $.each(res.errors, function(field, messages) {
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
      complete: function() {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Supplier');
      }
    });
  });

  function resetForm() {
    supplierId = null;
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
    setTimeout(function() { $t.css('opacity', 0); }, 2500);
    setTimeout(function() { $t.remove(); }, 2800);
  }
});
</script>
@endpush
@endsection