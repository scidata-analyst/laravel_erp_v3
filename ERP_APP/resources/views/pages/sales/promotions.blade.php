@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Discounts & Promotions</div>
    <div class="page-subtitle">Create and manage discount rules and promotional campaigns</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPromo"><i class="bi bi-plus-lg"></i> New Promotion</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search discounts & promotions…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Scheduled</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Promo Code</th><th>Name</th><th>Value</th><th>Type</th><th>Valid From</th><th>Valid To</th><th>Min Order</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalPromo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Promotion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Promo Code</label><input class="erp-form-control" name="code" type="text" placeholder="PROMO2025"/></div><div class="col-md-6"><label class="erp-form-label">Name</label><input class="erp-form-control" name="name" type="text" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Discount Value</label><input class="erp-form-control" name="value" type="number" step="0.01" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Type</label><select class="erp-form-control" name="type"><option value="percentage">Percentage</option><option value="fixed">Fixed Amount</option></select></div><div class="col-md-4"><label class="erp-form-label">Min. Order ($)</label><input class="erp-form-control" name="min_order_amount" type="number" step="0.01" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Valid From</label><input class="erp-form-control" name="start_date" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Valid To</label><input class="erp-form-control" name="end_date" type="date" placeholder=""/></div><div class="col-md-12"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="active">Active</option><option value="scheduled">Scheduled</option><option value="expired">Expired</option></select></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Promotion
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
        <p style="color:var(--text-secondary)">Are you sure you want to delete this promotion?</p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">Delete</button>
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
    var map = {active:'badge-active', scheduled:'badge-pending', expired:'badge-inactive'};
    var cls = map[status] || 'badge-pending';
    var label = status ? status.charAt(0).toUpperCase() + status.slice(1) : '';
    return '<span class="badge-status ' + cls + '">' + label + '</span>';
  }

  function renderRow(item) {
    var displayValue = item.type === 'percentage' ? item.value + '%' : '$' + Number(item.value || 0).toLocaleString();
    return '<tr>' +
      '<td>' + (item.code || '') + '</td>' +
      '<td>' + (item.name || '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">' + displayValue + '</td>' +
      '<td>' + (item.type ? item.type.charAt(0).toUpperCase() + item.type.slice(1) : '') + '</td>' +
      '<td>' + (item.start_date || '') + '</td>' +
      '<td>' + (item.end_date || '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">$' + Number(item.min_order_amount || 0).toLocaleString() + '</td>' +
      '<td>' + statusBadge(item.status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalPromo" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/sales/promotions/' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/sales/promotions', '#tbl-main tbody', renderRow, '<tr><td colspan="9" class="text-center">No promotions found</td></tr>');
  };

  loadTableData();

  $('#modalPromo').on('show.bs.modal', function() {
    if (!editingId) {
      ErpApi.clearForm('#modalPromo');
      $('#modalPromo .modal-title').text('New Promotion');
    }
  });

  $('#modalPromo').on('hidden.bs.modal', function() { editingId = null; ErpApi.clearForm('#modalPromo'); });

  $(document).on('click', '.btn-edit', function() {
    editingId = $(this).data('id');
    $('#modalPromo .modal-title').text('Edit Promotion');
    ErpApi.get('/sales/promotions/' + editingId, {
      success: function(res) { ErpApi.populateForm('#modalPromo', res.data); }
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalPromo');
    if (editingId) {
      ErpApi.put('/sales/promotions/' + editingId, data, {
        success: function(res) { showToast(res.message || 'Promotion updated', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalPromo')).hide(); loadTableData(); },
        error: function() { showToast('Failed to update promotion', 'danger'); }
      });
    } else {
      ErpApi.post('/sales/promotions', data, {
        success: function(res) { showToast(res.message || 'Promotion created', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalPromo')).hide(); loadTableData(); },
        error: function() { showToast('Failed to create promotion', 'danger'); }
      });
    }
  });

  $(document).on('click', '.btn-delete', function() { deleteUrl = $(this).data('delete-url'); });

  $(document).on('click', '.btn-confirm-delete', function() {
    if (!deleteUrl) return;
    ErpApi.del(deleteUrl, {
      success: function(res) { showToast(res.message || 'Promotion deleted', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); loadTableData(); },
      error: function() { showToast('Failed to delete promotion', 'danger'); }
    });
    deleteUrl = null;
  });
});
</script>
@endsection
