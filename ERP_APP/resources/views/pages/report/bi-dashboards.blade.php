@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">BI Dashboards</div>
    <div class="page-subtitle">Custom BI dashboard widgets and visualization management</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBI"><i class="bi bi-plus-lg"></i> Add Widget</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search bi dashboards…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>Chart</option><option>KPI</option><option>Table</option><option>Map</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Widget Name</th><th>Type</th><th>Data Source</th><th>Refresh Rate</th><th>Dashboard</th><th>Created By</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalBI" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add BI Widget</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Widget Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Chart Type</label><select class="erp-form-control" name="widgets"><option>Bar Chart</option><option>Line Chart</option><option>Pie/Donut</option><option>KPI Tile</option><option>Table</option><option>Map</option></select></div><div class="col-md-6"><label class="erp-form-label">Data Source / Module</label><select class="erp-form-control" name="layout"><option>Sales</option><option>Finance</option><option>Inventory</option><option>HR</option><option>CRM</option></select></div><div class="col-md-3"><label class="erp-form-label">Refresh Rate</label><select class="erp-form-control" name="refresh_rate"><option>Real-time</option><option>Hourly</option><option>Daily</option></select></div><div class="col-md-3"><label class="erp-form-label">Dashboard</label><input class="erp-form-control" name="dashboard" type="text" placeholder="Dashboard name"/></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Add Widget
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  window.loadTableData = function() {
    ErpApi.loadTable('/report/bi-dashboards', '#tbl-main tbody', function(item) {
      var statusClass = (item.status === 'Inactive') ? 'badge-inactive' : 'badge-active';
      var statusText = item.status || 'Active';
      return '<tr>' +
        '<td>' + (item.name||'') + '</td>' +
        '<td>' + (item.widgets||'') + '</td>' +
        '<td>' + (item.layout||'') + '</td>' +
        '<td>' + (item.refresh_rate||'') + '</td>' +
        '<td>' + (item.dashboard||'') + '</td>' +
        '<td>' + (item.user_name||'') + '</td>' +
        '<td><span class="badge-status '+statusClass+'">'+statusText+'</span></td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalBI" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/report/bi-dashboards/'+item.id+'" data-delete-label="Widget" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalBI').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalBI');
    }
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/report/bi-dashboards/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalBI', res.data);
    });
  });

  $('#modalBI .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalBI');
    if (editId) {
      ErpApi.put('/report/bi-dashboards/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Widget updated', 'success'); bootstrap.Modal.getInstance($('#modalBI')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/report/bi-dashboards', data, function(res) {
        if (res.success) { showToast(res.message || 'Widget created', 'success'); bootstrap.Modal.getInstance($('#modalBI')[0]).hide(); loadTableData(); }
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
