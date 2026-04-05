@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Sales Orders</div>
    <div class="page-subtitle">Track and manage all sales orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSO"><i class="bi bi-plus-lg"></i> New Order</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search sales orders…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Pending</option><option>Confirmed</option><option>Dispatched</option><option>Delivered</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>SO #</th><th>Customer</th><th>Date</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalSO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Sales Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

      <div class="row g-3 mb-3">
        <div class="col-md-6"><label class="erp-form-label">Customer</label><select class="erp-form-control" name="customer_id"><option value="">Select customer…</option></select></div>
        <div class="col-md-3"><label class="erp-form-label">Order Date</label><input class="erp-form-control" name="order_date" type="date" placeholder=""/></div>
        <div class="col-md-3"><label class="erp-form-label">Total Amount ($)</label><input class="erp-form-control" name="total_amount" type="number" step="0.01" placeholder=""/></div>
        <div class="col-md-6"><label class="erp-form-label">Delivery Date</label><input class="erp-form-control" name="delivery_date" type="date" placeholder=""/></div>
        <div class="col-md-6"><label class="erp-form-label">Payment Terms</label><select class="erp-form-control" name="payment_terms"><option value="Net 30">Net 30</option><option value="Due on Receipt">Due on Receipt</option></select></div>
        <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="draft">Draft</option><option value="confirmed">Confirmed</option><option value="shipped">Shipped</option><option value="delivered">Delivered</option></select></div>
        <div class="col-md-12"><label class="erp-form-label">Notes</label><input class="erp-form-control" name="notes" type="text" placeholder=""/></div>
      </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Confirm Order
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Confirm Cancel</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)">Are you sure you want to cancel this order?</p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">No</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">Yes, Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalStatus" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Update Status</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <label class="erp-form-label">New Status</label>
        <select class="erp-form-control" id="statusSelect">
          <option value="draft">Draft</option>
          <option value="confirmed">Confirmed</option>
          <option value="shipped">Shipped</option>
          <option value="delivered">Delivered</option>
        </select>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-confirm-status">Update</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
  var editingId = null;
  var cancelUrl = null;
  var statusOrderId = null;

  function statusBadge(status) {
    var map = {delivered:'badge-active', shipped:'badge-info', confirmed:'badge-active', draft:'badge-pending', cancelled:'badge-inactive'};
    var cls = map[status] || 'badge-pending';
    var label = status ? status.charAt(0).toUpperCase() + status.slice(1) : '';
    return '<span class="badge-status ' + cls + '">' + label + '</span>';
  }

  function renderRow(item) {
    return '<tr>' +
      '<td>' + (item.so_number || (item.id ? 'SO-' + String(item.id).padStart(4,'0') : '')) + '</td>' +
      '<td>' + (item.customer_name || (item.customer && item.customer.name) || '') + '</td>' +
      '<td>' + (item.order_date || '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">$' + Number(item.total_amount || 0).toLocaleString(undefined,{minimumFractionDigits:2}) + '</td>' +
      '<td>' + statusBadge(item.status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalSO" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-status" data-id="' + item.id + '" data-status="' + (item.status || 'draft') + '" data-bs-toggle="modal" data-bs-target="#modalStatus" title="Status"><i class="bi bi-arrow-repeat"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-cancel" data-cancel-url="/sales/sales-orders/' + item.id + '/cancel" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Cancel"><i class="bi bi-x-circle"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/sales/sales-orders', '#tbl-main tbody', renderRow, '<tr><td colspan="6" class="text-center">No sales orders found</td></tr>');
    ErpApi.get('/sales/customers', {
      success: function(res) {
        var items = (res.data && res.data.data) ? res.data.data : (res.data || []);
        var $sel = $('select[name="customer_id"]');
        $sel.find('option:not(:first)').remove();
        items.forEach(function(c){ $sel.append('<option value="'+c.id+'">'+c.name+'</option>'); });
      }
    });
  };

  loadTableData();

  $('#modalSO').on('show.bs.modal', function() {
    if (!editingId) {
      ErpApi.clearForm('#modalSO');
      $('#modalSO .modal-title').text('New Sales Order');
    }
  });

  $('#modalSO').on('hidden.bs.modal', function() { editingId = null; ErpApi.clearForm('#modalSO'); });

  $(document).on('click', '.btn-edit', function() {
    editingId = $(this).data('id');
    $('#modalSO .modal-title').text('Edit Sales Order');
    ErpApi.get('/sales/sales-orders/' + editingId, {
      success: function(res) { ErpApi.populateForm('#modalSO', res.data); }
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalSO');
    if (editingId) {
      ErpApi.put('/sales/sales-orders/' + editingId, data, {
        success: function(res) { showToast(res.message || 'Order updated', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalSO')).hide(); loadTableData(); },
        error: function() { showToast('Failed to update order', 'danger'); }
      });
    } else {
      ErpApi.post('/sales/sales-orders', data, {
        success: function(res) { showToast(res.message || 'Order created', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalSO')).hide(); loadTableData(); },
        error: function() { showToast('Failed to create order', 'danger'); }
      });
    }
  });

  $(document).on('click', '.btn-cancel', function() { cancelUrl = $(this).data('cancel-url'); });

  $(document).on('click', '.btn-confirm-delete', function() {
    if (!cancelUrl) return;
    ErpApi.post(cancelUrl, {}, {
      success: function(res) { showToast(res.message || 'Order cancelled', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); loadTableData(); },
      error: function() { showToast('Failed to cancel order', 'danger'); }
    });
    cancelUrl = null;
  });

  $(document).on('click', '.btn-status', function() {
    statusOrderId = $(this).data('id');
    $('#statusSelect').val($(this).data('status') || 'draft');
  });

  $(document).on('click', '.btn-confirm-status', function() {
    if (!statusOrderId) return;
    var newStatus = $('#statusSelect').val();
    ErpApi.put('/sales/sales-orders/' + statusOrderId + '/status', { status: newStatus }, {
      success: function(res) { showToast(res.message || 'Status updated', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalStatus')).hide(); loadTableData(); },
      error: function() { showToast('Failed to update status', 'danger'); }
    });
    statusOrderId = null;
  });
});
</script>
@endsection
