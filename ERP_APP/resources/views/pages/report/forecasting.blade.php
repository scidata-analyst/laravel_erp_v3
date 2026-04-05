@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Forecasting</div>
    <div class="page-subtitle">Demand forecasting and trend analysis using historical data</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalForecast"><i class="bi bi-plus-lg"></i> New Forecast</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search forecasting…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>Sales</option><option>Inventory</option><option>Revenue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Forecast Name</th><th>Type</th><th>Model</th><th>Period</th><th>Accuracy</th><th>Generated On</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalForecast" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Forecast</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Forecast Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Forecast Type</label><select class="erp-form-control" name="model_type"><option>Sales</option><option>Inventory</option><option>Revenue</option><option>Expense</option></select></div><div class="col-md-4"><label class="erp-form-label">Period From</label><input class="erp-form-control" name="period_from" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Period To</label><input class="erp-form-control" name="period_to" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Model</label><select class="erp-form-control" name="data_source"><option>Moving Average</option><option>Linear Regression</option><option>Exponential Smoothing</option></select></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Generate Forecast
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  window.loadTableData = function() {
    ErpApi.loadTable('/report/forecasting', '#tbl-main tbody', function(item) {
      var statusClass = (item.status === 'Archived') ? 'badge-inactive' : 'badge-active';
      var statusText = item.status || 'Active';
      return '<tr>' +
        '<td>' + (item.name||'') + '</td>' +
        '<td>' + (item.model_type||'') + '</td>' +
        '<td>' + (item.data_source||'') + '</td>' +
        '<td>' + (item.period||'') + '</td>' +
        '<td>' + (item.accuracy||'—') + '</td>' +
        '<td>' + (item.created_at||'') + '</td>' +
        '<td><span class="badge-status '+statusClass+'">'+statusText+'</span></td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalForecast" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-xs btn-icon btn-run" data-id="'+item.id+'" style="background:var(--accent-4);color:#fff" title="Run"><i class="bi bi-play-fill"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/report/forecasting/'+item.id+'" data-delete-label="Forecast" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalForecast').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalForecast');
    }
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/report/forecasting/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalForecast', res.data);
    });
  });

  $('#modalForecast .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalForecast');
    if (editId) {
      ErpApi.put('/report/forecasting/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Forecast updated', 'success'); bootstrap.Modal.getInstance($('#modalForecast')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/report/forecasting', data, function(res) {
        if (res.success) { showToast(res.message || 'Forecast created', 'success'); bootstrap.Modal.getInstance($('#modalForecast')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Create failed', 'error');
      });
    }
  });

  $(document).on('click', '.btn-run', function() {
    var id = $(this).data('id');
    ErpApi.post('/report/forecasting/' + id + '/run', {}, function(res) {
      if (res.success) { showToast(res.message || 'Forecast running', 'success'); loadTableData(); }
      else showToast(res.message || 'Run failed', 'error');
    });
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
