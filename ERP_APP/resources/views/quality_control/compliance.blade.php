@extends('layouts.erp')

@section('title', 'Compliance Reports')
@section('breadcrumb', 'Compliance Reports')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Compliance Reports</div>
    <div class="page-subtitle">Regulatory compliance reports and certification tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-compliance"><i class="bi bi-plus-lg"></i> New Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search compliance reports…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Compliant</option><option>Non-Compliant</option><option>Pending</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Report #</th><th>Standard/Regulation</th><th>Scope</th><th>Audit Date</th><th>Next Audit</th><th>Auditor</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $compliance)
        <tr>
          <td>COMP-{{ $compliance->id }}</td>
          <td>{{ $compliance->standard_regulation }}</td>
          <td>{{ $compliance->scope }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->audit_date)->format('Y-m-d') }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->next_audit_date)->format('Y-m-d') }}</td>
          <td>{{ $compliance->auditor }}</td>
          <td>
            @if($compliance->status === 'Compliant' || $compliance->status === 'Active')
            <span class="badge-status badge-active">Compliant</span>
            @elseif($compliance->status === 'Non-Compliant' || $compliance->status === 'Failed')
            <span class="badge-status badge-inactive">Failed</span>
            @elseif($compliance->status === 'Pending')
            <span class="badge-status badge-pending">Pending</span>
            @else
            <span class="badge-status">{{ $compliance->status }}</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                data-id="{{ $compliance->id }}"
                data-standard_regulation="{{ $compliance->standard_regulation }}"
                data-scope="{{ $compliance->scope }}"
                data-audit_date="{{ $compliance->audit_date }}"
                data-next_audit_date="{{ $compliance->next_audit_date }}"
                data-auditor="{{ $compliance->auditor }}"
                data-findings_notes="{{ $compliance->findings_notes }}"
                title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                data-id="{{ $compliance->id }}"
                data-label="Report" title="Delete"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No compliance reports found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div class="erp-pagination">
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalCompliance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New Compliance Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-compliance">
          <input type="hidden" name="id" id="compliance-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Standard / Regulation</label>
              <input class="erp-form-control" type="text" name="standard_regulation" placeholder="e.g. ISO 9001:2015"/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Scope</label>
              <input class="erp-form-control" type="text" name="scope" placeholder=""/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Audit Date</label>
              <input class="erp-form-control" type="date" name="audit_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Next Audit</label>
              <input class="erp-form-control" type="date" name="next_audit_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Auditor</label>
              <input class="erp-form-control" type="text" name="auditor" placeholder=""/>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Findings / Notes</label>
              <textarea class="erp-form-control" name="findings_notes" rows="2" placeholder=""></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save
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
    store: '{{ route("compliance.store") }}',
    update: '{{ route("compliance.update", ":id") }}',
    destroy: '{{ route("compliance.destroy", ":id") }}'
  };

  var $modal = $('#modalCompliance');
  var $form = $('#form-compliance');
  var $btnSave = $('#btn-save');
  var complianceId = null;
  var isEdit = false;

  function resetForm() {
    $form[0].reset();
    $('#compliance-id').val('');
    isEdit = false;
    complianceId = null;
  }

  $('#btn-add-compliance').on('click', function () {
    resetForm();
    $('#modal-title').text('New Compliance Report');
    $modal.modal('show');
  });

  $(document).on('click', '.btn-edit', function () {
    resetForm();
    isEdit = true;
    complianceId = $(this).data('id');
    $('#modal-title').text('Edit Compliance Report');
    $('#compliance-id').val(complianceId);
    $('[name="standard_regulation"]').val($(this).data('standard_regulation'));
    $('[name="scope"]').val($(this).data('scope'));
    $('[name="audit_date"]').val($(this).data('audit_date'));
    $('[name="next_audit_date"]').val($(this).data('next_audit_date'));
    $('[name="auditor"]').val($(this).data('auditor'));
    $('[name="findings_notes"]').val($(this).data('findings_notes'));
    $modal.modal('show');
  });

  $(document).on('click', '.btn-delete', function () {
    complianceId = $(this).data('id');
    var label = $(this).data('label') || 'record';
    $('#delete-target').text(label);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function () {
    $.ajax({
      url: routes.destroy.replace(':id', complianceId),
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || 'Report deleted', 'success');
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

    var url = isEdit ? routes.update.replace(':id', complianceId) : routes.store;
    var method = isEdit ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $form.serialize(),
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      success: function (res) {
        if (res.success) {
          showToast(res.message || (isEdit ? 'Report updated' : 'Report created'), 'success');
          $modal.modal('hide');
          setTimeout(() => location.reload(), 1000);
        }
      },
      error: function (xhr) {
        showToast(xhr.responseJSON?.message || 'Operation failed', 'error');
      },
      complete: function () {
        $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save');
      }
    });
  });
});
</script>
@endpush