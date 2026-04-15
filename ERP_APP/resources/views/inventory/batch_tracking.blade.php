@extends('layouts.erp')

@section('title', 'Batch / Expiry Tracking')
@section('breadcrumb', 'Inventory / Batch / Expiry Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Batch / Expiry / Serial Tracking</div>
      <div class="page-subtitle">Track lot numbers, serial IDs and expiry dates</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-batch" data-bs-toggle="modal" data-bs-target="#modalBatch"><i
          class="bi bi-plus-lg"></i> Add Batch</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main"
          placeholder="Search batch / expiry / serial tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Expiring Soon</option>
        <option>Expired</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Batch/Lot #</th>
            <th>Serial</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Mfg Date</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $batch)
            <tr>
              <td>{{ $batch->batch_lot_number }}</td>
              <td>{{ $batch->serial_number ?? 'N/A' }}</td>
              <td>{{ $batch->product_id ?? 'N/A' }}</td>
              <td>{{ $batch->quantity }}</td>
              <td>{{ $batch->manufacture_date ? \Carbon\Carbon::parse($batch->manufacture_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $batch->expiry_date ? \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if (\Carbon\Carbon::parse($batch->expiry_date)->isPast())
                  <span class="badge-status badge-inactive">Expired</span>
                @else
                  <span class="badge-status badge-active">Active</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $batch->id }}"
                    data-product_id="{{ $batch->product_id }}"
                    data-batch_lot_number="{{ $batch->batch_lot_number }}"
                    data-serial_number="{{ $batch->serial_number ?? '' }}"
                    data-quantity="{{ $batch->quantity }}"
                    data-manufacture_date="{{ $batch->manufacture_date ? \Carbon\Carbon::parse($batch->manufacture_date)->format('Y-m-d') : '' }}"
                    data-expiry_date="{{ $batch->expiry_date ? \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') : '' }}"
                    data-bs-toggle="modal" data-bs-target="#modalBatch" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $batch->id }}" data-batch_lot_number="{{ $batch->batch_lot_number }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Batch" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalBatch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add Batch / Serial</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-batch">
            @csrf
            <input type="hidden" name="id" id="batch-id">
            <div class="row g-3">
              <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control" name="product_id" id="product_id">
                  <option value="">Select Product</option>
                </select></div>
              <div class="col-md-6"><label class="erp-form-label">Batch / Lot #</label><input class="erp-form-control"
                  name="batch_lot_number" id="batch_lot_number" type="text" placeholder="LOT-XXXX-XXX" /></div>
              <div class="col-md-6"><label class="erp-form-label">Serial Number</label><input class="erp-form-control"
                  name="serial_number" id="serial_number" type="text" placeholder="SN-XXXXX" /></div>
              <div class="col-md-6"><label class="erp-form-label">Quantity</label><input class="erp-form-control"
                  name="quantity" id="quantity" type="number" placeholder="" /></div>
              <div class="col-md-6"><label class="erp-form-label">Manufacturing Date</label><input
                  class="erp-form-control" name="manufacture_date" id="manufacture_date" type="date" placeholder="" /></div>
              <div class="col-md-6"><label class="erp-form-label">Expiry Date</label><input class="erp-form-control"
                  name="expiry_date" id="expiry_date" type="date" placeholder="" /></div>
            </div>
          </form>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save">
            <i class="bi bi-check2"></i> Save Batch
          </button>
        </div>
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

  @push('scripts')
    <script>
      $(function () {
        var routes = {
          store: '{{ route("batch_tracking.store") }}',
          update: '{{ route("batch_tracking.update", ":id") }}',
          destroy: '{{ route("batch_tracking.destroy", ":id") }}'
        };

        var $modal = $('#modalBatch');
        var $form = $('#form-batch');
        var $btnSave = $('#btn-save');
        var batchId = null;
        var isEdit = false;

        $('#btn-add-batch').on('click', function () {
          resetForm();
          isEdit = false;
          $('#modal-title').text('Add Batch / Serial');
        });

        $modal.on('shown.bs.modal', function () {
          if (!isEdit) {
            resetForm();
            $('#modal-title').text('Add Batch / Serial');
          }
        });

        $(document).on('click', '.btn-edit', function () {
          resetForm();
          isEdit = true;
          batchId = $(this).data('id');
          $('#modal-title').text('Edit Batch / Serial');

          $('#batch-id').val(batchId);
          $('#product_id').val($(this).data('product_id'));
          $('#batch_lot_number').val($(this).data('batch_lot_number'));
          $('#serial_number').val($(this).data('serial_number'));
          $('#quantity').val($(this).data('quantity'));
          $('#manufacture_date').val($(this).data('manufacture_date'));
          $('#expiry_date').val($(this).data('expiry_date'));
        });

        $(document).on('click', '.btn-delete', function () {
          batchId = $(this).data('id');
          var batch_lot_number = $(this).data('batch_lot_number');
          $('#delete-target').text(batch_lot_number || 'this batch');
        });

        $('#btn-confirm-delete').on('click', function () {
          $.ajax({
            url: routes.destroy.replace(':id', batchId),
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
              if (res.success) {
                showToast(res.message || 'Batch deleted', 'success');
                $('#modalDelete').modal('hide');
                setTimeout(() => location.reload(), 1000);
              }
            },
            error: function (xhr) {
              showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
            }
          });
        });

        $btnSave.on('click', function () {
          $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

          var url = isEdit ? routes.update.replace(':id', batchId) : routes.store;
          var method = isEdit ? 'PUT' : 'POST';

          $.ajax({
            url: url,
            method: method,
            data: $form.serialize(),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
              if (res.success) {
                showToast(res.message || (isEdit ? 'Batch updated' : 'Batch created'), 'success');
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
                });
                showToast('Please check the form for errors', 'error');
              } else if (res && res.message) {
                showToast(res.message, 'error');
              } else {
                showToast('An error occurred', 'error');
              }
            },
            complete: function () {
              $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Batch');
            }
          });
        });

        function resetForm() {
          batchId = null;
          isEdit = false;
          $form[0].reset();
          $form.find('.is-invalid').removeClass('is-invalid');
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