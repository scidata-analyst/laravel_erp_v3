@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Discount Codes</div>
    <div class="page-subtitle">Manage discount codes and validate promotional codes</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDiscount"><i class="bi bi-plus-lg"></i> New Discount</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search discount codes…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Code</th><th>Name</th><th>Type</th><th>Value</th><th>Max Uses</th><th>Valid From</th><th>Valid To</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalDiscount" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Discount Code</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Discount Code</label><input class="erp-form-control" name="code" type="text" placeholder="DISCOUNT2025"/></div><div class="col-md-6"><label class="erp-form-label">Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Type</label><select class="erp-form-control" name="type"><option value="percentage">Percentage</option><option value="fixed">Fixed Amount</option></select></div><div class="col-md-4"><label class="erp-form-label">Value</label><input class="erp-form-control" name="value" type="number" step="0.01" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Max Uses</label><input class="erp-form-control" name="max_uses" type="number" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="active">Active</option><option value="inactive">Inactive</option><option value="expired">Expired</option></select></div><div class="col-md-6"><label class="erp-form-label">Valid From</label><input class="erp-form-control" name="valid_from" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Valid To</label><input class="erp-form-control" name="valid_to" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Description</label><input class="erp-form-control" name="description" type="text" placeholder=""/></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Discount
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)">Are you sure you want to delete this discount?</p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalValidate" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Validate Code</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)" id="validateResult"></p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
  var editingId = null;
  var deleteUrl = null;

  function statusBadge(status) {
    var map = {active:'badge-active', inactive:'badge-inactive', expired:'badge-pending'};
    var cls = map[status] || 'badge-pending';
    var label = status ? status.charAt(0).toUpperCase() + status.slice(1) : '';
    return '<span class="badge-status ' + cls + '">' + label + '</span>';
  }

  function renderRow(item) {
    var displayValue = item.type === 'percentage' ? item.value + '%' : '$' + Number(item.value || 0).toLocaleString();
    return '<tr>' +
      '<td>' + (item.code || '') + '</td>' +
      '<td>' + (item.name || '') + '</td>' +
      '<td>' + (item.type ? item.type.charAt(0).toUpperCase() + item.type.slice(1) : '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">' + displayValue + '</td>' +
      '<td>' + (item.max_uses || 'Unlimited') + '</td>' +
      '<td>' + (item.valid_from || '') + '</td>' +
      '<td>' + (item.valid_to || '') + '</td>' +
      '<td>' + statusBadge(item.status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-validate" data-code="' + (item.code || '') + '" title="Validate"><i class="bi bi-check2-square"></i></button>' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalDiscount" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/sales/discounts/' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/sales/discounts', '#tbl-main tbody', renderRow, '<tr><td colspan="9" class="text-center">No discount codes found</td></tr>');
  };

  loadTableData();

  $('#modalDiscount').on('show.bs.modal', function() {
    if (!editingId) {
      ErpApi.clearForm('#modalDiscount');
      $('#modalDiscount .modal-title').text('New Discount Code');
    }
  });

  $('#modalDiscount').on('hidden.bs.modal', function() { editingId = null; ErpApi.clearForm('#modalDiscount'); });

  $(document).on('click', '.btn-edit', function() {
    editingId = $(this).data('id');
    $('#modalDiscount .modal-title').text('Edit Discount Code');
    ErpApi.get('/sales/discounts/' + editingId, {
      success: function(res) { ErpApi.populateForm('#modalDiscount', res.data); }
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalDiscount');
    if (editingId) {
      ErpApi.put('/sales/discounts/' + editingId, data, {
        success: function(res) { showToast(res.message || 'Discount updated', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDiscount')).hide(); loadTableData(); },
        error: function() { showToast('Failed to update discount', 'danger'); }
      });
    } else {
      ErpApi.post('/sales/discounts', data, {
        success: function(res) { showToast(res.message || 'Discount created', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDiscount')).hide(); loadTableData(); },
        error: function() { showToast('Failed to create discount', 'danger'); }
      });
    }
  });

  $(document).on('click', '.btn-validate', function() {
    var code = $(this).data('code');
    ErpApi.post('/sales/discounts/validate-code', { code: code, amount: 0 }, {
      success: function(res) {
        $('#validateResult').text(res.message || 'Code is valid');
        new bootstrap.Modal(document.getElementById('modalValidate')).show();
      },
      error: function() {
        $('#validateResult').text('Code validation failed');
        new bootstrap.Modal(document.getElementById('modalValidate')).show();
      }
    });
  });

  $(document).on('click', '.btn-delete', function() { deleteUrl = $(this).data('delete-url'); });

  $(document).on('click', '.btn-confirm-delete', function() {
    if (!deleteUrl) return;
    ErpApi.del(deleteUrl, {
      success: function(res) { showToast(res.message || 'Discount deleted', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); loadTableData(); },
      error: function() { showToast('Failed to delete discount', 'danger'); }
    });
    deleteUrl = null;
  });
});
</script>
@endsection
