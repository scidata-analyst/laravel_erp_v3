@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Defect Tracking</div>
    <div class="page-subtitle">Log, track and resolve product defects and non-conformances</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefect"><i class="bi bi-plus-lg"></i> Log Defect</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search defect tracking…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Open</option><option>In Review</option><option>Resolved</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Product ID</th><th>Defect Type</th><th>Severity</th><th>Description</th><th>Status</th><th>Resolution</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalDefect" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Defect</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Product ID</label><input class="erp-form-control" name="product_id" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Defect Type</label><input class="erp-form-control" name="defect_type" type="text" placeholder="e.g. Dimensional Error"/></div>
          <div class="col-md-4"><label class="erp-form-label">Severity</label><select class="erp-form-control" name="severity"><option>Low</option><option>Medium</option><option>High</option><option>Critical</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Open</option><option>In Review</option><option>Resolved</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Resolution</label><input class="erp-form-control" name="resolution" type="text" placeholder=""/></div>
          <div class="col-md-12"><label class="erp-form-label">Description / Root Cause</label><textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Log Defect
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/qc/defects';

  var severityBadge = function(s){
    if(s==='Critical') return 'badge-inactive';
    if(s==='High') return 'badge-pending';
    return 'badge-active';
  };

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.product_id||'')+'</td>'
        +'<td>'+(item.defect_type||'')+'</td>'
        +'<td><span class="badge-status '+severityBadge(item.severity)+'">'+(item.severity||'')+'</span></td>'
        +'<td>'+(item.description||'—')+'</td>'
        +'<td><span class="badge-status '+(item.status==='Resolved'?'badge-active':'badge-pending')+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.resolution||'—')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Defect" title="Delete"><i class="bi bi-trash"></i></button>'
        +'<button class="btn-erp btn-success btn-xs btn-icon btn-resolve" data-id="'+item.id+'" title="Resolve"><i class="bi bi-check-circle"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalDefect').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalDefect');
    }
  });

  $('#modalDefect').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalDefect');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalDefect', res.data);
        new bootstrap.Modal($('#modalDefect')[0]).show();
      }
    });
  });

  $('#modalDefect .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalDefect');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Defect updated','success'); bootstrap.Modal.getInstance($('#modalDefect')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Defect logged','success'); bootstrap.Modal.getInstance($('#modalDefect')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-resolve', function(){
    var id = $(this).data('id');
    var resolution = prompt('Enter resolution notes:');
    if(resolution !== null){
      ErpApi.post(baseUrl+'/'+id+'/resolve', {resolution: resolution}).then(function(res){
        if(res.success){ showToast(res.message||'Defect resolved','success'); loadTableData(); }
        else{ showToast(res.message||'Resolve failed','error'); }
      });
    }
  });
});
</script>
@endsection
