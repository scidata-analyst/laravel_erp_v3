@extends('layouts.erp')

@section('title', 'Multi-Warehouse Management')
@section('breadcrumb', 'Multi-Warehouse Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Multi-Warehouse Management</div>
      <div class="page-subtitle">Manage multiple warehouse locations and capacity</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-warehouse"><i class="bi bi-plus-lg"></i> Add Warehouse</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search multi-warehouse management…" />
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
            <th>Warehouse</th>
            <th>Code</th>
            <th>Location</th>
            <th>Manager</th>
            <th>Capacity</th>
            <th>Used</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $warehouse)
            <tr>
              <td>{{ $warehouse->warehouse_name }}</td>
              <td>{{ $warehouse->warehouse_code }}</td>
              <td>{{ $warehouse->location_address ?? 'N/A' }}</td>
              <td>{{ $warehouse->manager_id ?? 'N/A' }}</td>
              <td>{{ number_format($warehouse->capacity_units ?? 0) }} units</td>
              <td>0 (0%)</td>
              <td>
                @if ($warehouse->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $warehouse->id }}"
                    data-warehouse_name="{{ $warehouse->warehouse_name }}"
                    data-warehouse_code="{{ $warehouse->warehouse_code }}"
                    data-warehouse_type="{{ $warehouse->warehouse_type }}"
                    data-location_address="{{ $warehouse->location_address }}"
                    data-manager_id="{{ $warehouse->manager_id }}"
                    data-capacity_units="{{ $warehouse->capacity_units }}"
                    data-status="{{ $warehouse->status }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-id="{{ $warehouse->id }}"
                    data-warehouse_name="{{ $warehouse->warehouse_name }}"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No warehouses found.</td>
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

  <div class="modal fade" id="modalWarehouse" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Warehouse</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-warehouse">
          <div class="modal-body">
            <input type="hidden" name="id" id="warehouse-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Warehouse Name</label>
                <input class="erp-form-control" type="text" name="warehouse_name" id="warehouse-name" placeholder="" required />
                <div class="invalid-feedback" id="error-warehouse_name"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Code</label>
                <input class="erp-form-control" type="text" name="warehouse_code" id="warehouse-code" placeholder="WH-X" required />
                <div class="invalid-feedback" id="error-warehouse_code"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Type</label>
                <select class="erp-form-control" name="warehouse_type" id="warehouse-type">
                  <option value="Standard">Standard</option>
                  <option value="Cold Storage">Cold Storage</option>
                  <option value="Bonded">Bonded</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Location / Address</label>
                <input class="erp-form-control" type="text" name="location_address" id="location-address" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Manager</label>
                <input class="erp-form-control" type="text" name="manager_id" id="manager-id" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Capacity (units)</label>
                <input class="erp-form-control" type="number" name="capacity_units" id="capacity-units" placeholder="" />
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
              <i class="bi bi-check2"></i> Save Warehouse
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
    store: '{{ route("warehouses.store") }}',
    update: '{{ route("warehouses.update", ":id") }}',
    destroy: '{{ route("warehouses.destroy", ":id") }}'
  };

  var $modal = $('#modalWarehouse');
  var $form = $('#form-warehouse');
  var $btnSave = $('#btn-save');
  var warehouseId = null;
  var isEdit = false;

  $('#btn-add-warehouse').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('Add Warehouse');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    warehouseId = $(this).data('id');
    $('#modal-title').text('Edit Warehouse');

    $('#warehouse-id').val(warehouseId);
    $('#warehouse-name').val($(this).data('warehouse_name'));
    $('#warehouse-code').val($(this).data('warehouse_code'));
    $('#warehouse-type').val($(this).data('warehouse_type') || 'Standard');
    $('#location-address').val($(this).data('location_address'));
    $('#manager-id').val($(this).data('manager_id'));
    $('#capacity-units').val($(this).data('capacity_units'));
    $('#status').val($(this).data('status') || 'Active');

    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    warehouseId = $(this).data('id');
    var warehouse_name = $(this).data('warehouse_name');
    $('#delete-target').text(warehouse_name || 'this warehouse');
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', warehouseId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Warehouse deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', warehouseId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Warehouse updated' : 'Warehouse created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Warehouse');
      }
    });
  });

  function resetForm() {
    warehouseId = null;
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