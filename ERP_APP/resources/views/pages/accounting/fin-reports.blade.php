@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Financial Reports</div>
    <div class="page-subtitle">P&L, Balance Sheet and Cash Flow statements</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalFinReport" id="btnAddReport"><i class="bi bi-plus-lg"></i> Generate Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search financial reports…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>P&L</option><option>Balance Sheet</option><option>Cash Flow</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Report Name</th><th>Type</th><th>Period Start</th><th>Period End</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="tbl-reports-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalFinReport" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Generate Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Report Name</label><input class="erp-form-control" type="text" name="name" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Report Type</label><select class="erp-form-control" name="type"><option>Profit & Loss</option><option>Balance Sheet</option><option>Cash Flow</option><option>Trial Balance</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Period Start</label><input class="erp-form-control" type="date" name="period_start" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Period End</label><input class="erp-form-control" type="date" name="period_end" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Draft</option><option>Final</option><option>Archived</option></select></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Generate
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  function statusBadge(status) {
    var map = {'Draft':'badge-info','Final':'badge-active','Archived':'badge-inactive'};
    return '<span class="badge-status '+(map[status]||'badge-info')+'">'+status+'</span>';
  }

  function renderRow(item) {
    return '<tr data-id="'+item.id+'">'
      +'<td>'+item.name+'</td>'
      +'<td>'+item.type+'</td>'
      +'<td>'+item.period_start+'</td>'
      +'<td>'+item.period_end+'</td>'
      +'<td>'+statusBadge(item.status)+'</td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-success btn-xs btn-icon btn-view-report" data-id="'+item.id+'" title="View"><i class="bi bi-eye"></i></button>'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-report" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/accounting/fin-reports/'+item.id+'" data-delete-label="Report" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/accounting/fin-reports', '#tbl-reports-body', renderRow, 'No reports found');
  }

  loadTableData();

  $('#btnAddReport').on('click', function(){
    ErpApi.clearForm('#modalFinReport');
    $('#modalFinReport .modal-title').text('Generate Report');
  });

  $(document).on('click', '.btn-edit-report', function(){
    var id = $(this).data('id');
    ErpApi.get('/accounting/fin-reports/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalFinReport', res.data);
        $('#modalFinReport [name="id"]').val(id);
        $('#modalFinReport .modal-title').text('Edit Report');
        new bootstrap.Modal(document.getElementById('modalFinReport')).show();
      }
    });
  });

  $(document).on('click', '.btn-view-report', function(){
    var id = $(this).data('id');
    ErpApi.get('/accounting/fin-reports/'+id, {
      success: function(res){
        showToast('Report loaded: '+(res.data.name||'Report'),'info');
      }
    });
  });

  $('#modalFinReport .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalFinReport');
    var id = data.id;
    delete data.id;
    if (id) {
      ErpApi.put('/accounting/fin-reports/' + id, data, {
        success: function(res){ showToast(res.message || 'Report updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalFinReport')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to update report','danger'); }
      });
    } else {
      ErpApi.post('/accounting/fin-reports', data, {
        success: function(res){ showToast(res.message || 'Report generated','success'); bootstrap.Modal.getInstance(document.getElementById('modalFinReport')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to generate report','danger'); }
      });
    }
  });

  $(document).on('click', '[data-delete-url]', function(){
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label') || 'Item';
    if(confirm('Are you sure you want to delete this '+label+'?')) {
      ErpApi.del(url, {
        success: function(res){ showToast(res.message || label+' deleted','success'); loadTableData(); },
        error: function(){ showToast('Failed to delete '+label,'danger'); }
      });
    }
  });
});
</script>
@endsection
