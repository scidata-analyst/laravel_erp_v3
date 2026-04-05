@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Version Control</div>
    <div class="page-subtitle">Track document revision history and access control</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalVersion"><i class="bi bi-plus-lg"></i> New Version</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search version control…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Latest</option><option>Archived</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Document</th><th>Version</th><th>Changed By</th><th>Change Summary</th><th>Date</th><th>Approved By</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalVersion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add New Version</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Document</label><select class="erp-form-control" name="document_id"><option>Supplier Agreement – TechSource</option><option>Employee Handbook</option><option>Quality Manual</option></select></div><div class="col-md-3"><label class="erp-form-label">New Version</label><input class="erp-form-control" name="version_number" type="text" placeholder="v2.2"/></div><div class="col-md-3"><label class="erp-form-label">Change Type</label><select class="erp-form-control" name="change_type"><option>Minor</option><option>Major</option><option>Correction</option></select></div><div class="col-md-12"><label class="erp-form-label">Change Summary</label><textarea class="erp-form-control" name="changes" rows="2" placeholder="Describe what changed…"></textarea></div><div class="col-md-6"><label class="erp-form-label">Approver</label><select class="erp-form-control" name="approved_by"><option>Adam K.</option><option>Sara L.</option><option>Maya P.</option></select></div><div class="col-md-6"><label class="erp-form-label">Upload New File</label><input class="erp-form-control" name="file_path" type="file" placeholder=""/></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Version
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  window.loadTableData = function() {
    ErpApi.loadTable('/document/doc-versions', '#tbl-main tbody', function(item) {
      var statusClass = (item.status === 'Archived') ? 'badge-inactive' : 'badge-active';
      var statusText = item.status || 'Active';
      return '<tr>' +
        '<td>' + (item.document_name||'') + '</td>' +
        '<td>' + (item.version_number||'') + '</td>' +
        '<td>' + (item.uploaded_by||'') + '</td>' +
        '<td>' + (item.changes||'') + '</td>' +
        '<td>' + (item.created_at||'') + '</td>' +
        '<td>' + (item.approved_by||'') + '</td>' +
        '<td><span class="badge-status '+statusClass+'">'+statusText+'</span></td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalVersion" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/document/doc-versions/'+item.id+'" data-delete-label="Version" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalVersion').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalVersion');
    }
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/document/doc-versions/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalVersion', res.data);
    });
  });

  $('#modalVersion .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalVersion');
    if (editId) {
      ErpApi.put('/document/doc-versions/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Version updated', 'success'); bootstrap.Modal.getInstance($('#modalVersion')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/document/doc-versions', data, function(res) {
        if (res.success) { showToast(res.message || 'Version created', 'success'); bootstrap.Modal.getInstance($('#modalVersion')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Create failed', 'error');
      });
    }
  });

  $(document).on('click', '.btn-delete', function() {
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label');
    $('#modalDelete').data('delete-url', url).data('delete-label', label);
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
  });

  $(document).on('click', '#btn-confirm-delete', function() {
    var url = $('#modalDelete').data('delete-url');
    if (!url) return;
    ErpApi.del(url, function(res) {
      if (res.success) { showToast(res.message || 'Deleted', 'success'); bootstrap.Modal.getInstance($('#modalDelete')[0]).hide(); loadTableData(); }
      else showToast(res.message || 'Delete failed', 'error');
    });
  });
});
</script>
@endsection
