@extends('layouts.erp')

@section('title', 'Routes & Delivery')
@section('breadcrumb', 'Routes & Delivery')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Routes & Delivery</div>
      <div class="page-subtitle">Define delivery routes and optimize last-mile logistics</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-route"><i class="bi bi-plus-lg"></i> New Route</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search routes & delivery…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Inactive</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Route Name</th>
            <th>Zone</th>
            <th>Driver</th>
            <th>Vehicle</th>
            <th>Stops</th>
            <th>Avg. Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $route)
            <tr>
              <td>{{ $route->route_name }}</td>
              <td>{{ $route->zone_area ?? 'N/A' }}</td>
              <td>{{ $route->driver_name ?? 'N/A' }}</td>
              <td>{{ $route->vehicle_id ?? 'N/A' }}</td>
              <td>{{ $route->number_of_stops ?? 0 }} stops</td>
              <td>—</td>
              <td>
                @if ($route->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $route->id }}"
                    data-route_name="{{ $route->route_name }}"
                    data-zone_area="{{ $route->zone_area }}"
                    data-driver_name="{{ $route->driver_name }}"
                    data-vehicle_id="{{ $route->vehicle_id }}"
                    data-number_of_stops="{{ $route->number_of_stops }}"
                    data-route_description="{{ $route->route_description }}"
                    data-status="{{ $route->status }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-id="{{ $route->id }}"
                    data-route_name="{{ $route->route_name }}"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No routes found.</td>
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

  <div class="modal fade" id="modalRoute" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Delivery Route</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-route">
          <div class="modal-body">
            <input type="hidden" name="id" id="route-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Route Name</label>
                <input class="erp-form-control" type="text" name="route_name" id="route-name" placeholder="" required />
                <div class="invalid-feedback" id="error-route_name"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Zone / Area</label>
                <input class="erp-form-control" type="text" name="zone_area" id="zone-area" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Driver</label>
                <input class="erp-form-control" type="text" name="driver_name" id="driver-name" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Vehicle ID</label>
                <input class="erp-form-control" type="text" name="vehicle_id" id="vehicle-id" placeholder="TRK-XXX" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">No. of Stops</label>
                <input class="erp-form-control" type="number" name="number_of_stops" id="number-of-stops" placeholder="" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Route Description / Stops</label>
                <textarea class="erp-form-control" name="route_description" id="route-description" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-route_description"></div>
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
              <i class="bi bi-check2"></i> Save Route
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
    store: '{{ route("routes.store") }}',
    update: '{{ route("routes.update", ":id") }}',
    destroy: '{{ route("routes.destroy", ":id") }}'
  };

  var $modal = $('#modalRoute');
  var $form = $('#form-route');
  var $btnSave = $('#btn-save');
  var routeId = null;
  var isEdit = false;

  $('#btn-add-route').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Delivery Route');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    routeId = $(this).data('id');
    $('#modal-title').text('Edit Delivery Route');

    $('#route-id').val(routeId);
    $('#route-name').val($(this).data('route_name'));
    $('#zone-area').val($(this).data('zone_area'));
    $('#driver-name').val($(this).data('driver_name'));
    $('#vehicle-id').val($(this).data('vehicle_id'));
    $('#number-of-stops').val($(this).data('number_of_stops'));
    $('#route-description').val($(this).data('route_description'));
    $('#status').val($(this).data('status') || 'Active');

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    routeId = $(this).data('id');
    var route_name = $(this).data('route_name');
    $('#delete-target').text(route_name || 'this route');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', routeId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Route deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', routeId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Route updated' : 'Route created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Route');
      }
    });
  });

  function resetForm() {
    routeId = null;
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