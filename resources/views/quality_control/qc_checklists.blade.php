@extends('layouts.erp')

@section('title', 'QC Checklists')
@section('breadcrumb', 'Quality Control / QC Checklists')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">QC Checklists</div>
    <div class="page-subtitle">Quality inspection checklists for products and production</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-checklist"><i class="bi bi-plus-lg"></i> New Checklist</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search qc checklists…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Incoming</option><option>In-Process</option><option>Final</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Checklist #</th><th>Product/Batch</th><th>Inspector</th><th>Inspection Type</th><th>Items Checked</th><th>Pass Rate</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $checklist)
          <tr>
            <td>QC-{{ $checklist->id }}</td>
            <td>{{ $checklist->product_batch_work_order ?? 'N/A' }}</td>
            <td>{{ $checklist->inspector_id ?? 'N/A' }}</td>
            <td>{{ $checklist->inspection_type ?? 'N/A' }}</td>
            <td>0/0</td>
            <td>0%</td>
            <td>
              @if ($checklist->status == 'Passed')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Failed</span>
              @endif
            </td>
            <td><div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                data-id="{{ $checklist->id }}"
                data-product_batch_work_order="{{ $checklist->product_batch_work_order }}"
                data-inspector_id="{{ $checklist->inspector_id }}"
                data-inspection_type="{{ $checklist->inspection_type }}"
                data-inspection_date="{{ $checklist->inspection_date }}"
                data-sample_size="{{ $checklist->sample_size }}"
                data-notes="{{ $checklist->notes }}"
                title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                data-id="{{ $checklist->id }}"
                data-label="Checklist" title="Delete"><i class="bi bi-trash"></i></button>
            </div></td>
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

<div class="modal fade" id="modalQC" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New QC Checklist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-checklist">
          <input type="hidden" name="id" id="checklist-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Product / Batch / Work Order</label>
              <input class="erp-form-control" type="text" name="product_batch_work_order" placeholder=""/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Inspector</label>
              <select class="erp-form-control" name="inspector_id">
                <option value="">Select Inspector</option>
                <option>Nadia Q.</option>
                <option>Kamal I.</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Inspection Type</label>
              <select class="erp-form-control" name="inspection_type">
                <option value="">Select Type</option>
                <option>Incoming</option>
                <option>In-Process</option>
                <option>Final</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Inspection Date</label>
              <input class="erp-form-control" type="date" name="inspection_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Sample Size</label>
              <input class="erp-form-control" type="number" name="sample_size" placeholder=""/>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Checklist Items / Notes</label>
              <textarea class="erp-form-control" name="notes" rows="3" placeholder="List inspection criteria…"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save Checklist
        </button>
      </div>
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
$(function () {
  var routes = {
    store: '{{ route("qc_checklists.store") }}',
    update: '{{ route("qc_checklists.update", ":id") }}',
    destroy: '{{ route("qc_checklists.destroy", ":id") }}'
  };

  var $modal = $('#modalQC');
  var $form = $('#form-checklist');
  var $btnSave = $('#btn-save');
  var checklistId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $('#checklist-id').val('');
    isEdit = false;
    checklistId = null;
  }

  $('#btn-add-checklist').on('click', function () {
    resetForm();
    $('#modal-title').text('New QC Checklist');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    checklistId = $(this).data('id');
    $('#modal-title').text('Edit QC Checklist');
    $('#checklist-id').val(checklistId);
    $('[name="product_batch_work_order"]').val($(this).data('product_batch_work_order'));
    $('[name="inspector_id"]').val($(this).data('inspector_id'));
    $('[name="inspection_type"]').val($(this).data('inspection_type'));
    $('[name="inspection_date"]').val($(this).data('inspection_date'));
    $('[name="sample_size"]').val($(this).data('sample_size'));
    $('[name="notes"]').val($(this).data('notes'));
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    checklistId = $(this).data('id');
    var label = $(this).data('label') || 'record';
    $('#delete-target').text(label);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', checklistId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Checklist deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', checklistId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Checklist updated' : 'Checklist created'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function (xhr) {
        showToast(xhr.responseJSON?.message || 'Operation failed', 'error');
      },
      complete: function () {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Checklist');
      }
    });
  });
});
</script>
@endpush