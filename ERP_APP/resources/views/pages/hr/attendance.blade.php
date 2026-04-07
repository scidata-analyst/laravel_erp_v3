@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Attendance & Leave</div>
    <div class="page-subtitle">Daily attendance records and leave request management</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-success" id="btn-checkin"><i class="bi bi-box-arrow-in-right"></i> Check In</button>
    <button class="btn-erp btn-warning" id="btn-checkout"><i class="bi bi-box-arrow-right"></i> Check Out</button>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalAttendance" id="btn-add-attendance"><i class="bi bi-plus-lg"></i> Log Attendance</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search attendance & leave…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Present</option><option>Absent</option><option>Late</option><option>Early Leave</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Employee</th><th>Date</th><th>Check In</th><th>Check Out</th><th>Status</th><th>Notes</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalAttendance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Attendance</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formAttendance">
          <input type="hidden" name="id" id="att-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Employee</label><select class="erp-form-control" name="employee_id" placeholder="Select employee"></select></div>
            <div class="col-md-6"><label class="erp-form-label">Date</label><input class="erp-form-control" name="date" type="date" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Check In</label><input class="erp-form-control" name="check_in" type="datetime-local" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Check Out</label><input class="erp-form-control" name="check_out" type="datetime-local" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Hours Worked</label><input class="erp-form-control" name="hours_worked" type="number" step="0.01" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Overtime</label><input class="erp-form-control" name="overtime_hours" type="number" step="0.01" placeholder="0"/></div>
            <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="present">Present</option><option value="absent">Absent</option><option value="late">Late</option><option value="leave">On Leave</option></select></div>
            <div class="col-md-6"><label class="erp-form-label">Leave Type</label><select class="erp-form-control" name="leave_type"><option value="">None</option><option value="annual">Annual</option><option value="sick">Sick</option><option value="casual">Casual</option></select></div>
            <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-attendance">
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
  var editId = null;

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/hr/attendance', function(item){
      var badgeClass = item.status === 'Present' ? 'badge-active' : (item.status === 'Absent' ? 'badge-inactive' : 'badge-pending');
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.employee_name || item.employee_id ||'')+'</td>'
        +'<td>'+(item.date||'')+'</td>'
        +'<td>'+(item.check_in||'—')+'</td>'
        +'<td>'+(item.check_out||'—')+'</td>'
        +'<td><span class="badge-status '+badgeClass+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.notes||'—')+'</td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalAttendance" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/hr/attendance/'+item.id+'" data-delete-label="Attendance" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-attendance').on('click', function(){
    editId = null;
    ErpApi.clearForm('#formAttendance');
    $('#modalAttendance .modal-title').text('Log Attendance');
  });

  $(document).on('click', '.btn-edit', function(){
    editId = $(this).data('id');
    ErpApi.get('/hr/attendance/'+editId, function(res){
      if(res.success){
        ErpApi.populateForm('#formAttendance', res.data);
        $('#modalAttendance .modal-title').text('Edit Attendance');
      }
    });
  });

  $('#btn-save-attendance').on('click', function(){
    var data = ErpApi.collectForm('#formAttendance');
    if(editId){
      ErpApi.put('/hr/attendance/'+editId, data, function(res){
        if(res.success){
          showToast(res.message || 'Attendance updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalAttendance')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/hr/attendance', data, function(res){
        if(res.success){
          showToast(res.message || 'Attendance logged', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalAttendance')).hide();
          loadTableData();
        }
      });
    }
  });

  $('#btn-checkin').on('click', function(){
    var employeeId = $('[name="employee_id"]').val();
    if(!employeeId){ showToast('Enter an employee ID first', 'error'); return; }
    ErpApi.post('/hr/attendance/check-in', { employee_id: employeeId }, function(res){
      if(res.success){
        showToast(res.message || 'Checked in successfully', 'success');
        loadTableData();
      }
    });
  });

  $('#btn-checkout').on('click', function(){
    var employeeId = $('[name="employee_id"]').val();
    if(!employeeId){ showToast('Enter an employee ID first', 'error'); return; }
    ErpApi.post('/hr/attendance/check-out', { employee_id: employeeId }, function(res){
      if(res.success){
        showToast(res.message || 'Checked out successfully', 'success');
        loadTableData();
      }
    });
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/hr/attendance/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Attendance deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
