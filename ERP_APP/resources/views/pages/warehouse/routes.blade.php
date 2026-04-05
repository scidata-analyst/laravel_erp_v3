@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Routes & Delivery</div>
    <div class="page-subtitle">Define delivery routes and optimize last-mile logistics</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalRoute"><i class="bi bi-plus-lg"></i> New Route</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search routes & delivery…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Route Name</th><th>Origin</th><th>Destination</th><th>Distance</th><th>Est. Time</th><th>Cost</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalRoute" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Delivery Route</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Route Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Origin</label><input class="erp-form-control" name="origin" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Destination</label><input class="erp-form-control" name="destination" type="text" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Distance (km)</label><input class="erp-form-control" name="distance" type="number" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Estimated Time</label><input class="erp-form-control" name="estimated_time" type="text" placeholder="e.g. 2.5 hrs"/></div>
          <div class="col-md-4"><label class="erp-form-label">Cost</label><input class="erp-form-control" name="cost" type="number" placeholder="" step="0.01"/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Route
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/warehouse/routes';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.origin||'')+'</td>'
        +'<td>'+(item.destination||'')+'</td>'
        +'<td>'+(item.distance||'0')+' km</td>'
        +'<td>'+(item.estimated_time||'—')+'</td>'
        +'<td>'+(item.cost||'0')+'</td>'
        +'<td><span class="badge-status '+(item.status==='Active'?'badge-active':'badge-inactive')+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Route" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalRoute').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalRoute');
    }
  });

  $('#modalRoute').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalRoute');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalRoute', res.data);
        new bootstrap.Modal($('#modalRoute')[0]).show();
      }
    });
  });

  $('#modalRoute .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalRoute');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Route updated','success'); bootstrap.Modal.getInstance($('#modalRoute')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Route created','success'); bootstrap.Modal.getInstance($('#modalRoute')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });
});
</script>
@endsection
