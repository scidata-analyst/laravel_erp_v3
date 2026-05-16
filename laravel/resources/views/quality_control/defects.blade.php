@extends('layouts.erp')

@section('title', 'Defect Tracking')
@section('breadcrumb', 'Quality Control / Defect Tracking')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Defect Tracking</div>
    <div class="page-subtitle">Log, track and resolve product defects and non-conformances</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-defect"><i class="bi bi-plus-lg"></i> Log Defect</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search defect tracking…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Open</option>
      <option>In Review</option>
      <option>Resolved</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Defect #</th>
          <th>Product</th>
          <th>Batch/Lot</th>
          <th>Defect Type</th>
          <th>Severity</th>
          <th>Raised By</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $defect)
          <tr>
            <td>DEF-{{ $defect->id }}</td>
            <td>{{ $defect->product_id ?? 'N/A' }}</td>
            <td>{{ $defect->batch_lot_number ?? 'N/A' }}</td>
            <td>{{ $defect->defect_type ?? 'N/A' }}</td>
            <td>
              @if ($defect->severity == 'Critical')
                <span class="badge-status badge-inactive">Critical</span>
              @elseif ($defect->severity == 'High')
                <span class="badge-status badge-pending">High</span>
              @else
                <span class="badge-status badge-info">{{ $defect->severity }}</span>
              @endif
            </td>
            <td>—</td>
            <td>
              @if ($defect->status == 'Resolved')
                <span class="badge-status badge-active">Resolved</span>
              @elseif ($defect->status == 'Open')
                <span class="badge-status badge-pending">Open</span>
              @else
                <span class="badge-status badge-pending">In Review</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                  data-id="{{ $defect->id }}"
                  data-product_id="{{ $defect->product_id }}"
                  data-batch_lot_number="{{ $defect->batch_lot_number }}"
                  data-defect_type="{{ $defect->defect_type }}"
                  data-severity="{{ $defect->severity }}"
                  data-qty_affected="{{ $defect->qty_affected }}"
                  data-description="{{ $defect->description }}"
                  title="Edit"><i class="bi bi-pencil"></i></button>
                <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                  data-id="{{ $defect->id }}"
                  data-label="Defect" title="Delete"><i class="bi bi-trash"></i></button>
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

<div class="modal fade" id="modalDefect" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Log Defect</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-defect">
          <input type="hidden" name="id" id="defect-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Product</label>
              <select class="erp-form-control" name="product_id">
                <option value="">Select Product</option>
                <option>Assembled PCB Board</option>
                <option>Battery Pack 18V</option>
                <option>Steel Bracket</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Batch / Lot</label>
              <input class="erp-form-control" type="text" name="batch_lot_number" placeholder="LOT-XXXX-XXX" />
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Defect Type</label>
              <input class="erp-form-control" type="text" name="defect_type" placeholder="e.g. Dimensional Error" />
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Severity</label>
              <select class="erp-form-control" name="severity">
                <option value="">Select Severity</option>
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
                <option>Critical</option>
              </select>
            </div>
            <div class="col-md-3">
              <label class="erp-form-label">Qty Affected</label>
              <input class="erp-form-control" type="number" name="qty_affected" placeholder="" />
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Description / Root Cause</label>
              <textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Log Defect
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
@endsection

@push('scripts')
<script>
$(function () {
  var routes = {
    store: '{{ route("defects.store") }}',
    update: '{{ route("defects.update", ":id") }}',
    destroy: '{{ route("defects.destroy", ":id") }}'
  };

  var $modal = $('#modalDefect');
  var $form = $('#form-defect');
  var $btnSave = $('#btn-save');
  var defectId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $('#defect-id').val('');
    isEdit = false;
    defectId = null;
  }

  $('#btn-add-defect').on('click', function () {
    resetForm();
    $('#modal-title').text('Log Defect');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    defectId = $(this).data('id');
    $('#modal-title').text('Edit Defect');
    $('#defect-id').val(defectId);
    $('[name="product_id"]').val($(this).data('product_id'));
    $('[name="batch_lot_number"]').val($(this).data('batch_lot_number'));
    $('[name="defect_type"]').val($(this).data('defect_type'));
    $('[name="severity"]').val($(this).data('severity'));
    $('[name="qty_affected"]').val($(this).data('qty_affected'));
    $('[name="description"]').val($(this).data('description'));
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    defectId = $(this).data('id');
    var label = $(this).data('label') || 'record';
    $('#delete-target').text(label);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', defectId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Defect deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', defectId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Defect updated' : 'Defect logged'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function (xhr) {
        showToast(xhr.responseJSON?.message || 'Operation failed', 'error');
      },
      complete: function () {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Log Defect');
      }
    });
  });
});
</script>
@endpush