@extends('layouts.erp')

@section('title', 'Stock In / Out')
@section('breadcrumb', 'Inventory / Stock In / Out')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Stock In / Out</div>
      <div class="page-subtitle">Warehouse-wise stock movement log</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalStockMove" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Movement</button>
    </div>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-4">
      <div class="kpi-tile green">
        <div class="kpi-icon green"><i class="bi bi-box-arrow-in-down"></i></div>
        <div class="kpi-value">+4,820</div>
        <div class="kpi-label">Stock In (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile red">
        <div class="kpi-icon red"><i class="bi bi-box-arrow-up-right"></i></div>
        <div class="kpi-value">-3,142</div>
        <div class="kpi-label">Stock Out (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-boxes"></i></div>
        <div class="kpi-value">14,230</div>
        <div class="kpi-label">Net Current Stock</div>
      </div>
    </div>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search stock in / out…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Stock In</option>
        <option>Stock Out</option>
        <option>Transfer</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Ref #</th>
            <th>Date</th>
            <th>Product</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Warehouse</th>
            <th>Reason</th>
            <th>User</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $movement)
            <tr>
              <td>MV-{{ $movement->id }}</td>
              <td>{{ $movement->created_at ? \Carbon\Carbon::parse($movement->created_at)->format('Y-m-d') : 'N/A' }}</td>
               <td>{{ $movement->product->product_name ?? 'N/A' }}</td>
              <td>
                @if ($movement->movement_type == 'Stock In')
                  <span class="badge-status badge-info">Stock In</span>
                @elseif ($movement->movement_type == 'Stock Out')
                  <span class="badge-status badge-info">Stock Out</span>
                @else
                  <span class="badge-status badge-info">{{ $movement->movement_type }}</span>
                @endif
              </td>
              <td>{{ $movement->quantity }}</td>
               <td>{{ $movement->fromWarehouse->warehouse_name ?? 'N/A' }} → {{ $movement->toWarehouse->warehouse_name ?? 'N/A' }}</td>
              <td>{{ $movement->reason ?? 'N/A' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $movement->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalStockMove" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $movement->id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Movement" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalStockMove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New Stock Movement</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-stock-movement">
            @csrf
            <input type="hidden" name="id" id="movement-id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product</label>
                <select class="erp-form-control" name="product_id" id="product_id" required>
                  <option value="">Select Product</option>
                </select>
                <div class="invalid-feedback" id="error-product_id"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Movement Type</label>
                <select class="erp-form-control" name="movement_type" id="movement_type" required>
                  <option value="Stock In">Stock In</option>
                  <option value="Stock Out">Stock Out</option>
                  <option value="Transfer">Transfer</option>
                </select>
                <div class="invalid-feedback" id="error-movement_type"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Quantity</label>
                <input class="erp-form-control" name="quantity" id="quantity" type="number" placeholder="" required min="1" />
                <div class="invalid-feedback" id="error-quantity"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">From Warehouse</label>
                <select class="erp-form-control" name="from_warehouse_id" id="from_warehouse_id">
                  <option value="">Select</option>
                </select>
                <div class="invalid-feedback" id="error-from_warehouse_id"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">To Warehouse</label>
                <select class="erp-form-control" name="to_warehouse_id" id="to_warehouse_id">
                  <option value="">Select</option>
                </select>
                <div class="invalid-feedback" id="error-to_warehouse_id"></div>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Reason / Notes</label>
                <textarea class="erp-form-control" name="reason" id="reason" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-reason"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" form="form-stock-movement" class="btn-erp btn-primary btn-modal-save" id="btn-save">
            <i class="bi bi-check2"></i> Record Movement
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
  </    <script>
document.addEventListener('DOMContentLoaded', function() {
  const modalStockMove = document.getElementById('modalStockMove');
  const formStockMove = document.getElementById('form-stock-movement');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');
  const productSelect = document.getElementById('product_id');
  const fromWarehouseSelect = document.getElementById('from_warehouse_id');
  const toWarehouseSelect = document.getElementById('to_warehouse_id');
  const movementTypeSelect = document.getElementById('movement_type');

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

  apiClient.get('{{ route("warehouses.all") }}')
    .then(data => {
      if (data.success && data.data) {
        fromWarehouseSelect.innerHTML = '<option value="">Select</option>';
        toWarehouseSelect.innerHTML = '<option value="">Select</option>';
        data.data.forEach(w => {
          const opt = `<option value="${w.id}">${w.warehouse_name} (${w.warehouse_code})</option>`;
          fromWarehouseSelect.innerHTML += opt;
          toWarehouseSelect.innerHTML += opt;
        });
      }
    })
    .catch(() => console.warn('Failed to load warehouses'));

  function toggleWarehouseFields() {
    const type = movementTypeSelect.value;
    if (type === 'Transfer') {
      fromWarehouseSelect.closest('.col-md-4').style.display = 'block';
      toWarehouseSelect.closest('.col-md-4').style.display = 'block';
    } else if (type === 'Stock In') {
      fromWarehouseSelect.closest('.col-md-4').style.display = 'none';
      fromWarehouseSelect.value = '';
      toWarehouseSelect.closest('.col-md-4').style.display = 'block';
    } else if (type === 'Stock Out') {
      fromWarehouseSelect.closest('.col-md-4').style.display = 'block';
      toWarehouseSelect.closest('.col-md-4').style.display = 'none';
      toWarehouseSelect.value = '';
    }
  }

  movementTypeSelect.addEventListener('change', toggleWarehouseFields);

  modalStockMove.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formStockMove);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Stock Movement';

      apiClient.show(API_ENDPOINTS.INVENTORY.STOCK_MOVEMENTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('movement-id').value = item.id;
          formStockMove.querySelector('[name="product_id"]').value = item.product_id || '';
          formStockMove.querySelector('[name="movement_type"]').value = item.movement_type || '';
          formStockMove.querySelector('[name="quantity"]').value = item.quantity || '';
          formStockMove.querySelector('[name="from_warehouse_id"]').value = item.from_warehouse_id || '';
          formStockMove.querySelector('[name="to_warehouse_id"]').value = item.to_warehouse_id || '';
          formStockMove.querySelector('[name="reason"]').value = item.reason || '';
          toggleWarehouseFields();
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Stock Movement';
      formStockMove.reset();
      document.getElementById('movement-id').value = '';
      toggleWarehouseFields();
    }
  });

  formStockMove.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('movement-id').value;

    const formData = new FormData(formStockMove);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.INVENTORY.STOCK_MOVEMENTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.INVENTORY.STOCK_MOVEMENTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalStockMove).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formStockMove, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.INVENTORY.STOCK_MOVEMENTS.DESTROY, deleteId)
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