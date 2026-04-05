@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Product Catalog</div>
    <div class="page-subtitle">Manage products, categories and pricing</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduct"><i class="bi bi-plus-lg"></i> Add Product</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search product catalog…"/>
    </div>
    <select class="erp-form-control" name="category" style="width:140px"><option>All Status</option><option>Electronics</option><option>Hardware</option><option>Apparel</option><option>Furniture</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>SKU</th><th>Product Name</th><th>Category</th><th>Unit Price</th><th>Stock Qty</th><th>Warehouse</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination" id="pagination"></div>
</div>

<div class="modal fade" id="modalProduct" tabindex="-1" aria-hidden="true" data-api-save="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Product</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-8"><label class="erp-form-label">Product Name</label><input class="erp-form-control" name="product_name" type="text" placeholder="Product name"/></div><div class="col-md-4"><label class="erp-form-label">SKU</label><input class="erp-form-control" name="sku" type="text" placeholder="SKU-XXXX"/></div><div class="col-md-6"><label class="erp-form-label">Category</label><select class="erp-form-control" name="category"><option>Electronics</option><option>Hardware</option><option>Apparel</option><option>Furniture</option></select></div><div class="col-md-3"><label class="erp-form-label">Unit Price ($)</label><input class="erp-form-control" name="unit_price" type="number" step="0.01" placeholder="0.00"/></div><div class="col-md-3"><label class="erp-form-label">Cost Price ($)</label><input class="erp-form-control" name="cost_price" type="number" step="0.01" placeholder="0.00"/></div><div class="col-md-6"><label class="erp-form-label">Warehouse</label><select class="erp-form-control" name="warehouse"><option>WH-A</option><option>WH-B</option><option>WH-C</option></select></div><div class="col-md-4"><label class="erp-form-label">Reorder Level</label><input class="erp-form-control" name="reorder_level" type="number" placeholder="10"/></div><div class="col-md-4"><label class="erp-form-label">Valuation Method</label><select class="erp-form-control" name="valuation_method"><option>FIFO</option><option>LIFO</option><option>Average Cost</option></select></div><div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="2" placeholder="Product description…"></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Product
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function () {
  var apiUrl = '{{ url("inventory/products") }}';
  var editingId = null;

  function statusBadge(status) {
    if (status === 'Active') return '<span class="badge-status badge-active">Active</span>';
    if (status === 'Inactive' || status === 'Out of Stock') return '<span class="badge-status badge-inactive">' + status + '</span>';
    if (status === 'Low Stock') return '<span class="badge-status badge-pending">Low Stock</span>';
    return '<span class="badge-status">' + status + '</span>';
  }

  function renderRow(item) {
    var price = item.unit_price ? '$' + parseFloat(item.unit_price).toFixed(2) : '$0.00';
    var stock = item.stock_qty !== undefined && item.stock_qty !== null ? item.stock_qty : '—';
    var status = item.status || 'Active';
    return '<tr>' +
      '<td>' + (item.sku || '—') + '</td>' +
      '<td>' + (item.product_name || '—') + '</td>' +
      '<td>' + (item.category || '—') + '</td>' +
      '<td>' + price + '</td>' +
      '<td>' + stock + '</td>' +
      '<td>' + (item.warehouse || '—') + '</td>' +
      '<td>' + statusBadge(status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Product" data-delete-url="' + apiUrl + '/' + item.id + '" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td>' +
    '</tr>';
  }

  window.loadTableData = function () {
    ErpApi.loadTable(apiUrl, '#tbl-main tbody', renderRow, 'No products found');
  };

  loadTableData();

  $('#modalProduct').on('show.bs.modal', function () {
    if (!editingId) {
      ErpApi.clearForm('#modalProduct');
      $(this).removeData('edit-id');
      $(this).find('.modal-title').text('Add / Edit Product');
    }
  });

  $('#modalProduct').on('hidden.bs.modal', function () {
    editingId = null;
    ErpApi.clearForm('#modalProduct');
    $(this).removeData('edit-id');
    $(this).find('.modal-title').text('Add / Edit Product');
  });

  $('#tbl-main').on('click', '.btn-edit', function () {
    var id = $(this).data('id');
    editingId = id;
    ErpApi.get(apiUrl + '/' + id, {
      success: function (res) {
        var item = res.data || res;
        ErpApi.populateForm('#modalProduct', item);
        $('#modalProduct').data('edit-id', item.id);
        $('#modalProduct .modal-title').text('Edit Product');
        new bootstrap.Modal(document.getElementById('modalProduct')).show();
      }
    });
  });

  $('#modalProduct .btn-modal-save').on('click', function () {
    var data = ErpApi.collectForm('#modalProduct');
    var editId = $('#modalProduct').data('edit-id');

    if (editId) {
      ErpApi.put(apiUrl + '/' + editId, data, {
        success: function () {
          bootstrap.Modal.getInstance(document.getElementById('modalProduct')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post(apiUrl, data, {
        success: function () {
          bootstrap.Modal.getInstance(document.getElementById('modalProduct')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endsection
