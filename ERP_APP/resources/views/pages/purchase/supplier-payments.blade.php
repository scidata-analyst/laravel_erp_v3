@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Payments</div>
    <div class="page-subtitle">Track all outgoing payments to suppliers</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplierPay" id="btnAddPayment"><i class="bi bi-plus-lg"></i> New Payment</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier payments..."/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Completed</option><option>Pending</option><option>Failed</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Payment #</th><th>Supplier</th><th>PO Reference</th><th>Amount</th><th>Payment Date</th><th>Method</th><th>Reference</th><th>Actions</th></tr></thead>
      <tbody id="tbl-payments-body"></tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalSupplierPay" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Supplier Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Supplier</label><select class="erp-form-control" name="supplier_id"><option value="">Select Supplier</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Purchase Order</label><select class="erp-form-control" name="purchase_order_id"><option value="">Select PO</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" type="number" name="amount" step="0.01" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Payment Date</label><input class="erp-form-control" type="date" name="payment_date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Method</label><select class="erp-form-control" name="payment_method"><option value="Bank Transfer">Bank Transfer</option><option value="Cheque">Cheque</option><option value="Cash">Cash</option><option value="Credit Card">Credit Card</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="completed">Completed</option><option value="pending">Pending</option><option value="failed">Failed</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Reference</label><input class="erp-form-control" type="text" name="reference" placeholder="INV-SUP-XXX"/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Record Payment
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  var editingId = null;

  function loadLookups() {
    ErpApi.get('/purchase/suppliers', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        var $sel = $('#modalSupplierPay [name="supplier_id"]');
        $sel.find('option:not(:first)').remove();
        items.forEach(function (item) {
          $sel.append('<option value="' + item.id + '">' + (item.company_name || item.name || ('Supplier #' + item.id)) + '</option>');
        });
      }
    });

    ErpApi.get('/purchase/purchase-orders', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        var $sel = $('#modalSupplierPay [name="purchase_order_id"]');
        $sel.find('option:not(:first)').remove();
        items.forEach(function (item) {
          $sel.append('<option value="' + item.id + '">' + (item.po_number || ('PO-' + item.id)) + '</option>');
        });
      }
    });
  }

  function renderRow(item) {
    return '<tr data-id="' + item.id + '">' +
      '<td>' + (item.payment_number || ('PAY-' + item.id)) + '</td>' +
      '<td>' + (item.supplier_name || item.supplier_id) + '</td>' +
      '<td>' + (item.purchase_order_number || ('PO-' + item.purchase_order_id)) + '</td>' +
      '<td>$' + Number(item.amount || 0).toLocaleString() + '</td>' +
      '<td>' + (item.payment_date || '-') + '</td>' +
      '<td>' + (item.payment_method || '-') + '</td>' +
      '<td>' + (item.reference || '-') + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-view-payment" data-id="' + item.id + '" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/purchase/supplier-payments/' + item.id + '" data-delete-label="Payment" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/purchase/supplier-payments', '#tbl-payments-body', renderRow, 'No payments found');
  }

  loadTableData();
  loadLookups();

  $('#btnAddPayment').on('click', function () {
    editingId = null;
    ErpApi.clearForm('#modalSupplierPay');
    $('#modalSupplierPay .modal-title').text('New Supplier Payment');
    $('#modalSupplierPay [name="payment_date"]').val(new Date().toISOString().split('T')[0]);
  });

  $(document).on('click', '.btn-view-payment', function () {
    editingId = $(this).data('id');
    ErpApi.get('/purchase/supplier-payments/' + editingId, {
      success: function (res) {
        ErpApi.populateForm('#modalSupplierPay', res.data);
        $('#modalSupplierPay .modal-title').text('Edit Payment');
        new bootstrap.Modal(document.getElementById('modalSupplierPay')).show();
      }
    });
  });

  $('#modalSupplierPay .btn-modal-save').on('click', function () {
    var data = ErpApi.collectForm('#modalSupplierPay');

    if (editingId) {
      ErpApi.put('/purchase/supplier-payments/' + editingId, data, {
        success: function (res) {
          showToast(res.message || 'Payment updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalSupplierPay')).hide();
          loadTableData();
          editingId = null;
        }
      });
      return;
    }

    ErpApi.post('/purchase/supplier-payments', data, {
      success: function (res) {
        showToast(res.message || 'Payment recorded', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalSupplierPay')).hide();
        loadTableData();
      }
    });
  });

  $(document).on('click', '[data-delete-url]', function () {
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label') || 'Item';

    if (confirm('Are you sure you want to delete this ' + label + '?')) {
      ErpApi.del(url, {
        success: function (res) {
          showToast(res.message || (label + ' deleted'), 'success');
          loadTableData();
        }
      });
    }
  });
});
</script>
@endsection
