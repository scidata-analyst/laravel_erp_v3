@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Project Cost Tracking</div>
    <div class="page-subtitle">Monitor budgets, expenses and cost variance per project</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProjectCost" id="btnAddCost"><i class="bi bi-plus-lg"></i> Log Cost</button>
  </div>
</div>

<div class="row g-3 mb-4" id="cost-summary">
  <div class="col-md-4">
    <div class="kpi-tile blue">
      <div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div>
      <div class="kpi-value" id="summary-total">$0</div>
      <div class="kpi-label">Total Budget</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile yellow">
      <div class="kpi-icon yellow"><i class="bi bi-receipt"></i></div>
      <div class="kpi-value" id="summary-spent">$0</div>
      <div class="kpi-label">Total Spent</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile green">
      <div class="kpi-icon green"><i class="bi bi-wallet2"></i></div>
      <div class="kpi-value" id="summary-remaining">$0</div>
      <div class="kpi-label">Remaining</div>
    </div>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search project cost tracking…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>On Budget</option><option>Over Budget</option><option>Under Budget</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Project</th><th>Category</th><th>Description</th><th>Amount</th><th>Date</th><th>Status</th><th>Approved By</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalProjectCost" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Project Cost</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Project ID</label><input class="erp-form-control" name="project_id" type="text" placeholder="Project ID"/></div>
          <div class="col-md-6"><label class="erp-form-label">Cost Category</label><select class="erp-form-control" name="category"><option value="Labor">Labor</option><option value="Material">Material</option><option value="Overhead">Overhead</option><option value="Software License">Software License</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" name="amount" type="number" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Date Incurred</label><input class="erp-form-control" name="date" type="date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Pending">Pending</option><option value="Approved">Approved</option><option value="Rejected">Rejected</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Approved By</label><input class="erp-form-control" name="approved_by" type="text" placeholder="Approver name"/></div>
          <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Log Cost
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalApprove" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Approve Cost</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="approve_id" value=""/>
        <div class="row g-3">
          <div class="col-md-12"><label class="erp-form-label">Approved By</label><input class="erp-form-control" name="approved_by" type="text" placeholder="Your name"/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-approve-save">
          <i class="bi bi-check2"></i> Approve
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
        <p style="color:var(--text-secondary)">Are you sure you want to delete this cost entry?</p>
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
    var statusBadge = item.status === 'Approved' ? 'badge-active' : (item.status === 'Rejected' ? 'badge-inactive' : 'badge-pending');
    return '<tr data-id="' + item.id + '">' +
      '<td>' + (item.project_id || '') + '</td>' +
      '<td>' + (item.category || '') + '</td>' +
      '<td>' + (item.description || '') + '</td>' +
      '<td>$' + (item.amount || '0') + '</td>' +
      '<td>' + (item.date || '') + '</td>' +
      '<td><span class="badge-status ' + statusBadge + '">' + (item.status || '') + '</span></td>' +
      '<td>' + (item.approved_by || '-') + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" title="Edit"><i class="bi bi-pencil"></i></button>' +
        (item.status !== 'Approved' ? '<button class="btn-erp btn-outline btn-xs btn-icon btn-approve" title="Approve"><i class="bi bi-check-lg"></i></button>' : '') +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/project/project-cost/' + item.id + '" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  function loadSummary() {
    ErpApi.get('/project/project-cost/summary/0', function(res) {
      var data = res.data || res;
      var totalBudget = Number(data.total_budget || data.total_budgeted || data.total || 0);
      var totalSpent = Number(data.total_spent || data.total_actual || data.spent || 0);
      var remaining = Number(data.remaining || (totalBudget - totalSpent));
      $('#summary-total').text('$' + totalBudget.toLocaleString());
      $('#summary-spent').text('$' + totalSpent.toLocaleString());
      $('#summary-remaining').text('$' + remaining.toLocaleString());
    });
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/project/project-cost', '#tbl-main tbody', renderRow, 'No cost entries found');
    loadSummary();
  };

  $(document).on('click', '#btnAddCost', function() {
    editingId = null;
    ErpApi.clearForm('#modalProjectCost');
    $('#modalProjectCost .modal-title').text('Log Project Cost');
  });

  $(document).on('click', '.btn-edit', function() {
    var row = $(this).closest('tr');
    var id = row.data('id');
    editingId = id;
    ErpApi.get('/project/project-cost/' + id, function(res) {
      var item = res.data || res;
      ErpApi.populateForm('#modalProjectCost', item);
      $('#modalProjectCost input[name="id"]').val(item.id);
      $('#modalProjectCost .modal-title').text('Edit Cost');
      new bootstrap.Modal(document.getElementById('modalProjectCost')).show();
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalProjectCost');
    if (editingId) {
      ErpApi.put('/project/project-cost/' + editingId, data, function(res) {
        showToast(res.message || 'Cost updated', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalProjectCost')).hide();
        loadTableData();
      });
    } else {
      delete data.id;
      ErpApi.post('/project/project-cost', data, function(res) {
        showToast(res.message || 'Cost logged', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalProjectCost')).hide();
        loadTableData();
      });
    }
  });

  $(document).on('click', '.btn-approve', function() {
    var id = $(this).closest('tr').data('id');
    $('#modalApprove input[name="approve_id"]').val(id);
    $('#modalApprove input[name="approved_by"]').val('');
    new bootstrap.Modal(document.getElementById('modalApprove')).show();
  });

  $(document).on('click', '.btn-approve-save', function() {
    var id = $('#modalApprove input[name="approve_id"]').val();
    ErpApi.post('/project/project-cost/' + id + '/approve', {}, function(res) {
      showToast(res.message || 'Cost approved', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalApprove')).hide();
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
      showToast(res.message || 'Cost deleted', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
      loadTableData();
    });
  });

  loadTableData();
})();
</script>
@endsection
