@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">QC Checklists</div>
    <div class="page-subtitle">Quality inspection checklists for products and production</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalQC"><i class="bi bi-plus-lg"></i> New Checklist</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search qc checklists…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>Incoming</option><option>In-Process</option><option>Final</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Name</th><th>Product ID</th><th>Inspection Type</th><th>Criteria</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalQC" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New QC Checklist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Checklist Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Product ID</label><input class="erp-form-control" name="product_id" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Inspection Type</label><select class="erp-form-control" name="inspection_type"><option>Incoming</option><option>In-Process</option><option>Final</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Criteria / Notes</label><textarea class="erp-form-control" name="criteria" rows="3" placeholder="List inspection criteria…"></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Checklist
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/qc/qc-checklists';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.product_id||'')+'</td>'
        +'<td>'+(item.inspection_type||'')+'</td>'
        +'<td>'+(item.criteria||'—')+'</td>'
        +'<td><span class="badge-status '+(item.status==='Active'?'badge-active':'badge-inactive')+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Checklist" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalQC').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalQC');
    }
  });

  $('#modalQC').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalQC');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalQC', res.data);
        new bootstrap.Modal($('#modalQC')[0]).show();
      }
    });
  });

  $('#modalQC .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalQC');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Checklist updated','success'); bootstrap.Modal.getInstance($('#modalQC')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Checklist created','success'); bootstrap.Modal.getInstance($('#modalQC')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });
});
</script>
@endsection
