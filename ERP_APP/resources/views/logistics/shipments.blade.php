@extends('layouts.erp')

@section('title', 'Shipments')
@section('breadcrumb', 'Shipments')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Shipments</div>
      <div class="page-subtitle">Track outbound shipments and delivery status</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-shipment"><i class="bi bi-plus-lg"></i> New Shipment</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search shipments…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Preparing</option>
        <option>Dispatched</option>
        <option>In Transit</option>
        <option>Delivered</option>
        <option>Failed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Shipment #</th>
            <th>Sales Order</th>
            <th>Customer</th>
            <th>Carrier</th>
            <th>Tracking #</th>
            <th>Est. Delivery</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $shipment)
            <tr>
              <td>SHP-{{ $shipment->id }}</td>
              <td>{{ $shipment->sales_order_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $shipment->carrier ?? 'N/A' }}</td>
              <td>{{ $shipment->tracking_number ?? 'N/A' }}</td>
              <td>{{ $shipment->estimated_delivery_date ? \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if ($shipment->status == 'Delivered')
                  <span class="badge-status badge-active">Delivered</span>
                @elseif ($shipment->status == 'In Transit')
                  <span class="badge-status badge-info">In Transit</span>
                @elseif ($shipment->status == 'Dispatched')
                  <span class="badge-status badge-info">Dispatched</span>
                @else
                  <span class="badge-status badge-pending">{{ $shipment->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $shipment->id }}"
                    data-sales_order_id="{{ $shipment->sales_order_id }}"
                    data-carrier="{{ $shipment->carrier }}"
                    data-tracking_number="{{ $shipment->tracking_number }}"
                    data-estimated_delivery_date="{{ $shipment->estimated_delivery_date }}"
                    data-shipping_address="{{ $shipment->shipping_address }}"
                    data-status="{{ $shipment->status }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-id="{{ $shipment->id }}"
                    data-id_display="SHP-{{ $shipment->id }}"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No shipments found.</td>
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

  <div class="modal fade" id="modalShipment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Shipment</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-shipment">
          <div class="modal-body">
            <input type="hidden" name="id" id="shipment-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Sales Order</label>
                <input class="erp-form-control" type="text" name="sales_order_id" id="sales-order-id" placeholder="SO-XXXX-XXXX" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Carrier</label>
                <select class="erp-form-control" name="carrier" id="carrier">
                  <option value="DHL">DHL</option>
                  <option value="FedEx">FedEx</option>
                  <option value="UPS">UPS</option>
                  <option value="Local Courier">Local Courier</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Tracking Number</label>
                <input class="erp-form-control" type="text" name="tracking_number" id="tracking-number" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Est. Delivery Date</label>
                <input class="erp-form-control" type="date" name="estimated_delivery_date" id="estimated-delivery-date" placeholder="" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Shipping Address</label>
                <textarea class="erp-form-control" name="shipping_address" id="shipping-address" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-shipping_address"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="status">
                  <option value="Preparing">Preparing</option>
                  <option value="Dispatched">Dispatched</option>
                  <option value="In Transit">In Transit</option>
                  <option value="Delivered">Delivered</option>
                  <option value="Failed">Failed</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Create Shipment
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
@endsection

@push('scripts')
<script>
$(function() {
  var routes = {
    store: '{{ route("shipment.store") }}',
    update: '{{ route("shipment.update", ":id") }}',
    destroy: '{{ route("shipment.destroy", ":id") }}'
  };

  var $modal = $('#modalShipment');
  var $form = $('#form-shipment');
  var $btnSave = $('#btn-save');
  var shipmentId = null;
  var isEdit = false;

  $('#btn-add-shipment').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Shipment');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    shipmentId = $(this).data('id');
    $('#modal-title').text('Edit Shipment');

    $('#shipment-id').val(shipmentId);
    $('#sales-order-id').val($(this).data('sales_order_id'));
    $('#carrier').val($(this).data('carrier') || 'DHL');
    $('#tracking-number').val($(this).data('tracking_number'));
    $('#estimated-delivery-date').val($(this).data('estimated_delivery_date'));
    $('#shipping-address').val($(this).data('shipping_address'));
    $('#status').val($(this).data('status') || 'Preparing');

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    shipmentId = $(this).data('id');
    var id_display = $(this).data('id_display') || 'this shipment';
    $('#delete-target').text(id_display);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', shipmentId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Shipment deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', shipmentId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Shipment updated' : 'Shipment created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Create Shipment');
      }
    });
  });

  function resetForm() {
    shipmentId = null;
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