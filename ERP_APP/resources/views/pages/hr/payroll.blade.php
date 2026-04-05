@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Payroll</div><div class="page-subtitle">Monthly payroll processing and salary slips</div></div>
  <button class="btn-erp btn-primary" id="btn-run-payroll"><i class="bi bi-play-circle"></i> Run Payroll</button>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-3"><div class="kpi-tile blue"><div class="kpi-icon blue"><i class="bi bi-wallet2"></i></div><div class="kpi-value" id="kpi-total">$182K</div><div class="kpi-label">Total Payroll</div></div></div>
  <div class="col-md-3"><div class="kpi-tile green"><div class="kpi-icon green"><i class="bi bi-check-circle"></i></div><div class="kpi-value" id="kpi-processed">42</div><div class="kpi-label">Processed</div></div></div>
  <div class="col-md-3"><div class="kpi-tile yellow"><div class="kpi-icon yellow"><i class="bi bi-hourglass-split"></i></div><div class="kpi-value" id="kpi-pending">3</div><div class="kpi-label">Pending</div></div></div>
  <div class="col-md-3"><div class="kpi-tile red"><div class="kpi-icon red"><i class="bi bi-x-circle"></i></div><div class="kpi-value" id="kpi-failed">0</div><div class="kpi-label">Failed</div></div></div>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search" data-table="#tbl-payroll" type="text" placeholder="Search payroll…"/></div>
    <select class="erp-form-control" name="period" style="width:150px"><option>All Periods</option><option>January 2025</option><option>December 2024</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-payroll">
      <thead><tr><th>Employee</th><th>Period</th><th>Basic Salary</th><th>Deductions</th><th>Net Salary</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalPayroll" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Payroll Record</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formPayroll">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Employee ID</label><input class="erp-form-control" name="employee_id" type="text" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Period Start</label><input class="erp-form-control" name="period_start" type="date"/></div>
            <div class="col-md-3"><label class="erp-form-label">Period End</label><input class="erp-form-control" name="period_end" type="date"/></div>
            <div class="col-md-4"><label class="erp-form-label">Basic Salary</label><input class="erp-form-control" name="basic_salary" type="number" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Deductions</label><input class="erp-form-control" name="deductions" type="number" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Net Salary</label><input class="erp-form-control" name="net_salary" type="number" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Payment Method</label><select class="erp-form-control" name="payment_method"><option>Bank Transfer</option><option>Cash</option><option>Check</option></select></div>
            <div class="col-md-6"><label class="erp-form-label">Payment Date</label><input class="erp-form-control" name="payment_date" type="date"/></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-payroll">
          <i class="bi bi-check2"></i> Save
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  function loadTableData(){
    ErpApi.loadTable('#tbl-payroll', '/hr/payroll', function(item){
      var badgeClass = item.status === 'Paid' || item.status === 'Processed' || item.status === 'Completed' ? 'badge-active' : 'badge-pending';
      var actions = '<button class="btn-erp btn-outline btn-xs"><i class="bi bi-file-earmark-text"></i> Slip</button>';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.employee_name || item.employee_id ||'')+'</td>'
        +'<td>'+(item.period_start||'')+' – '+(item.period_end||'')+'</td>'
        +'<td>$'+Number(item.basic_salary||0).toLocaleString()+'</td>'
        +'<td>$'+Number(item.deductions||0).toLocaleString()+'</td>'
        +'<td>$'+Number(item.net_salary||0).toLocaleString()+'</td>'
        +'<td><span class="badge-status '+badgeClass+'">'+(item.status||'Pending')+'</span></td>'
        +'<td>'+actions+'</td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-save-payroll').on('click', function(){
    var data = ErpApi.collectForm('#formPayroll');
    ErpApi.post('/hr/payroll', data, function(res){
      if(res.success){
        showToast(res.message || 'Payroll record saved', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalPayroll')).hide();
        loadTableData();
      }
    });
  });

  $('#btn-run-payroll').on('click', function(){
    var start = $('[name="period_start"]').val();
    var end = $('[name="period_end"]').val();
    if(!start || !end){ showToast('Enter period start and end first', 'error'); return; }
    ErpApi.post('/hr/payroll/generate', { period_start: start, period_end: end }, function(res){
      if(res.success){
        showToast(res.message || 'Payroll generated', 'success');
        loadTableData();
      }
    });
  });
});
</script>
@endpush
