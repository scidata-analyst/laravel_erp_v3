@extends('layouts.erp')

@section('title', 'Stock Valuation')
@section('breadcrumb', 'Stock Valuation')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Stock Valuation</div>
    <div class="page-subtitle">FIFO / LIFO / Average Cost methods</div>
  </div>
  <div class="d-flex gap-2">
    <select class="erp-form-control" style="width:150px">
      <option>FIFO</option>
      <option>LIFO</option>
      <option>Average Cost</option>
    </select>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalStockValuation" data-mode="create"><i class="bi bi-plus-lg"></i> Add Valuation</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="kpi-tile blue">
      <div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div>
      <div class="kpi-value">$1.24M</div>
      <div class="kpi-label">Total Stock Value (FIFO)</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile yellow">
      <div class="kpi-icon yellow"><i class="bi bi-stack"></i></div>
      <div class="kpi-value">14,230</div>
      <div class="kpi-label">Total Units</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile green">
      <div class="kpi-icon green"><i class="bi bi-graph-up"></i></div>
      <div class="kpi-value">$87.24</div>
      <div class="kpi-label">Avg Unit Value</div>
    </div>
  </div>
</div>
<div class="erp-card">
  <div class="erp-table-wrap">
    <table class="erp-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>SKU</th>
          <th>Qty on Hand</th>
          <th>Cost Method</th>
          <th>Unit Cost</th>
          <th>Total Value</th>
          <th>Last Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $valuation)
         <tr>
           <td>{{ $valuation->product->product_name ?? 'N/A' }}</td>
           <td>{{ $valuation->product->sku ?? '—' }}</td>
           <td>{{ $valuation->quantity_on_hand ?? 0 }}</td>
           <td>{{ $valuation->valuation_method ?? 'FIFO' }}</td>
           <td>${{ number_format($valuation->unit_cost ?? 0, 2) }}</td>
           <td>${{ number_format($valuation->total_value ?? 0, 2) }}</td>
           <td>{{ $valuation->updated_at ? \Carbon\Carbon::parse($valuation->updated_at)->format('Y-m-d') : 'N/A' }}</td>
          <td>
            <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
              data-id="{{ $valuation->id }}"
              data-mode="edit"
              data-bs-toggle="modal" data-bs-target="#modalStockValuation" title="Edit"><i class="bi bi-pencil"></i></button><button
              class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $valuation->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
              data-delete-label="Valuation" title="Delete"><i class="bi bi-trash"></i></button></div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No stock valuations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalStockValuation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add Stock Valuation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
        <div class="modal-body">
          <form id="form-stock-valuation">
            @csrf
            <input type="hidden" name="id" id="valuation-id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product</label>
                <select class="erp-form-control" name="product_id" id="product_id" required>
                  <option value="">Select Product</option>
                </select>
                <div class="invalid-feedback" id="error-product_id"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Valuation Method</label>
                <select class="erp-form-control" name="valuation_method" id="valuation_method" required>
                  <option value="FIFO">FIFO</option>
                  <option value="LIFO">LIFO</option>
                  <option value="Average Cost">Average Cost</option>
                </select>
                <div class="invalid-feedback" id="error-valuation_method"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Quantity on Hand</label>
                <input class="erp-form-control" name="quantity_on_hand" id="quantity_on_hand" type="number" placeholder="" required min="0" />
                <div class="invalid-feedback" id="error-quantity_on_hand"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Unit Cost ($)</label>
                <input class="erp-form-control" name="unit_cost" id="unit_cost" type="number" placeholder="0.00" step="0.01" required min="0" />
                <div class="invalid-feedback" id="error-unit_cost"></div>
              </div>
            </div>
          </form>
        </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="form-stock-valuation" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save Valuation
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
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
  const modalStockValuation = document.getElementById('modalStockValuation');
  const formStockValuation = document.getElementById('form-stock-valuation');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');
  const productSelect = document.getElementById('product_id');

  let deleteId = null;

  apiClient.get(API_ENDPOINTS.INVENTORY.PRODUCT_CATALOG.ALL)
    .then(data => {
      if (data.success && data.data) {
        productSelect.innerHTML = '<option value="">Select Product</option>';
        data.data.forEach(p => {
          productSelect.innerHTML += `<option value="${p.id}">${p.product_name} (${p.sku})</option>`;
        });
      }
    })
    .catch(() => console.warn('Failed to load products'));

  modalStockValuation.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formStockValuation);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Stock Valuation';

      apiClient.show(API_ENDPOINTS.INVENTORY.STOCK_VALUATION.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('valuation-id').value = item.id;
          formStockValuation.querySelector('[name="product_id"]').value = item.product_id || '';
          formStockValuation.querySelector('[name="quantity_on_hand"]').value = item.quantity_on_hand || '';
          formStockValuation.querySelector('[name="valuation_method"]').value = item.valuation_method || 'FIFO';
          formStockValuation.querySelector('[name="unit_cost"]').value = item.unit_cost || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Stock Valuation';
      formStockValuation.reset();
      document.getElementById('valuation-id').value = '';
    }
  });

  formStockValuation.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('valuation-id').value;

    const formData = new FormData(formStockValuation);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.INVENTORY.STOCK_VALUATION.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.INVENTORY.STOCK_VALUATION.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalStockValuation).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formStockValuation, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.INVENTORY.STOCK_VALUATION.DESTROY, deleteId)
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