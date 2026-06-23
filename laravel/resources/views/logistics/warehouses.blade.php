@extends('layouts.erp')

@section('title', 'Multi-Warehouse Management')
@section('breadcrumb', 'Multi-Warehouse Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Multi-Warehouse Management</div>
      <div class="page-subtitle">Manage multiple warehouse locations and capacity</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarehouse" data-mode="create"><i class="bi bi-plus-lg"></i> Add Warehouse</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search multi-warehouse management…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Inactive</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Warehouse</th>
            <th>Code</th>
            <th>Location</th>
            <th>Manager</th>
            <th>Capacity</th>
            <th>Used</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $warehouse)
            <tr>
              <td>{{ $warehouse->warehouse_name }}</td>
              <td>{{ $warehouse->warehouse_code }}</td>
              <td>{{ $warehouse->location_address ?? 'N/A' }}</td>
              <td>{{ $warehouse->manager_id ?? 'N/A' }}</td>
              <td>{{ number_format($warehouse->capacity_units ?? 0) }} units</td>
              <td>0 (0%)</td>
              <td>
                @if ($warehouse->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $warehouse->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalWarehouse"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-delete-id="{{ $warehouse->id }}"
                    data-delete-label="Warehouse"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No warehouses found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-5">
      <div>
        Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
      </div>
      <div>
        {{ $data->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalWarehouse" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Warehouse</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-warehouse">
          <div class="modal-body">
            <input type="hidden" name="id" id="warehouse-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Warehouse Name</label>
                <input class="erp-form-control" type="text" name="warehouse_name" id="warehouse-name" placeholder="" required />
                <div class="invalid-feedback" id="error-warehouse_name"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Code</label>
                <input class="erp-form-control" type="text" name="warehouse_code" id="warehouse-code" placeholder="WH-X" required />
                <div class="invalid-feedback" id="error-warehouse_code"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Type</label>
                <select class="erp-form-control" name="warehouse_type" id="warehouse-type">
                  <option value="Standard">Standard</option>
                  <option value="Cold Storage">Cold Storage</option>
                  <option value="Bonded">Bonded</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Location / Address</label>
                <input class="erp-form-control" type="text" name="location_address" id="location-address" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Manager</label>
                <input class="erp-form-control" type="text" name="manager_id" id="manager-id" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Capacity (units)</label>
                <input class="erp-form-control" type="number" name="capacity_units" id="capacity-units" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Save Warehouse
            </button>
          </div>
        </form>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalWarehouse = document.getElementById('modalWarehouse');
  const formWarehouse = document.getElementById('form-warehouse');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalWarehouse.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formWarehouse);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Warehouse';

      apiClient.show(API_ENDPOINTS.LOGISTICS.WAREHOUSES.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('warehouse-id').value = item.id;
          formWarehouse.querySelector('[name="warehouse_name"]').value = item.warehouse_name || '';
          formWarehouse.querySelector('[name="warehouse_code"]').value = item.warehouse_code || '';
          formWarehouse.querySelector('[name="warehouse_type"]').value = item.warehouse_type || 'Standard';
          formWarehouse.querySelector('[name="location_address"]').value = item.location_address || '';
          formWarehouse.querySelector('[name="manager_id"]').value = item.manager_id || '';
          formWarehouse.querySelector('[name="capacity_units"]').value = item.capacity_units || '';
          formWarehouse.querySelector('[name="status"]').value = item.status || 'Active';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Warehouse';
      formWarehouse.reset();
      document.getElementById('warehouse-id').value = '';
    }
  });

  formWarehouse.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('warehouse-id').value;

    const formData = new FormData(formWarehouse);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.LOGISTICS.WAREHOUSES.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.LOGISTICS.WAREHOUSES.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalWarehouse).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formWarehouse, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.LOGISTICS.WAREHOUSES.DESTROY, deleteId)
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