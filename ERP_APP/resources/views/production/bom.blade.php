@extends('layouts.erp')

@section('title', 'Bill of Materials')
@section('breadcrumb', 'Production / Bill of Materials')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Bill of Materials</div>
      <div class="page-subtitle">Define bill of materials for manufactured products</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-bom"><i class="bi bi-plus-lg"></i> New BOM</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search bill of materials…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Draft</option>
        <option>Archived</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>BOM #</th>
            <th>Product</th>
            <th>Version</th>
            <th>Components</th>
            <th>Est. Cost</th>
            <th>Lead Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $bom)
            <tr>
              <td>BOM-{{ $bom->id }}</td>
              <td>{{ $bom->finished_product_name }}</td>
              <td>{{ $bom->version ?? 'v1.0' }}</td>
              <td>0 components</td>
              <td>$0.00</td>
              <td>{{ $bom->lead_time_days ?? 0 }} days</td>
              <td>
                @if ($bom->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($bom->status == 'Draft')
                  <span class="badge-status badge-info">Draft</span>
                @else
                  <span class="badge-status badge-inactive">Archived</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $bom->id }}"
                    data-finished_product_name="{{ $bom->finished_product_name }}"
                    data-version="{{ $bom->version ?? 'v1.0' }}"
                    data-lead_time_days="{{ $bom->lead_time_days ?? 0 }}"
                    data-status="{{ $bom->status ?? 'Draft' }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $bom->id }}"
                    data-delete-label="BOM-{{ $bom->id }}" title="Delete"><i class="bi bi-trash"></i></button>
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


  <div class="modal fade" id="modalBOM" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Bill of Materials</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-bom">
          <div class="modal-body">
            <input type="hidden" name="id" id="bom-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Finished Product</label>
                <input class="erp-form-control" type="text" name="finished_product_name" id="finished_product_name" placeholder="Product name" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Version</label>
                <input class="erp-form-control" type="text" name="version" id="bom-version" placeholder="v1.0" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Lead Time (days)</label>
                <input class="erp-form-control" type="number" name="lead_time_days" id="lead_time_days" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="bom-status">
                  <option value="Draft">Draft</option>
                  <option value="Active">Active</option>
                  <option value="Archived">Archived</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Save BOM
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
    store: '{{ route("bom.store") }}',
    update: '{{ route("bom.update", ":id") }}',
    destroy: '{{ route("bom.destroy", ":id") }}'
  };

  var $modal = $('#modalBOM');
  var $form = $('#form-bom');
  var $btnSave = $('#btn-save');
  var bomId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $form.find('.is-invalid').removeClass('is-invalid');
    $form.find('.invalid-feedback').hide();
    $('#bom-id').val('');
  }

  $('#btn-add-bom').on('click', function() {
    resetForm();
    isEdit = false;
    $('#modal-title').text('New Bill of Materials');
    $btnSave.html('<i class="bi bi-check2"></i> Save BOM');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function() {
    resetForm();
    isEdit = true;
    bomId = $(this).data('id');
    $('#modal-title').text('Edit Bill of Materials');
    
    $('#bom-id').val(bomId);
    $('#finished_product_name').val($(this).data('finished_product_name'));
    $('#bom-version').val($(this).data('version'));
    $('#lead_time_days').val($(this).data('lead_time_days'));
    $('#bom-status').val($(this).data('status') || 'Draft');
    
    $btnSave.html('<i class="bi bi-check2"></i> Update BOM');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function() {
    bomId = $(this).data('id');
    var id_display = $(this).data('delete-label') || 'this BOM';
    $('#delete-target').text(id_display);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: routes.destroy.replace(':id', bomId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || 'BOM deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', bomId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function(res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'BOM updated' : 'BOM created'), 'success');
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
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save BOM');
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
