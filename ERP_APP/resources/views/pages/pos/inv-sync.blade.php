@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Inventory Sync</div><div class="page-subtitle">Monitor real-time inventory synchronization across all channels</div></div>
  <button class="btn-erp btn-primary btn-force-sync"><i class="bi bi-arrow-repeat"></i> Force Sync</button>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search" data-table="#tbl-invsync" type="text" placeholder="Search products…"/></div>
    <select class="erp-form-control" name="status" style="width:130px"><option>All Channels</option><option>Synced</option><option>Out of Sync</option><option>Error</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-invsync">
      <thead><tr><th>Channel ID</th><th>Sync Type</th><th>Status</th><th>Started At</th><th>Completed At</th><th>Records Synced</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalSync" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Sync Record</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Channel ID</label><input class="erp-form-control" name="channel_id" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Sync Type</label><input class="erp-form-control" name="sync_type" type="text" placeholder="e.g. Full, Incremental"/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Synced</option><option>Out of Sync</option><option>Error</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Records Synced</label><input class="erp-form-control" name="records_synced" type="number" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Started At</label><input class="erp-form-control" name="started_at" type="datetime-local" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Completed At</label><input class="erp-form-control" name="completed_at" type="datetime-local" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Sync
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/pos/inv-sync';

  var statusBadge = function(s){
    if(s==='Synced') return 'badge-active';
    if(s==='Out of Sync') return 'badge-pending';
    return 'badge-inactive';
  };

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-invsync tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.channel_id||'')+'</td>'
        +'<td>'+(item.sync_type||'')+'</td>'
        +'<td><span class="badge-status '+statusBadge(item.status)+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.started_at||'—')+'</td>'
        +'<td>'+(item.completed_at||'—')+'</td>'
        +'<td>'+(item.records_synced||'0')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Sync" title="Delete"><i class="bi bi-trash"></i></button>'
        +'<button class="btn-erp btn-success btn-xs btn-icon btn-complete" data-id="'+item.id+'" title="Mark Complete"><i class="bi bi-check-circle"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalSync').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalSync');
    }
  });

  $('#modalSync').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalSync');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalSync', res.data);
        new bootstrap.Modal($('#modalSync')[0]).show();
      }
    });
  });

  $('#modalSync .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalSync');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Sync updated','success'); bootstrap.Modal.getInstance($('#modalSync')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Sync created','success'); bootstrap.Modal.getInstance($('#modalSync')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-complete', function(){
    var id = $(this).data('id');
    if(confirm('Mark this sync as complete?')){
      ErpApi.post(baseUrl+'/'+id+'/complete', {}).then(function(res){
        if(res.success){ showToast(res.message||'Sync completed','success'); loadTableData(); }
        else{ showToast(res.message||'Complete failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-force-sync', function(){
    showToast('Force sync initiated...','info');
    loadTableData();
  });
});
</script>
@endsection
