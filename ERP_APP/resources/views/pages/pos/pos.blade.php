@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">POS Terminals</div>
    <div class="page-subtitle">Point-of-sale terminal management and session tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-outline btn-daily-summary"><i class="bi bi-bar-chart"></i> Daily Summary</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPOS"><i class="bi bi-plus-lg"></i> Add Terminal</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search pos terminals…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Online</option><option>Offline</option><option>Closed</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Terminal Name</th><th>Location</th><th>Status</th><th>Last Sync</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalPOS" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add POS Terminal</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Terminal Name</label><input class="erp-form-control" name="terminal_name" type="text" placeholder="POS-XXX"/></div>
          <div class="col-md-6"><label class="erp-form-label">Location</label><input class="erp-form-control" name="location" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Online</option><option>Offline</option><option>Closed</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Last Sync</label><input class="erp-form-control" name="last_sync" type="datetime-local" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Terminal
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDailySummary" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Daily Summary</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="daily-summary-content">
        <p>Loading...</p>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/pos/pos';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      var badge = item.status==='Online'?'badge-active':(item.status==='Offline'?'badge-inactive':'badge-pending');
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.terminal_name||'')+'</td>'
        +'<td>'+(item.location||'')+'</td>'
        +'<td><span class="badge-status '+badge+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.last_sync||'—')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Terminal" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalPOS').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalPOS');
    }
  });

  $('#modalPOS').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalPOS');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalPOS', res.data);
        new bootstrap.Modal($('#modalPOS')[0]).show();
      }
    });
  });

  $('#modalPOS .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalPOS');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Terminal updated','success'); bootstrap.Modal.getInstance($('#modalPOS')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Terminal created','success'); bootstrap.Modal.getInstance($('#modalPOS')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-daily-summary', function(){
    ErpApi.get(baseUrl+'/daily-summary').then(function(res){
      if(res.success){
        var d = res.data;
        var html = '<div class="row g-3">';
        html += '<div class="col-md-3"><div class="erp-card p-3 text-center"><div style="font-size:1.5rem;font-weight:700">'+(d.total_sales||'$0')+'</div><div class="text-muted">Total Sales</div></div></div>';
        html += '<div class="col-md-3"><div class="erp-card p-3 text-center"><div style="font-size:1.5rem;font-weight:700">'+(d.total_transactions||'0')+'</div><div class="text-muted">Transactions</div></div></div>';
        html += '<div class="col-md-3"><div class="erp-card p-3 text-center"><div style="font-size:1.5rem;font-weight:700">'+(d.active_terminals||'0')+'</div><div class="text-muted">Active Terminals</div></div></div>';
        html += '<div class="col-md-3"><div class="erp-card p-3 text-center"><div style="font-size:1.5rem;font-weight:700">'+(d.avg_transaction||'$0')+'</div><div class="text-muted">Avg Transaction</div></div></div>';
        html += '</div>';
        $('#daily-summary-content').html(html);
        new bootstrap.Modal($('#modalDailySummary')[0]).show();
      } else {
        showToast(res.message||'Failed to load summary','error');
      }
    });
  });
});
</script>
@endsection
