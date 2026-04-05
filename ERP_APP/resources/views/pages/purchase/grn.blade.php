@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Goods Receipt Notes</div>
    <div class="page-subtitle">Record goods received from suppliers against purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalGRN" id="btnAddGRN"><i class="bi bi-plus-lg"></i> New GRN</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search goods receipt notes..."/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Completed</option><option>Pending</option><option>Rejected</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>GRN #</th><th>PO Reference</th><th>Received Date</th><th>Received By</th><th>Notes</th><th>Actions</th></tr></thead>
      <tbody id="tbl-grn-body"></tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalGRN" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Goods Receipt Note</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Purchase Order</label><select class="erp-form-control" name="purchase_order_id"><option value="">Select PO</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Supplier</label><select class="erp-form-control" name="supplier_id"><option value="">Auto from PO</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Received Date</label><input class="erp-form-control" type="date" name="received_date" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="completed">Completed</option><option value="pending">Pending</option><option value="rejected">Rejected</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save GRN
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  var editingId = null;

  function loadLookups() {
    ErpApi.get('/purchase/purchase-orders', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        var $sel = $('#modalGRN [name="purchase_order_id"]');
        $sel.find('option:not(:first)').remove();
        items.forEach(function (item) {
          $sel.append('<option value="' + item.id + '">' + (item.po_number || ('PO-' + item.id)) + '</option>');
        });
      }
    });

    ErpApi.get('/purchase/suppliers', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        var $sel = $('#modalGRN [name="supplier_id"]');
        $sel.find('option:not(:first)').remove();
        items.forEach(function (item) {
          $sel.append('<option value="' + item.id + '">' + (item.company_name || item.name || ('Supplier #' + item.id)) + '</option>');
        });
      }
    });
  }

  function renderRow(item) {
    return '<tr data-id="' + item.id + '">' +
      '<td>' + (item.grn_number || ('GRN-' + item.id)) + '</td>' +
      '<td>' + (item.purchase_order_number || ('PO-' + item.purchase_order_id)) + '</td>' +
      '<td>' + (item.received_date || '-') + '</td>' +
      '<td>' + (item.received_by_name || '-') + '</td>' +
      '<td>' + (item.notes || '-') + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-grn" data-id="' + item.id + '" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/purchase/grn/' + item.id + '" data-delete-label="GRN" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/purchase/grn', '#tbl-grn-body', renderRow, 'No GRN records found');
  }

  loadTableData();
  loadLookups();

  $('#btnAddGRN').on('click', function () {
    editingId = null;
    ErpApi.clearForm('#modalGRN');
    $('#modalGRN .modal-title').text('New Goods Receipt Note');
    $('#modalGRN [name="received_date"]').val(new Date().toISOString().split('T')[0]);
  });

  $(document).on('click', '.btn-edit-grn', function () {
    editingId = $(this).data('id');
    ErpApi.get('/purchase/grn/' + editingId, {
      success: function (res) {
        ErpApi.populateForm('#modalGRN', res.data);
        $('#modalGRN .modal-title').text('Edit GRN');
        new bootstrap.Modal(document.getElementById('modalGRN')).show();
      }
    });
  });

  $('#modalGRN .btn-modal-save').on('click', function () {
    var data = ErpApi.collectForm('#modalGRN');

    if (editingId) {
      ErpApi.put('/purchase/grn/' + editingId, data, {
        success: function (res) {
          showToast(res.message || 'GRN updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalGRN')).hide();
          loadTableData();
          editingId = null;
        }
      });
      return;
    }

    ErpApi.post('/purchase/grn', data, {
      success: function (res) {
        showToast(res.message || 'GRN saved', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalGRN')).hide();
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
