@extends('layouts.erp')

@section('title', 'Work Orders')
@section('breadcrumb', 'Production / Work Orders')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Work Orders</div>
      <div class="page-subtitle">Production work orders and manufacturing scheduling</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-work-order"><i class="bi bi-plus-lg"></i> New Work Order</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search work orders…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Scheduled</option>
        <option>In Progress</option>
        <option>Completed</option>
        <option>On Hold</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>WO #</th>
            <th>Product</th>
            <th>BOM</th>
            <th>Qty</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $workOrder)
            <tr>
              <td>WO-{{ $workOrder->id }}</td>
              <td>{{ $workOrder->bom_id ?? 'N/A' }}</td>
              <td>BOM-{{ $workOrder->bom_id ?? 'N/A' }}</td>
              <td>{{ $workOrder->quantity_to_produce ?? 0 }} units</td>
              <td>{{ $workOrder->start_date ? \Carbon\Carbon::parse($workOrder->start_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $workOrder->end_date ? \Carbon\Carbon::parse($workOrder->end_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $workOrder->workshop_line ?? 'N/A' }}</td>
              <td>
                @if ($workOrder->status == 'Completed')
                  <span class="badge-status badge-active">Completed</span>
                @elseif ($workOrder->status == 'In Progress')
                  <span class="badge-status badge-pending">In Progress</span>
                @elseif ($workOrder->status == 'Scheduled')
                  <span class="badge-status badge-info">Scheduled</span>
                @else
                  <span class="badge-status badge-pending">{{ $workOrder->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $workOrder->id }}"
                    data-bom_id="{{ $workOrder->bom_id }}"
                    data-quantity_to_produce="{{ $workOrder->quantity_to_produce }}"
                    data-start_date="{{ $workOrder->start_date ? \Carbon\Carbon::parse($workOrder->start_date)->format('Y-m-d') : '' }}"
                    data-end_date="{{ $workOrder->end_date ? \Carbon\Carbon::parse($workOrder->end_date)->format('Y-m-d') : '' }}"
                    data-workshop_line="{{ $workOrder->workshop_line }}"
                    data-priority="{{ $workOrder->priority }}"
                    data-status="{{ $workOrder->status }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $workOrder->id }}"
                    data-delete-label="WO-{{ $workOrder->id }}" title="Delete"><i class="bi bi-trash"></i></button>
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


  <div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Work Order</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-work-order">
          <div class="modal-body">
            <input type="hidden" name="id" id="work-order-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product / BOM</label>
                <input class="erp-form-control" type="number" name="bom_id" id="bom-id" placeholder="BOM ID" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Qty to Produce</label>
                <input class="erp-form-control" type="number" name="quantity_to_produce" id="quantity-to-produce" placeholder="" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Priority</label>
                <select class="erp-form-control" name="priority" id="priority">
                  <option value="Normal">Normal</option>
                  <option value="High">High</option>
                  <option value="Urgent">Urgent</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Start Date</label>
                <input class="erp-form-control" type="date" name="start_date" id="start-date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">End Date</label>
                <input class="erp-form-control" type="date" name="end_date" id="end-date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Workshop / Line</label>
                <select class="erp-form-control" name="workshop_line" id="workshop-line">
                  <option value="Workshop A">Workshop A</option>
                  <option value="Workshop B">Workshop B</option>
                  <option value="Workshop C">Workshop C</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="work-order-status">
                  <option value="Scheduled">Scheduled</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Completed">Completed</option>
                  <option value="On Hold">On Hold</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Create Work Order
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
    store: '{{ route("work_orders.store") }}',
    update: '{{ route("work_orders.update", ":id") }}',
    destroy: '{{ route("work_orders.destroy", ":id") }}'
  };

  var $modal = $('#modalWorkOrder');
  var $form = $('#form-work-order');
  var $btnSave = $('#btn-save');
  var workOrderId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').hide();
    $('#work-order-id').val('');
  }

  $('#btn-add-work-order').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Work Order');
    $btnSave.html('<i class="bi bi-check2"></i> Create Work Order');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    workOrderId = $(this).data('id');
    $('#modal-title').text('Edit Work Order');
    
    $('#work-order-id').val(workOrderId);
    $('#bom-id').val($(this).data('bom_id'));
    $('#quantity-to-produce').val($(this).data('quantity_to_produce'));
    $('#start-date').val($(this).data('start_date'));
    $('#end-date').val($(this).data('end_date'));
    $('#workshop-line').val($(this).data('workshop_line') || 'Workshop A');
    $('#priority').val($(this).data('priority') || 'Normal');
    $('#work-order-status').val($(this).data('status') || 'Scheduled');
    
    $btnSave.html('<i class="bi bi-check2"></i> Update Work Order');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    workOrderId = $(this).data('id');
    var id_display = $(this).data('delete-label') || 'this work order';
    $('#delete-target').text(id_display);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', workOrderId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'Work order deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', workOrderId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Work order updated' : 'Work order created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Create Work Order');
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
