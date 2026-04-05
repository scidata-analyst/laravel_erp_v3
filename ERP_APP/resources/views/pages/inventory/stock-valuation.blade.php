@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Stock Valuation</div><div class="page-subtitle">FIFO / LIFO / Average Cost methods</div></div>
  <div class="d-flex gap-2">
    <select class="erp-form-control" style="width:150px"><option>Weighted Average</option><option>FIFO</option><option>LIFO</option></select>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-4"><div class="kpi-tile blue"><div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div><div class="kpi-value" id="kpi-total-value">$0</div><div class="kpi-label">Total Stock Value</div></div></div>
  <div class="col-md-4"><div class="kpi-tile yellow"><div class="kpi-icon yellow"><i class="bi bi-stack"></i></div><div class="kpi-value" id="kpi-total-units">0</div><div class="kpi-label">Total Units</div></div></div>
  <div class="col-md-4"><div class="kpi-tile green"><div class="kpi-icon green"><i class="bi bi-graph-up"></i></div><div class="kpi-value" id="kpi-avg-value">$0.00</div><div class="kpi-label">Avg Unit Value</div></div></div>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search stock valuation..."/>
    </div>
    <select class="erp-form-control" name="valuation_method" style="width:150px">
      <option>All Methods</option>
      <option>Weighted Average</option>
      <option>FIFO</option>
      <option>LIFO</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Product</th><th>SKU</th><th>Qty on Hand</th><th>Cost Method</th><th>Unit Cost</th><th>Total Value</th><th>Last Updated</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination" id="pagination"></div>
</div>

<script>
$(function () {
  var apiUrl = '{{ url("inventory/stock-valuation") }}';

  function renderRow(item) {
    var qty = Number(item.quantity_on_hand || item.total_quantity || 0);
    return '<tr>' +
      '<td>' + ((item.product && item.product.product_name) || '-') + '</td>' +
      '<td>' + ((item.product && item.product.sku) || '-') + '</td>' +
      '<td>' + qty + '</td>' +
      '<td>' + (item.valuation_method || '-') + '</td>' +
      '<td>$' + Number(item.unit_cost || 0).toFixed(2) + '</td>' +
      '<td>$' + Number(item.total_value || 0).toFixed(2) + '</td>' +
      '<td>' + (item.valuation_date || item.updated_at || '-') + '</td>' +
    '</tr>';
  }

  function updateKpis(items) {
    var totalValue = 0;
    var totalUnits = 0;

    items.forEach(function (item) {
      totalValue += Number(item.total_value || 0);
      totalUnits += Number(item.quantity_on_hand || item.total_quantity || 0);
    });

    var avgValue = totalUnits > 0 ? (totalValue / totalUnits) : 0;
    $('#kpi-total-value').text('$' + totalValue.toFixed(2));
    $('#kpi-total-units').text(totalUnits);
    $('#kpi-avg-value').text('$' + avgValue.toFixed(2));
  }

  window.loadTableData = function () {
    ErpApi.loadTable(apiUrl, '#tbl-main tbody', renderRow, 'No valuations found');
  };

  loadTableData();

  $('#tbl-main').on('erp:tableRendered', function (e, pageItems) {
    updateKpis(pageItems || []);
  });
});
</script>
@endsection
