@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Invoices</div>
    <div class="page-subtitle">Sales invoices and receivable tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalInvoice"><i class="bi bi-plus-lg"></i> New Invoice</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search invoices…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Paid</option><option>Pending</option><option>Overdue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Invoice #</th><th>Customer</th><th>Date</th><th>Due Date</th><th>Amount</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalInvoice" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Invoice</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Customer</label><select class="erp-form-control" name="customer_id"><option value="">Select customer…</option></select></div><div class="col-md-6"><label class="erp-form-label">Invoice Number</label><input class="erp-form-control" name="invoice_number" type="text" placeholder="INV-XXXX"/></div><div class="col-md-6"><label class="erp-form-label">Invoice Date</label><input class="erp-form-control" name="invoice_date" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Due Date</label><input class="erp-form-control" name="due_date" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" name="amount" type="number" step="0.01" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="pending">Pending</option><option value="paid">Paid</option><option value="overdue">Overdue</option></select></div><div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Generate Invoice
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
        <p style="color:var(--text-secondary)">Are you sure you want to delete this invoice?</p>
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
    var map = {paid:'badge-active', pending:'badge-pending', overdue:'badge-inactive'};
    var cls = map[status] || 'badge-pending';
    var label = status ? status.charAt(0).toUpperCase() + status.slice(1) : '';
    return '<span class="badge-status ' + cls + '">' + label + '</span>';
  }

  function renderRow(item) {
    return '<tr>' +
      '<td>' + (item.invoice_number || '') + '</td>' +
      '<td>' + (item.customer_name || (item.customer && item.customer.name) || '') + '</td>' +
      '<td>' + (item.invoice_date || '') + '</td>' +
      '<td>' + (item.due_date || '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">$' + Number(item.amount || 0).toLocaleString() + '</td>' +
      '<td>' + statusBadge(item.status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon" title="Print"><i class="bi bi-printer"></i></button>' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalInvoice" title="Edit"><i class="bi bi-pencil"></i></button>' +
        (item.status !== 'paid' ? '<button class="btn-erp btn-outline btn-xs btn-icon btn-mark-paid" data-id="' + item.id + '" title="Mark Paid"><i class="bi bi-check-circle"></i></button>' : '') +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/sales/invoices/' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/sales/invoices', '#tbl-main tbody', renderRow, '<tr><td colspan="7" class="text-center">No invoices found</td></tr>');
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

  $('#modalInvoice').on('show.bs.modal', function() {
    if (!editingId) {
      ErpApi.clearForm('#modalInvoice');
      $('#modalInvoice .modal-title').text('New Invoice');
    }
  });

  $('#modalInvoice').on('hidden.bs.modal', function() { editingId = null; ErpApi.clearForm('#modalInvoice'); });

  $(document).on('click', '.btn-edit', function() {
    editingId = $(this).data('id');
    $('#modalInvoice .modal-title').text('Edit Invoice');
    ErpApi.get('/sales/invoices/' + editingId, {
      success: function(res) { ErpApi.populateForm('#modalInvoice', res.data); }
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalInvoice');
    if (editingId) {
      ErpApi.put('/sales/invoices/' + editingId, data, {
        success: function(res) { showToast(res.message || 'Invoice updated', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalInvoice')).hide(); loadTableData(); },
        error: function() { showToast('Failed to update invoice', 'danger'); }
      });
    } else {
      ErpApi.post('/sales/invoices', data, {
        success: function(res) { showToast(res.message || 'Invoice created', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalInvoice')).hide(); loadTableData(); },
        error: function() { showToast('Failed to create invoice', 'danger'); }
      });
    }
  });

  $(document).on('click', '.btn-mark-paid', function() {
    var id = $(this).data('id');
    ErpApi.post('/sales/invoices/' + id + '/mark-paid', {}, {
      success: function(res) { showToast(res.message || 'Invoice marked as paid', 'success'); loadTableData(); },
      error: function() { showToast('Failed to mark invoice as paid', 'danger'); }
    });
  });

  $(document).on('click', '.btn-delete', function() { deleteUrl = $(this).data('delete-url'); });

  $(document).on('click', '.btn-confirm-delete', function() {
    if (!deleteUrl) return;
    ErpApi.del(deleteUrl, {
      success: function(res) { showToast(res.message || 'Invoice deleted', 'success'); bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide(); loadTableData(); },
      error: function() { showToast('Failed to delete invoice', 'danger'); }
    });
    deleteUrl = null;
  });
});
</script>
@endsection
