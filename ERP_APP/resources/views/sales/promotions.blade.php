@extends('layouts.erp')

@section('title', 'Discounts & Promotions')
@section('breadcrumb', 'Discounts & Promotions')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Discounts & Promotions</div>
    <div class="page-subtitle">Create and manage discount rules and promotional campaigns</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-promotion"><i class="bi bi-plus-lg"></i> New Promotion</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search discounts & promotions…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Scheduled</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Promo Code</th><th>Description</th><th>Discount</th><th>Type</th><th>Valid From</th><th>Valid To</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $promo)
          <tr>
            <td>{{ $promo->promo_code }}</td>
            <td>{{ $promo->description }}</td>
            <td>
              @if ($promo->discount_type == 'Percentage')
                {{ $promo->discount_value }}%
              @else
                ${{ number_format($promo->discount_value, 2) }}
              @endif
            </td>
            <td>{{ $promo->discount_type }}</td>
            <td>{{ $promo->valid_from ? \Carbon\Carbon::parse($promo->valid_from)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $promo->valid_to ? \Carbon\Carbon::parse($promo->valid_to)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              @if ($promo->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @elseif ($promo->status == 'Scheduled')
                <span class="badge-status badge-pending">Scheduled</span>
              @else
                <span class="badge-status badge-inactive">Expired</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $promo->id }}" data-promo_code="{{ $promo->promo_code }}" data-description="{{ $promo->description }}" data-discount_value="{{ $promo->discount_value }}" data-discount_type="{{ $promo->discount_type }}" data-min_order="{{ $promo->min_order }}" data-valid_from="{{ $promo->valid_from }}" data-valid_to="{{ $promo->valid_to }}" data-applicable_products="{{ $promo->applicable_products }}" data-status="{{ $promo->status }}" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $promo->id }}" data-promo_code="{{ $promo->promo_code }}" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalPromo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Promotion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-promotion">
        <div class="modal-body">
          <input type="hidden" name="id" id="promotion-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Promo Code</label>
              <input class="erp-form-control" type="text" name="promo_code" id="promo-code" placeholder="PROMO2025" />
              <div class="invalid-feedback" id="error-promo_code"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Description</label>
              <input class="erp-form-control" type="text" name="description" id="description" placeholder="" />
              <div class="invalid-feedback" id="error-description"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Discount Value</label>
              <input class="erp-form-control" type="number" name="discount_value" id="discount-value" placeholder="" />
              <div class="invalid-feedback" id="error-discount_value"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Type</label>
              <select class="erp-form-control" name="discount_type" id="discount-type">
                <option value="Percentage">Percentage</option>
                <option value="Fixed Amount">Fixed Amount</option>
                <option value="Free Shipping">Free Shipping</option>
              </select>
              <div class="invalid-feedback" id="error-discount_type"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Min. Order ($)</label>
              <input class="erp-form-control" type="number" name="min_order" id="min-order" placeholder="" />
              <div class="invalid-feedback" id="error-min_order"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Valid From</label>
              <input class="erp-form-control" type="date" name="valid_from" id="valid-from" />
              <div class="invalid-feedback" id="error-valid_from"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Valid To</label>
              <input class="erp-form-control" type="date" name="valid_to" id="valid-to" />
              <div class="invalid-feedback" id="error-valid_to"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Applicable Products/Categories</label>
              <input class="erp-form-control" type="text" name="applicable_products" id="applicable-products" placeholder="All or specify…" />
              <div class="invalid-feedback" id="error-applicable_products"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Promotion
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
    store: '{{ route("promotion.store") }}',
    update: '{{ route("promotion.update", ":id") }}',
    destroy: '{{ route("promotion.destroy", ":id") }}'
  };

  var $modal = $('#modalPromo');
  var $form = $('#form-promotion');
  var $btnSave = $('#btn-save');
  var promotionId = null;
  var isEdit = false;

  $('#btn-add-promotion').on('click', function () {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Promotion');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    promotionId = $(this).data('id');
    $('#modal-title').text('Edit Promotion');

    $('#promotion-id').val(promotionId);
    $('#promo-code').val($(this).data('promo_code'));
    $('#description').val($(this).data('description'));
    $('#discount-value').val($(this).data('discount_value'));
    $('#discount-type').val($(this).data('discount_type'));
    $('#min-order').val($(this).data('min_order'));
    $('#valid-from').val($(this).data('valid_from'));
    $('#valid-to').val($(this).data('valid_to'));
    $('#applicable-products').val($(this).data('applicable_products'));

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    promotionId = $(this).data('id');
    var promo_code = $(this).data('promo_code');
    $('#delete-target').text(promo_code || 'this promotion');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', promotionId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Promotion deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', promotionId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Promotion updated' : 'Promotion created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Promotion');
      }
    });
  });

  function resetForm() {
    promotionId = null;
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