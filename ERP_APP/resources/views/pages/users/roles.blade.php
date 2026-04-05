@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Roles &amp; Permissions</div><div class="page-subtitle">Assign granular access control per role</div></div>
  <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-plus-lg"></i> Add Role</button>
</div>
<div class="row g-3">
  <div class="col-md-4">
    <div class="erp-card">
      <div class="card-header-bar"><div class="card-title">Roles</div></div>
      <div class="table-toolbar">
        <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input id="roles-search" type="text" placeholder="Search roles..."/></div>
        <select class="erp-form-control" id="roles-user-filter" style="width:130px">
          <option value="">All Sizes</option>
          <option value="0">No Users</option>
          <option value="1">Has Users</option>
        </select>
        <select class="erp-form-control" id="roles-per-page" style="width:90px">
          <option value="5">5</option>
          <option value="10" selected>10</option>
          <option value="20">20</option>
        </select>
      </div>
      <div id="roles-list"></div>
      <div class="erp-pagination" id="roles-pagination"></div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="erp-card">
      <div class="card-header-bar">
        <div class="card-title" id="perm-title">Permissions — Admin</div>
        <button class="btn-erp btn-primary btn-sm btn-save-perms"><i class="bi bi-check2"></i> Save</button>
      </div>
      <div class="perm-grid">
        <div class="pg-header">Module</div><div class="pg-header">View</div><div class="pg-header">Create</div><div class="pg-header">Edit</div><div class="pg-header">Delete</div>
        <div class="perm-row"><div>Inventory</div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div></div>
        <div class="perm-row"><div>Purchase</div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check"></div></div></div>
        <div class="perm-row"><div>Sales</div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check"></div></div><div><div class="perm-check"></div></div></div>
        <div class="perm-row"><div>Accounting</div><div><div class="perm-check on"></div></div><div><div class="perm-check"></div></div><div><div class="perm-check"></div></div><div><div class="perm-check"></div></div></div>
        <div class="perm-row"><div>HR</div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div></div>
        <div class="perm-row"><div>Reports</div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div><div><div class="perm-check on"></div></div></div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalRole" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Role</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-12"><label class="erp-form-label">Role Name</label><input class="erp-form-control" name="name" type="text" placeholder="e.g. Procurement Officer"/></div><div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="3" placeholder="Describe the role responsibilities…"></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Create Role
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;
  var selectedRoleId = null;
  var allRoles = [];
  var currentPage = 1;

  function getFilteredRoles() {
    var search = ($('#roles-search').val() || '').toLowerCase().trim();
    var userFilter = $('#roles-user-filter').val();
    return allRoles.filter(function(role) {
      var haystack = JSON.stringify(role || {}).toLowerCase();
      var userCount = Number(role.user_count || 0);
      if (search && haystack.indexOf(search) === -1) return false;
      if (userFilter === '0' && userCount !== 0) return false;
      if (userFilter === '1' && userCount < 1) return false;
      return true;
    });
  }

  function renderPagination(totalItems) {
    var perPage = parseInt($('#roles-per-page').val(), 10) || 10;
    var totalPages = Math.max(1, Math.ceil(totalItems / perPage));
    if (currentPage > totalPages) currentPage = totalPages;
    if (totalPages <= 1) {
      $('#roles-pagination').empty();
      return;
    }

    var html = '';
    if (currentPage > 1) {
      html += '<button class="pg-btn" data-page="' + (currentPage - 1) + '"><i class="bi bi-chevron-left"></i></button>';
    }
    for (var i = 1; i <= totalPages; i++) {
      html += '<button class="pg-btn' + (i === currentPage ? ' active' : '') + '" data-page="' + i + '">' + i + '</button>';
    }
    if (currentPage < totalPages) {
      html += '<button class="pg-btn" data-page="' + (currentPage + 1) + '"><i class="bi bi-chevron-right"></i></button>';
    }
    $('#roles-pagination').html(html);
  }

  function renderRoles(roles) {
    var perPage = parseInt($('#roles-per-page').val(), 10) || 10;
    var start = (currentPage - 1) * perPage;
    var pageItems = roles.slice(start, start + perPage);
    var html = '';
    pageItems.forEach(function(role) {
      html += '<div class="stat-row btn-role-select" style="cursor:pointer;padding:10px 8px" data-id="'+role.id+'" data-name="'+(role.name||'')+'">' +
        '<div class="stat-row-label"><i class="bi bi-shield-fill-check text-accent me-2"></i>'+(role.name||'')+'</div>' +
        '<span class="badge-status badge-info">'+(role.user_count||0)+' users</span></div>';
    });
    if (!html) {
      html = '<div style="padding:24px;text-align:center;color:var(--text-secondary)">No roles found</div>';
    }
    $('#roles-list').html(html);
    renderPagination(roles.length);
  }

  window.loadTableData = function() {
    ErpApi.get('/users/roles', function(res) {
      if (res.success && res.data && res.data.data) {
        allRoles = res.data.data;
        currentPage = 1;
        renderRoles(getFilteredRoles());
      }
    });
  };

  loadTableData();

  $(document).on('click', '.btn-role-select', function() {
    selectedRoleId = $(this).data('id');
    var name = $(this).data('name');
    $('#perm-title').text('Permissions — ' + name);
    ErpApi.get('/users/roles/' + selectedRoleId, function(res) {
      if (res.success && res.data && res.data.permissions) {
        $('.perm-row').each(function() {
          var module = $(this).find('div:first').text().toLowerCase();
          var perms = res.data.permissions[module] || {};
          var checks = $(this).find('.perm-check');
          checks.eq(0).toggleClass('on', !!perms.view);
          checks.eq(1).toggleClass('on', !!perms.create);
          checks.eq(2).toggleClass('on', !!perms.edit);
          checks.eq(3).toggleClass('on', !!perms.del);
        });
      }
    });
  });

  $('#modalRole').on('show.bs.modal', function() {
    editId = null;
    ErpApi.clearForm('#modalRole');
  });

  $(document).on('click', '.btn-edit', function() {
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/users/roles/' + id, function(res) {
      if (res.success) ErpApi.populateForm('#modalRole', res.data);
    });
  });

  $('#modalRole .btn-modal-save').on('click', function() {
    var data = ErpApi.collectForm('#modalRole');
    if (editId) {
      ErpApi.put('/users/roles/' + editId, data, function(res) {
        if (res.success) { showToast(res.message || 'Role updated', 'success'); bootstrap.Modal.getInstance($('#modalRole')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Update failed', 'error');
      });
    } else {
      ErpApi.post('/users/roles', data, function(res) {
        if (res.success) { showToast(res.message || 'Role created', 'success'); bootstrap.Modal.getInstance($('#modalRole')[0]).hide(); loadTableData(); }
        else showToast(res.message || 'Create failed', 'error');
      });
    }
  });

  $('.btn-save-perms').on('click', function() {
    if (!selectedRoleId) { showToast('Select a role first', 'error'); return; }
    var permissions = {};
    $('.perm-row').each(function() {
      var module = $(this).find('div:first').text().toLowerCase();
      var checks = $(this).find('.perm-check');
      permissions[module] = {
        view: checks.eq(0).hasClass('on'),
        create: checks.eq(1).hasClass('on'),
        edit: checks.eq(2).hasClass('on'),
        del: checks.eq(3).hasClass('on')
      };
    });
    ErpApi.put('/users/roles/' + selectedRoleId, { permissions: permissions }, function(res) {
      if (res.success) showToast(res.message || 'Permissions saved', 'success');
      else showToast(res.message || 'Save failed', 'error');
    });
  });

  $(document).on('click', '.perm-check', function() {
    $(this).toggleClass('on');
  });

  $('#roles-search, #roles-user-filter, #roles-per-page').on('input change', function() {
    currentPage = 1;
    renderRoles(getFilteredRoles());
  });

  $(document).on('click', '#roles-pagination .pg-btn', function() {
    var page = parseInt($(this).data('page'), 10);
    if (!page) return;
    currentPage = page;
    renderRoles(getFilteredRoles());
  });
});
</script>
@endsection
