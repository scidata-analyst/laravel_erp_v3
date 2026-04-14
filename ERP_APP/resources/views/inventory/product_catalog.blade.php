@extends('layouts.erp')

@section('title', 'Product Catalog')
@section('breadcrumb', 'Inventory / Product Catalog')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Product Catalog</div>
      <div class="page-subtitle">Manage products, categories and pricing</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduct"><i
          class="bi bi-plus-lg"></i> Add Product</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search product catalog…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Electronics</option>
        <option>Hardware</option>
        <option>Apparel</option>
        <option>Furniture</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Unit Price</th>
            <th>Stock Qty</th>
            <th>Warehouse</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $product)
            <tr>
              <td>{{ $product->sku }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->category }}</td>
              <td>${{ number_format($product->unit_price, 2) }}</td>
              <td>0</td>
              <td>{{ $product->warehouse_id ?? 'N/A' }}</td>
              <td>
                @if ($product->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalProduct" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Product" title="Delete"><i class="bi bi-trash"></i></button></div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-5">
      <div>
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
      </div>
      <div>
        {{ $data->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalProduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-8"><label class="erp-form-label">Product Name</label><input class="erp-form-control"
                type="text" placeholder="Product name" /></div>
            <div class="col-md-4"><label class="erp-form-label">SKU</label><input class="erp-form-control" type="text"
                placeholder="SKU-XXXX" /></div>
            <div class="col-md-6"><label class="erp-form-label">Category</label><select class="erp-form-control">
                <option>Electronics</option>
                <option>Hardware</option>
                <option>Apparel</option>
                <option>Furniture</option>
              </select></div>
            <div class="col-md-3"><label class="erp-form-label">Unit Price ($)</label><input class="erp-form-control"
                type="number" placeholder="0.00" /></div>
            <div class="col-md-3"><label class="erp-form-label">Cost Price ($)</label><input class="erp-form-control"
                type="number" placeholder="0.00" /></div>
            <div class="col-md-6"><label class="erp-form-label">Warehouse</label><select class="erp-form-control">
                <option>WH-A</option>
                <option>WH-B</option>
                <option>WH-C</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Reorder Level</label><input class="erp-form-control"
                type="number" placeholder="10" /></div>
            <div class="col-md-4"><label class="erp-form-label">Valuation Method</label><select
                class="erp-form-control">
                <option>FIFO</option>
                <option>LIFO</option>
                <option>Average Cost</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="2" placeholder="Product description…"></textarea></div>
          </div>
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

  <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm
            Delete</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="color:var(--text-secondary);font-size:14px">
            Are you sure you want to delete this
            <strong id="delete-target" style="color:var(--text-primary)">record</strong>?
            This action cannot be undone.
          </p>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-danger" id="btn-confirm-delete">
            <i class="bi bi-trash"></i> Delete
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection