@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Resource Allocation</div>
    <div class="page-subtitle">Assign team members and assets to projects</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalResource" id="btnAddResource"><i class="bi bi-plus-lg"></i> Assign Resource</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search resource allocation…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option><option>Completed</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Name</th><th>Type</th><th>Project</th><th>Allocation %</th><th>Start Date</th><th>End Date</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalResource" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Assign Resource</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Project ID</label><input class="erp-form-control" name="project_id" type="text" placeholder="Project ID"/></div>
          <div class="col-md-6"><label class="erp-form-label">Resource Type</label><select class="erp-form-control" name="resource_type"><option value="Employee">Employee</option><option value="Contractor">Contractor</option><option value="Equipment">Equipment</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Name</label><input class="erp-form-control" name="name" type="text" placeholder="Resource name"/></div>
          <div class="col-md-6"><label class="erp-form-label">Allocation (%)</label><input class="erp-form-control" name="allocation" type="number" min="0" max="100" placeholder="0-100"/></div>
          <div class="col-md-6"><label class="erp-form-label">Start Date</label><input class="erp-form-control" name="start_date" type="date" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">End Date</label><input class="erp-form-control" name="end_date" type="date" placeholder=""/></div>
          <div class="col-md-12"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option><option value="Completed">Completed</option></select></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Assignment
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalAllocation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Update Allocation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-12"><label class="erp-form-label">Allocation (%)</label><input class="erp-form-control" name="allocation" type="number" min="0" max="100" placeholder="0-100"/></div>
          <div class="col-md-12"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Active">Active</option><option value="Inactive">Inactive</option><option value="Completed">Completed</option></select></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-allocation-save">
          <i class="bi bi-check2"></i> Update
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)">Are you sure you want to remove this resource assignment?</p>
        <input type="hidden" name="delete_id" value=""/>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">
          <i class="bi bi-trash"></i> Delete
        </button>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  var editingId = null;

  function renderRow(item) {
    var statusBadge = item.status === 'Active' ? 'badge-active' : (item.status === 'Completed' ? 'badge-info' : 'badge-inactive');
    var avail = 100 - (parseInt(item.allocation, 10) || 0);
    var availText = avail <= 0 ? 'Fully booked' : avail + '% free';

    return '<tr data-id="' + item.id + '">' +
      '<td>' + (item.name || '') + '</td>' +
      '<td>' + (item.resource_type || '') + '</td>' +
      '<td>' + (item.project_id || '') + '</td>' +
      '<td>' + (item.allocation || '0') + '%</td>' +
      '<td>' + (item.start_date || '') + '</td>' +
      '<td>' + (item.end_date || '') + '</td>' +
      '<td><span class="badge-status ' + statusBadge + '">' + (item.status || '') + '</span><br><small style="color:var(--text-muted)">' + availText + '</small></td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-allocation" title="Update Allocation"><i class="bi bi-graph-up"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/project/resources/' + item.id + '" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/project/resources', '#tbl-main tbody', renderRow, 'No resources found');
  };

  $(document).on('click', '#btnAddResource', function() {
    editingId = null;
    ErpApi.clearForm('#modalResource');
    $('#modalResource .modal-title').text('Assign Resource');
  });

  $(document).on('click', '.btn-edit', function() {
    var row = $(this).closest('tr');
    var id = row.data('id');
    editingId = id;
    ErpApi.get('/project/resources/' + id, function(res) {
      var item = res.data || res;
      ErpApi.populateForm('#modalResource', item);
      $('#modalResource input[name="id"]').val(item.id);
      $('#modalResource .modal-title').text('Edit Resource');
      new bootstrap.Modal(document.getElementById('modalResource')).show();
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalResource');
    if (editingId) {
      ErpApi.put('/project/resources/' + editingId, data, function(res) {
        showToast(res.message || 'Resource updated', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalResource')).hide();
        loadTableData();
      });
    } else {
      delete data.id;
      ErpApi.post('/project/resources', data, function(res) {
        showToast(res.message || 'Resource assigned', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalResource')).hide();
        loadTableData();
      });
    }
  });

  $(document).on('click', '.btn-allocation', function() {
    var id = $(this).closest('tr').data('id');
    $('#modalAllocation input[name="id"]').val(id);
    ErpApi.get('/project/resources/' + id, function(res) {
      var item = res.data || res;
      $('#modalAllocation input[name="allocation"]').val(item.allocation || 0);
      $('#modalAllocation select[name="status"]').val(item.status || 'Active');
      new bootstrap.Modal(document.getElementById('modalAllocation')).show();
    });
  });

  $(document).on('click', '.btn-allocation-save', function() {
    var id = $('#modalAllocation input[name="id"]').val();
    var data = {
      allocation: parseInt($('#modalAllocation input[name="allocation"]').val()) || 0
    };
    ErpApi.put('/project/resources/' + id + '/allocation', data, function(res) {
      showToast(res.message || 'Allocation updated', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalAllocation')).hide();
      loadTableData();
    });
  });

  $(document).on('click', '.btn-delete', function() {
    var deleteUrl = $(this).data('delete-url');
    $('#modalDelete input[name="delete_id"]').val(deleteUrl);
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
  });

  $(document).on('click', '.btn-confirm-delete', function() {
    var url = $('#modalDelete input[name="delete_id"]').val();
    ErpApi.del(url, function(res) {
      showToast(res.message || 'Resource removed', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
      loadTableData();
    });
  });

  loadTableData();
})();
</script>
@endsection
