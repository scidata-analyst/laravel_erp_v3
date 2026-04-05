@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">User Management</div><div class="page-subtitle">Create, manage and deactivate system users</div></div>
  <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser"><i class="bi bi-plus-lg"></i> Add User</button>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search" data-table="#tbl-users" type="text" placeholder="Search users..."/></div>
    <select class="erp-form-control" name="role" style="width:130px"><option>All Roles</option></select>
    <select class="erp-form-control" name="status" style="width:130px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-users">
      <thead><tr><th>#</th><th>Name</th><th>Email</th><th>Role</th><th>Department</th><th>Status</th><th>Last Login</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Full Name</label><input class="erp-form-control" name="name" type="text" placeholder="John Smith"/></div>
          <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" name="email" type="email" placeholder="john@company.com"/></div>
          <div class="col-md-6"><label class="erp-form-label">Role</label><select class="erp-form-control" name="role_id"><option value="">Select role</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Department</label><select class="erp-form-control" name="department_id"><option value="">None</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Password</label><input class="erp-form-control" name="password" type="password" placeholder="Enter password"/></div>
          <div class="col-md-6"><label class="erp-form-label">Confirm Password</label><input class="erp-form-control" name="password_confirmation" type="password" placeholder="Repeat password"/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="active">Active</option><option value="inactive">Inactive</option></select></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save User
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;
  var $roleSelect = $('#modalUser [name="role_id"]');

  function loadRoles() {
    ErpApi.get('/users/roles', {
      success: function(res) {
        var roles = res.data && res.data.data ? res.data.data : [];
        var currentRole = $roleSelect.val();
        $roleSelect.html('<option value="">Select role</option>');
        roles.forEach(function(role) {
          $roleSelect.append('<option value="' + role.id + '">' + (role.name || role.role_name || '') + '</option>');
        });
        if (currentRole) {
          $roleSelect.val(currentRole);
        }
      }
    });
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/users/users', '#tbl-users tbody', function(item) {
      var isInactive = String(item.status || '').toLowerCase() === 'inactive';
      var statusClass = isInactive ? 'badge-inactive' : 'badge-active';
      var statusText = isInactive ? 'Inactive' : 'Active';
      var roleClass = 'badge-info';
      var roleName = item.role || '';
      if (roleName === 'Admin') roleClass = 'badge-purple';
      else if (roleName === 'Staff') roleClass = 'badge-pending';
      var initials = (item.name || '').split(' ').map(function(w){ return w[0] || ''; }).join('').substring(0,2).toUpperCase();
      return '<tr>' +
        '<td>' + (item.id || '') + '</td>' +
        '<td><div class="d-flex align-items-center gap-2"><div class="avatar-sm" style="background:linear-gradient(135deg,var(--accent),var(--accent-5))">' + initials + '</div>' + (item.name || '') + '</div></td>' +
        '<td>' + (item.email || '') + '</td>' +
        '<td><span class="badge-status ' + roleClass + '">' + roleName + '</span></td>' +
        '<td>' + (item.department || '') + '</td>' +
        '<td><span class="badge-status ' + statusClass + '">' + statusText + '</span></td>' +
        '<td>' + (item.last_login_at || item.last_login || '') + '</td>' +
        '<td><div class="d-flex gap-1">' +
          '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalUser" title="Edit"><i class="bi bi-pencil"></i></button>' +
          '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="' + item.id + '" data-delete-url="/users/users/' + item.id + '" data-delete-label="User" title="Delete"><i class="bi bi-trash"></i></button>' +
        '</div></td></tr>';
    }, 'No users found');
  };

  loadTableData();
  loadRoles();

  $('#modalUser').on('show.bs.modal', function() {
    if (!editId) {
      ErpApi.clearForm('#modalUser');
    }
  });

  $('#modalUser').on('hidden.bs.modal', function() {
    editId = null;
    ErpApi.clearForm('#modalUser');
  });

  $(document).on('click', '.btn-edit', function() {
    editId = $(this).data('id');
    ErpApi.get('/users/users/' + editId, function(res) {
      if (res.success) {
        ErpApi.populateForm('#modalUser', res.data);
      }
    });
  });

  $('#modalUser .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalUser');
    if (!data.password) {
      delete data.password;
      delete data.password_confirmation;
    }
    if (!data.department_id) {
      delete data.department_id;
    }

    if (editId) {
      ErpApi.put('/users/users/' + editId, data, function(res) {
        if (res.success) {
          bootstrap.Modal.getInstance($('#modalUser')[0]).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/users/users', data, function(res) {
        if (res.success) {
          bootstrap.Modal.getInstance($('#modalUser')[0]).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function() {
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label');
    $('#modalDelete').data('delete-url', url).data('delete-label', label);
    new bootstrap.Modal($('#modalDelete')[0]).show();
  });
});
</script>
@endsection
