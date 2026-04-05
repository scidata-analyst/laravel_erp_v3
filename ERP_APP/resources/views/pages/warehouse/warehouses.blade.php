@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Multi-Warehouse Management</div>
    <div class="page-subtitle">Manage multiple warehouse locations and capacity</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarehouse"><i class="bi bi-plus-lg"></i> Add Warehouse</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search multi-warehouse management…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Warehouse</th><th>Code</th><th>Location</th><th>Manager</th><th>Capacity</th><th>Used</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalWarehouse" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Warehouse</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Warehouse Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div>
          <div class="col-md-3"><label class="erp-form-label">Code</label><input class="erp-form-control" name="code" type="text" placeholder="WH-X"/></div>
          <div class="col-md-3"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Location / Address</label><input class="erp-form-control" name="location" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Manager</label><input class="erp-form-control" name="manager" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Capacity (units)</label><input class="erp-form-control" name="capacity" type="number" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Warehouse
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/warehouse/warehouses';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.code||'')+'</td>'
        +'<td>'+(item.location||'')+'</td>'
        +'<td>'+(item.manager||'—')+'</td>'
        +'<td>'+(item.capacity||'0')+' units</td>'
        +'<td>'+(item.used||'0')+' ('+(item.used_pct||'0')+'%)</td>'
        +'<td><span class="badge-status '+(item.status==='Active'?'badge-active':'badge-inactive')+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Warehouse" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalWarehouse').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalWarehouse');
    }
  });

  $('#modalWarehouse').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalWarehouse');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalWarehouse', res.data);
        new bootstrap.Modal($('#modalWarehouse')[0]).show();
      }
    });
  });

  $('#modalWarehouse .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalWarehouse');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Warehouse updated','success'); bootstrap.Modal.getInstance($('#modalWarehouse')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Warehouse created','success'); bootstrap.Modal.getInstance($('#modalWarehouse')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });
});
</script>
@endsection
