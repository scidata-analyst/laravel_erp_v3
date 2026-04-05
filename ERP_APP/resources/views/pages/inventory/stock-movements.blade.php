@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Stock In / Out</div>
    <div class="page-subtitle">Warehouse-wise stock movement log</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalStockMove"><i class="bi bi-plus-lg"></i> New Movement</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-4"><div class="kpi-tile green"><div class="kpi-icon green"><i class="bi bi-box-arrow-in-down"></i></div><div class="kpi-value" id="kpi-stock-in">+0</div><div class="kpi-label">Stock In (This Page)</div></div></div>
  <div class="col-md-4"><div class="kpi-tile red"><div class="kpi-icon red"><i class="bi bi-box-arrow-up-right"></i></div><div class="kpi-value" id="kpi-stock-out">-0</div><div class="kpi-label">Stock Out (This Page)</div></div></div>
  <div class="col-md-4"><div class="kpi-tile blue"><div class="kpi-icon blue"><i class="bi bi-boxes"></i></div><div class="kpi-value" id="kpi-net-stock">0</div><div class="kpi-label">Net Movement</div></div></div>
  </div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search stock movements..."/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Types</option><option>Stock In</option><option>Stock Out</option><option>Transfer</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Ref #</th><th>Date</th><th>Product</th><th>Type</th><th>Qty</th><th>Warehouse</th><th>Reason</th><th>User</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination" id="pagination"></div>
</div>

<div class="modal fade" id="modalStockMove" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Stock Movement</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control" name="product_id"><option value="">Select product</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Movement Type</label><select class="erp-form-control" name="movement_type"><option value="Stock In">Stock In</option><option value="Stock Out">Stock Out</option><option value="Transfer">Transfer</option><option value="Adjustment">Adjustment</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Quantity</label><input class="erp-form-control" name="quantity" type="number" min="1" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">From Warehouse</label><select class="erp-form-control" name="from_warehouse"><option value="">Select warehouse</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">To Warehouse</label><select class="erp-form-control" name="to_warehouse"><option value="">Optional</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Reason / Notes</label><textarea class="erp-form-control" name="reason_notes" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Record Movement
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  var apiUrl = '{{ url("inventory/stock-movements") }}';

  function loadLookups() {
    ErpApi.get('/inventory/products', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        var $product = $('#modalStockMove [name="product_id"]');
        $product.find('option:not(:first)').remove();
        items.forEach(function (item) {
          $product.append('<option value="' + item.id + '">' + (item.product_name || ('Product #' + item.id)) + '</option>');
        });
      }
    });

    ErpApi.get('/warehouse/warehouses', {
      success: function (res) {
        var items = res.data && res.data.data ? res.data.data : (res.data || []);
        ['from_warehouse', 'to_warehouse'].forEach(function (name) {
          var $select = $('#modalStockMove [name="' + name + '"]');
          $select.find('option:not(:first)').remove();
          items.forEach(function (item) {
            $select.append('<option value="' + item.code + '">' + (item.code + ' - ' + (item.warehouse_name || item.name || 'Warehouse')) + '</option>');
          });
        });
      }
    });
  }

  function typeBadge(type) {
    return '<span class="badge-status badge-info">' + (type || '-') + '</span>';
  }

  function renderRow(item) {
    var qty = Number(item.quantity || 0);
    var prefix = item.movement_type === 'Stock In' ? '+' : (item.movement_type === 'Stock Out' ? '-' : '');
    var warehouse = item.from_warehouse || '-';

    if (item.movement_type === 'Transfer' && item.to_warehouse) {
      warehouse = (item.from_warehouse || '-') + ' -> ' + item.to_warehouse;
    }

    return '<tr>' +
      '<td>' + (item.ref_number || '-') + '</td>' +
      '<td>' + (item.date || '-') + '</td>' +
      '<td>' + ((item.product && item.product.product_name) || '-') + '</td>' +
      '<td>' + typeBadge(item.movement_type) + '</td>' +
      '<td>' + prefix + qty + '</td>' +
      '<td>' + warehouse + '</td>' +
      '<td>' + (item.reason_notes || '-') + '</td>' +
      '<td>' + ((item.user && item.user.name) || '-') + '</td>' +
      '<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-view" data-id="' + item.id + '" title="View"><i class="bi bi-eye"></i></button></div></td>' +
    '</tr>';
  }

  function updateKpis(items) {
    var stockIn = 0;
    var stockOut = 0;

    items.forEach(function (item) {
      var qty = Number(item.quantity || 0);
      if (item.movement_type === 'Stock In') stockIn += qty;
      if (item.movement_type === 'Stock Out') stockOut += qty;
    });

    $('#kpi-stock-in').text('+' + stockIn);
    $('#kpi-stock-out').text('-' + stockOut);
    $('#kpi-net-stock').text(stockIn - stockOut);
  }

  window.loadTableData = function () {
    ErpApi.loadTable(apiUrl, '#tbl-main tbody', renderRow, 'No stock movements found');
  };

  loadLookups();
  loadTableData();

  $('#tbl-main').on('erp:tableRendered', function (e, pageItems) {
    updateKpis(pageItems || []);
  });

  $('#modalStockMove').on('show.bs.modal', function () {
    ErpApi.clearForm('#modalStockMove');
  });

  $('#modalStockMove .btn-modal-save').on('click', function () {
    var data = ErpApi.collectForm('#modalStockMove');
    ErpApi.post(apiUrl, data, {
      success: function () {
        bootstrap.Modal.getInstance(document.getElementById('modalStockMove')).hide();
        loadTableData();
      }
    });
  });

  $('#tbl-main').on('click', '.btn-view', function () {
    var id = $(this).data('id');
    ErpApi.get(apiUrl + '/' + id, {
      success: function (res) {
        var item = res.data || res;
        showToast('Movement: ' + (item.ref_number || item.id), 'info');
      }
    });
  });
});
</script>
@endsection
