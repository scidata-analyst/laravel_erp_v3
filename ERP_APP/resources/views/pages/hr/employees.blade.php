@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Employee Management</div><div class="page-subtitle">Staff directory, departments and contracts</div></div>
  <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalEmployee" id="btn-add-employee"><i class="bi bi-plus-lg"></i> Add Employee</button>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search" data-table="#tbl-emp" type="text" placeholder="Search employees…"/></div>
    <select class="erp-form-control" name="department" style="width:130px"><option>All Depts</option><option>IT</option><option>Sales</option><option>HR</option><option>Finance</option><option>Warehouse</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-emp">
      <thead><tr><th>#</th><th>Name</th><th>Position</th><th>Department</th><th>Phone</th><th>Join Date</th><th>Salary</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"><button class="pg-btn active">1</button><button class="pg-btn">2</button><button class="pg-btn">3</button></div>
</div>

<div class="modal fade" id="modalEmployee" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Employee</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEmployee">
          <input type="hidden" name="id" id="emp-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Full Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Employee ID</label><input class="erp-form-control" name="employee_id" type="text" placeholder="EMP-XXX"/></div>
            <div class="col-md-6"><label class="erp-form-label">Position / Designation</label><input class="erp-form-control" name="position" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Department</label><select class="erp-form-control" name="department"><option>IT</option><option>Sales</option><option>HR</option><option>Finance</option><option>Warehouse</option></select></div>
            <div class="col-md-4"><label class="erp-form-label">Basic Salary ($)</label><input class="erp-form-control" name="salary" type="number" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Join Date</label><input class="erp-form-control" name="join_date" type="date" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Contract Type</label><select class="erp-form-control" name="contract_type"><option>Permanent</option><option>Contract</option><option>Intern</option></select></div>
            <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" name="email" type="email" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" name="phone" type="text" placeholder=""/></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-employee">
          <i class="bi bi-check2"></i> Save Employee
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
    ErpApi.loadTable('#tbl-emp', '/hr/employees', function(item){
      var initials = (item.name||'').split(' ').map(function(w){return w[0];}).join('').substring(0,2).toUpperCase();
      var colors = ['var(--accent)','var(--accent-2)','var(--accent-4)','var(--accent-5)'];
      var c = colors[Math.floor(Math.random()*colors.length)];
      var badgeClass = item.status === 'Active' ? 'badge-active' : 'badge-pending';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.employee_id||'')+'</td>'
        +'<td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,'+c+',#007a60)">'+initials+'</div>'+(item.name||'')+'</div></td>'
        +'<td>'+(item.position||'')+'</td>'
        +'<td>'+(item.department||'')+'</td>'
        +'<td>'+(item.phone||'')+'</td>'
        +'<td>'+(item.join_date||'')+'</td>'
        +'<td>$'+Number(item.salary||0).toLocaleString()+'</td>'
        +'<td><span class="badge-status '+badgeClass+'">'+(item.status||'Active')+'</span></td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalEmployee" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/hr/employees/'+item.id+'" data-delete-label="Employee" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-employee').on('click', function(){
    editId = null;
    ErpApi.clearForm('#formEmployee');
    $('#modalEmployee .modal-title').text('Add / Edit Employee');
  });

  $(document).on('click', '.btn-edit', function(){
    editId = $(this).data('id');
    ErpApi.get('/hr/employees/'+editId, function(res){
      if(res.success){
        ErpApi.populateForm('#formEmployee', res.data);
        $('#modalEmployee .modal-title').text('Edit Employee');
      }
    });
  });

  $('#btn-save-employee').on('click', function(){
    var data = ErpApi.collectForm('#formEmployee');
    if(editId){
      ErpApi.put('/hr/employees/'+editId, data, function(res){
        if(res.success){
          showToast(res.message || 'Employee updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalEmployee')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/hr/employees', data, function(res){
        if(res.success){
          showToast(res.message || 'Employee created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalEmployee')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/hr/employees/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Employee deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
