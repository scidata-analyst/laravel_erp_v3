@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Custom Reports</div>
    <div class="page-subtitle">Build and schedule custom reports from any module</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCustomReport"><i class="bi bi-plus-lg"></i> Build Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search custom reports…"/>
    </div>
    <select class="erp-form-control" name="module" style="width:140px"><option>All Status</option><option>Sales</option><option>Inventory</option><option>Finance</option><option>HR</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Report Name</th><th>Module</th><th>Fields</th><th>Schedule</th><th>Last Run</th><th>Format</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalCustomReport" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Build Custom Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Report Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Module</label><select class="erp-form-control" name="type"><option>Sales</option><option>Purchase</option><option>Inventory</option><option>Finance</option><option>HR</option></select></div><div class="col-md-12"><label class="erp-form-label">Select Fields</label><input class="erp-form-control" name="query" type="text" placeholder="e.g. Customer Name, Order Date, Total Amount"/></div><div class="col-md-4"><label class="erp-form-label">Filter By</label><select class="erp-form-control" name="filter_by"><option>Date Range</option><option>Status</option><option>Department</option></select></div><div class="col-md-4"><label class="erp-form-label">Schedule</label><select class="erp-form-control" name="schedule"><option>Manual</option><option>Daily</option><option>Weekly</option><option>Monthly</option></select></div><div class="col-md-4"><label class="erp-form-label">Output Format</label><select class="erp-form-control" name="format"><option>PDF</option><option>Excel</option><option>Both</option></select></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Build Report
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  window.loadTableData = function() {
    ErpApi.loadTable('/report/custom-reports', '#tbl-main tbody', function(item) {
      var statusClass = (item.status === 'Inactive') ? 'badge-inactive' : 'badge-active';
      var statusText = item.status || 'Active';
      return '<tr>' +
        '<td>' + (item.name||'') + '</td>' +
        '<td>' + (item.type||'') + '</td>' +
        '<td>' + (item.query||'') + '</td>' +
        '<td>' + (item.schedule||'') + '</td>' +
        '<td>' + (item.last_run||'') + '</td>' +
        '<td>' + (item.format||'') + '</td>' +
        '<td><span class="badge-status '+statusClass+'">'+statusText+'</span></td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalCustomReport" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/report/custom-reports/'+item.id+'" data-delete-label="Build Report" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalCustomReport').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalCustomReport');
    }
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/report/custom-reports/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalCustomReport', res.data);
    });
  });

  $('#modalCustomReport .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalCustomReport');
    if (editId) {
      ErpApi.put('/report/custom-reports/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Report updated', 'success'); bootstrap.Modal.getInstance($('#modalCustomReport')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/report/custom-reports', data, function(res) {
        if (res.success) { showToast(res.message || 'Report created', 'success'); bootstrap.Modal.getInstance($('#modalCustomReport')[0]).hide(); loadTableData(); }
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
