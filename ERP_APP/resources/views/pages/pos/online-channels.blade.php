@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Online Sales Channels</div>
    <div class="page-subtitle">Manage e-commerce platform integrations and online sales</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-outline btn-load-active"><i class="bi bi-funnel"></i> Active Only</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalChannel"><i class="bi bi-plus-lg"></i> Add Channel</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search online sales channels…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Name</th><th>Platform</th><th>API Key</th><th>Status</th><th>Last Sync</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalChannel" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Sales Channel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Channel Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Platform</label><input class="erp-form-control" name="platform" type="text" placeholder="e.g. Shopify, WooCommerce"/></div>
          <div class="col-md-12"><label class="erp-form-label">API Key</label><input class="erp-form-control" name="api_key" type="password" placeholder="••••••••••••"/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Last Sync</label><input class="erp-form-control" name="last_sync" type="datetime-local" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Connect Channel
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/pos/online-channels';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.platform||'')+'</td>'
        +'<td>'+(item.api_key ? '••••••••' : '—')+'</td>'
        +'<td><span class="badge-status '+(item.status==='Active'?'badge-active':'badge-inactive')+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.last_sync||'—')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Channel" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalChannel').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalChannel');
    }
  });

  $('#modalChannel').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalChannel');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalChannel', res.data);
        new bootstrap.Modal($('#modalChannel')[0]).show();
      }
    });
  });

  $('#modalChannel .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalChannel');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Channel updated','success'); bootstrap.Modal.getInstance($('#modalChannel')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Channel connected','success'); bootstrap.Modal.getInstance($('#modalChannel')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-load-active', function(){
    ErpApi.get(baseUrl+'/active').then(function(res){
      if(res.success){
        var data = res.data.data || res.data;
        var items = Array.isArray(data) ? data : [data];
        var tbody = $('#tbl-main tbody').empty();
        items.forEach(function(item){
          tbody.append('<tr data-id="'+item.id+'">'
            +'<td>'+(item.name||'')+'</td>'
            +'<td>'+(item.platform||'')+'</td>'
            +'<td>'+(item.api_key ? '••••••••' : '—')+'</td>'
            +'<td><span class="badge-status '+(item.status==='Active'?'badge-active':'badge-inactive')+'">'+(item.status||'')+'</span></td>'
            +'<td>'+(item.last_sync||'—')+'</td>'
            +'<td><div class="d-flex gap-1">'
            +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
            +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Channel" title="Delete"><i class="bi bi-trash"></i></button>'
            +'</div></td></tr>');
        });
      }
    });
  });
});
</script>
@endsection
