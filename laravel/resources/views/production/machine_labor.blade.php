@extends('layouts.erp')

@section('title', 'Machine & Labor')
@section('breadcrumb', 'Production / Machine & Labor')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Machine & Labor</div>
      <div class="page-subtitle">Track machine utilization and labor hours on production</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-machine-labor"><i class="bi bi-plus-lg"></i> Log Entry</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search machine & labor…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Machine</option>
        <option>Labor</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Work Order</th>
            <th>Resource</th>
            <th>Type</th>
            <th>Scheduled Hours</th>
            <th>Actual Hours</th>
            <th>Cost/hr</th>
            <th>Total Cost</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $ml)
            <tr>
              <td>WO-{{ $ml->work_order_id ?? 'N/A' }}</td>
              <td>{{ $ml->resource_name ?? 'N/A' }}</td>
              <td>{{ $ml->resource_type ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $ml->hours_used ?? 0 }}h</td>
              <td>${{ number_format($ml->cost_per_hour ?? 0, 2) }}</td>
              <td>${{ number_format($ml->total_cost ?? 0, 2) }}</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $ml->id }}"
                    data-work_order_id="{{ $ml->work_order_id }}"
                    data-resource_name="{{ $ml->resource_name }}"
                    data-resource_type="{{ $ml->resource_type }}"
                    data-hours_used="{{ $ml->hours_used }}"
                    data-cost_per_hour="{{ $ml->cost_per_hour }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $ml->id }}"
                    data-delete-label="Entry" title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
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


  <div class="modal fade" id="modalMachineLabor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Log Machine / Labor Entry</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-machine-labor">
          <div class="modal-body">
            <input type="hidden" name="id" id="machine-labor-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Work Order</label>
                <input class="erp-form-control" type="number" name="work_order_id" id="work-order-id" placeholder="WO ID" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Resource Name</label>
                <input class="erp-form-control" type="text" name="resource_name" id="resource-name" placeholder="Machine or employee name" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Type</label>
                <select class="erp-form-control" name="resource_type" id="resource-type">
                  <option value="Machine">Machine</option>
                  <option value="Labor">Labor</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Hours Used</label>
                <input class="erp-form-control" type="number" name="hours_used" id="hours-used" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Cost per Hour ($)</label>
                <input class="erp-form-control" type="number" name="cost_per_hour" id="cost-per-hour" placeholder="" />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Log Entry
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm
            Delete</h5>
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
    store: '{{ route("machine_labor.store") }}',
    update: '{{ route("machine_labor.update", ":id") }}',
    destroy: '{{ route("machine_labor.destroy", ":id") }}'
  };

  var $modal = $('#modalMachineLabor');
  var $form = $('#form-machine-labor');
  var $btnSave = $('#btn-save');
  var machineLaborId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').hide();
    $('#machine-labor-id').val('');
  }

  $('#btn-add-machine-labor').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('Log Machine / Labor Entry');
    $btnSave.html('<i class="bi bi-check2"></i> Log Entry');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    machineLaborId = $(this).data('id');
    $('#modal-title').text('Edit Machine / Labor Entry');
    
    $('#machine-labor-id').val(machineLaborId);
    $('#work-order-id').val($(this).data('work_order_id'));
    $('#resource-name').val($(this).data('resource_name'));
    $('#resource-type').val($(this).data('resource_type') || 'Machine');
    $('#hours-used').val($(this).data('hours_used'));
    $('#cost-per-hour').val($(this).data('cost_per_hour'));
    
    $btnSave.html('<i class="bi bi-check2"></i> Update Entry');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    machineLaborId = $(this).data('id');
    var id_display = $(this).data('delete-label') || 'this entry';
    $('#delete-target').text(id_display);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', machineLaborId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Entry deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', machineLaborId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Entry updated' : 'Entry created'), 'success');
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
            $('<div class="invalid-feedback" style="display:block">' + messages[0] + '</div>').insertAfter($input);
          });
        } else if (res && res.message) {
          showToast(res.message, 'error');
        } else {
          showToast('An error occurred', 'error');
        }
      },
      complete: function() {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Log Entry');
      }
    });
  });

  function showToast(msg, type) {
    var $t = $('<div class="erp-toast ' + type + '"></div>')
      .html('<span class="toast-icon">' + (type === 'success' ? '✓' : '✕') + '</span><span class="toast-message">' + msg + '</span>');
    $('#toast-container').append($t);
    setTimeout(function() { $t.addClass('show'); }, 10);
    setTimeout(function() { $t.remove(); }, 4000);
  }
});
</script>
@endpush
