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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProduct" data-mode="create"><i
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
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $product->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalProduct" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
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
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-product">
            @csrf
            <input type="hidden" name="id" id="product-id">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="erp-form-label">Product Name</label>
                <input class="erp-form-control" type="text" name="product_name" id="product_name" placeholder="Product name" required />
                <div class="invalid-feedback" id="error-product_name"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">SKU</label>
                <input class="erp-form-control" type="text" name="sku" id="sku" placeholder="SKU-XXXX" required />
                <div class="invalid-feedback" id="error-sku"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Category</label>
                <select class="erp-form-control" name="category" id="category" required>
                  <option value="">Select Category</option>
                  <option value="Electronics">Electronics</option>
                  <option value="Hardware">Hardware</option>
                  <option value="Apparel">Apparel</option>
                  <option value="Furniture">Furniture</option>
                </select>
                <div class="invalid-feedback" id="error-category"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Unit Price ($)</label>
                <input class="erp-form-control" type="number" name="unit_price" id="unit_price" placeholder="0.00" step="0.01" required />
                <div class="invalid-feedback" id="error-unit_price"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Cost Price ($)</label>
                <input class="erp-form-control" type="number" name="cost_price" id="cost_price" placeholder="0.00" step="0.01" required />
                <div class="invalid-feedback" id="error-cost_price"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Warehouse</label>
                <select class="erp-form-control" name="warehouse_id" id="warehouse_id" required>
                  <option value="">Select Warehouse</option>
                  <option value="WH-A">WH-A</option>
                  <option value="WH-B">WH-B</option>
                  <option value="WH-C">WH-C</option>
                </select>
                <div class="invalid-feedback" id="error-warehouse_id"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Reorder Level</label>
                <input class="erp-form-control" type="number" name="reorder_level" id="reorder_level" placeholder="10" />
                <div class="invalid-feedback" id="error-reorder_level"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Valuation Method</label>
                <select class="erp-form-control" name="valuation_method" id="valuation_method">
                  <option value="FIFO">FIFO</option>
                  <option value="LIFO">LIFO</option>
                  <option value="Average Cost">Average Cost</option>
                </select>
                <div class="invalid-feedback" id="error-valuation_method"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
                <div class="invalid-feedback" id="error-status"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Description</label>
                <textarea class="erp-form-control" name="description" id="description" rows="2" placeholder="Product description…"></textarea>
                <div class="invalid-feedback" id="error-description"></div>
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="form-product" class="btn-erp btn-primary btn-modal-save" id="btn-save">
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

  @push('scripts')
     <script>
document.addEventListener('DOMContentLoaded', function() {
  const modalProduct = document.getElementById('modalProduct');
  const formProduct = document.getElementById('form-product');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');
  const warehouseSelect = document.getElementById('warehouse_id');

  let deleteId = null;

  apiClient.get('{{ route("warehouses.all") }}')
    .then(data => {
      if (data.success && data.data) {
        warehouseSelect.innerHTML = '<option value="">Select Warehouse</option>';
        data.data.forEach(w => {
          warehouseSelect.innerHTML += `<option value="${w.id}">${w.warehouse_name} (${w.warehouse_code})</option>`;
        });
      }
    })
    .catch(() => console.warn('Failed to load warehouses'));

  modalProduct.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formProduct);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Product';

      apiClient.show(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('product-id').value = item.id;
          formProduct.querySelector('[name="product_name"]').value = item.product_name || '';
          formProduct.querySelector('[name="sku"]').value = item.sku || '';
          formProduct.querySelector('[name="category"]').value = item.category || '';
          formProduct.querySelector('[name="unit_price"]').value = item.unit_price || '';
          formProduct.querySelector('[name="cost_price"]').value = item.cost_price || '';
          formProduct.querySelector('[name="warehouse_id"]').value = item.warehouse_id || '';
          formProduct.querySelector('[name="reorder_level"]').value = item.reorder_level || '';
          formProduct.querySelector('[name="valuation_method"]').value = item.valuation_method || 'FIFO';
          formProduct.querySelector('[name="status"]').value = item.status || 'Active';
          formProduct.querySelector('[name="description"]').value = item.description || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Product';
      formProduct.reset();
      document.getElementById('product-id').value = '';
    }
  });

  formProduct.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('product-id').value;

    const formData = new FormData(formProduct);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalProduct).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formProduct, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'record';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.DESTROY, deleteId)
    .then(data => {
      if (data.success || !data.error) {
        bootstrap.Modal.getInstance(modalDelete).hide();
        showToast(data.message || 'Deleted successfully', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => showToast(error.message || 'An error occurred', 'error'));
  });
});
     </script>
  @endpush
@endsection