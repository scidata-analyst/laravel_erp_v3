@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Batch / Expiry / Serial Tracking</div>
    <div class="page-subtitle">Track lot numbers, serial IDs and expiry dates</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBatch"><i class="bi bi-plus-lg"></i> Add Batch</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search batch / expiry / serial tracking…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Expiring Soon</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Batch/Lot #</th><th>Serial</th><th>Product</th><th>Qty</th><th>Mfg Date</th><th>Expiry</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination" id="pagination"></div>
</div>

<div class="modal fade" id="modalBatch" tabindex="-1" aria-hidden="true" data-api-save="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Batch / Serial</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control" name="product_id"><option>Paracetamol 500mg</option><option>Battery Pack</option></select></div><div class="col-md-6"><label class="erp-form-label">Batch / Lot #</label><input class="erp-form-control" name="batch_lot_number" type="text" placeholder="LOT-XXXX-XXX"/></div><div class="col-md-6"><label class="erp-form-label">Serial Number</label><input class="erp-form-control" name="serial_number" type="text" placeholder="SN-XXXXX"/></div><div class="col-md-6"><label class="erp-form-label">Quantity</label><input class="erp-form-control" name="quantity" type="number" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Manufacturing Date</label><input class="erp-form-control" name="manufacturing_date" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Expiry Date</label><input class="erp-form-control" name="expiry_date" type="date" placeholder=""/></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Batch
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  var apiUrl = '{{ url("inventory/batch-tracking") }}';
  var editingId = null;

  function statusBadge(status) {
    if (status === 'Active') return '<span class="badge-status badge-active">Active</span>';
    if (status === 'Expired') return '<span class="badge-status badge-inactive">Expired</span>';
    if (status === 'Pending') return '<span class="badge-status badge-pending">Pending</span>';
    return '<span class="badge-status">' + status + '</span>';
  }

  function renderRow(item) {
    var productName = item.product ? (item.product.product_name || '—') : (item.product_id || '—');
    return '<tr>' +
      '<td>' + (item.batch_lot_number || '—') + '</td>' +
      '<td>' + (item.serial_number || '—') + '</td>' +
      '<td>' + productName + '</td>' +
      '<td>' + (item.quantity || 0) + '</td>' +
      '<td>' + (item.manufacturing_date || '—') + '</td>' +
      '<td>' + (item.expiry_date || '—') + '</td>' +
      '<td>' + statusBadge(item.status || 'Active') + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Batch" data-delete-url="' + apiUrl + '/' + item.id + '" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td>' +
    '</tr>';
  }

  window.loadTableData = function () {
    ErpApi.loadTable(apiUrl, '#tbl-main tbody', renderRow, 'No batches found');
  };

  loadTableData();

  $('#modalBatch').on('show.bs.modal', function () {
    if (!editingId) {
      ErpApi.clearForm('#modalBatch');
      $(this).removeData('edit-id');
      $(this).find('.modal-title').text('Add Batch / Serial');
    }
  });

  $('#modalBatch').on('hidden.bs.modal', function () {
    editingId = null;
    ErpApi.clearForm('#modalBatch');
    $(this).removeData('edit-id');
    $(this).find('.modal-title').text('Add Batch / Serial');
  });

  $('#tbl-main').on('click', '.btn-edit', function () {
    var id = $(this).data('id');
    editingId = id;
    ErpApi.get(apiUrl + '/' + id, {
      success: function (res) {
        var item = res.data || res;
        ErpApi.populateForm('#modalBatch', item);
        $('#modalBatch').data('edit-id', item.id);
        $('#modalBatch .modal-title').text('Edit Batch / Serial');
        new bootstrap.Modal(document.getElementById('modalBatch')).show();
      }
    });
  });

  $('#modalBatch .btn-modal-save').on('click', function () {
    var data = ErpApi.collectForm('#modalBatch');
    var editId = $('#modalBatch').data('edit-id');

    if (editId) {
      ErpApi.put(apiUrl + '/' + editId, data, {
        success: function () {
          bootstrap.Modal.getInstance(document.getElementById('modalBatch')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post(apiUrl, data, {
        success: function () {
          bootstrap.Modal.getInstance(document.getElementById('modalBatch')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endsection
