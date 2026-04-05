@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Document Library</div>
    <div class="page-subtitle">Centralized document storage for contracts, POs and invoices</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDocument"><i class="bi bi-plus-lg"></i> Upload Document</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search document library…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>Contract</option><option>Invoice</option><option>PO</option><option>Report</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Document Name</th><th>Type</th><th>Related To</th><th>Version</th><th>Size</th><th>Uploaded By</th><th>Date</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalDocument" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Upload Document</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Document Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Document Type</label><select class="erp-form-control" name="file_type"><option>Contract</option><option>Invoice</option><option>Purchase Order</option><option>Report</option><option>Certificate</option></select></div><div class="col-md-6"><label class="erp-form-label">Related To</label><input class="erp-form-control" name="category" type="text" placeholder="Supplier, Customer, Project…"/></div><div class="col-md-3"><label class="erp-form-label">Version</label><input class="erp-form-control" name="version" type="text" placeholder="v1.0"/></div><div class="col-md-3"><label class="erp-form-label">Access Level</label><select class="erp-form-control" name="status"><option>Public</option><option>Private</option><option>Restricted</option></select></div><div class="col-md-12"><label class="erp-form-label">Upload File</label><input class="erp-form-control" name="file_path" type="file" placeholder=""/></div><div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Upload
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  window.loadTableData = function() {
    ErpApi.loadTable('/document/doc-library', '#tbl-main tbody', function(item) {
      return '<tr>' +
        '<td>' + (item.name||'') + '</td>' +
        '<td>' + (item.file_type||'') + '</td>' +
        '<td>' + (item.category||'') + '</td>' +
        '<td>' + (item.version||'v1.0') + '</td>' +
        '<td>' + (item.size||'') + '</td>' +
        '<td>' + (item.uploaded_by||'') + '</td>' +
        '<td>' + (item.created_at||'') + '</td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-success btn-xs btn-icon btn-export" title="Download"><i class="bi bi-download"></i></button>' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalDocument" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/document/doc-library/'+item.id+'" data-delete-label="Document" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalDocument').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalDocument');
    }
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/document/doc-library/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalDocument', res.data);
    });
  });

  $('#modalDocument .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalDocument');
    if (editId) {
      ErpApi.put('/document/doc-library/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Document updated', 'success'); bootstrap.Modal.getInstance($('#modalDocument')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/document/doc-library', data, function(res) {
        if (res.success) { showToast(res.message || 'Document uploaded', 'success'); bootstrap.Modal.getInstance($('#modalDocument')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Upload failed', 'error');
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
