@extends('layouts.erp')

@section('title', 'Routes & Delivery')
@section('breadcrumb', 'Routes & Delivery')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Routes & Delivery</div>
      <div class="page-subtitle">Define delivery routes and optimize last-mile logistics</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalRoute" data-mode="create"><i class="bi bi-plus-lg"></i> New Route</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search routes & delivery…" />
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
            <th>Route Name</th>
            <th>Zone</th>
            <th>Driver</th>
            <th>Vehicle</th>
            <th>Stops</th>
            <th>Avg. Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $route)
            <tr>
              <td>{{ $route->route_name }}</td>
              <td>{{ $route->zone_area ?? 'N/A' }}</td>
              <td>{{ $route->driver_name ?? 'N/A' }}</td>
              <td>{{ $route->vehicle_id ?? 'N/A' }}</td>
              <td>{{ $route->number_of_stops ?? 0 }} stops</td>
              <td>—</td>
              <td>
                @if ($route->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $route->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalRoute"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-delete-id="{{ $route->id }}"
                    data-delete-label="Route"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No routes found.</td>
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

  <div class="modal fade" id="modalRoute" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Delivery Route</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-route">
          <div class="modal-body">
            <input type="hidden" name="id" id="route-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Route Name</label>
                <input class="erp-form-control" type="text" name="route_name" id="route-name" placeholder="" required />
                <div class="invalid-feedback" id="error-route_name"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Zone / Area</label>
                <input class="erp-form-control" type="text" name="zone_area" id="zone-area" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Driver</label>
                <input class="erp-form-control" type="text" name="driver_name" id="driver-name" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Vehicle ID</label>
                <input class="erp-form-control" type="text" name="vehicle_id" id="vehicle-id" placeholder="TRK-XXX" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">No. of Stops</label>
                <input class="erp-form-control" type="number" name="number_of_stops" id="number-of-stops" placeholder="" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Route Description / Stops</label>
                <textarea class="erp-form-control" name="route_description" id="route-description" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-route_description"></div>
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
              <i class="bi bi-check2"></i> Save Route
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
  const modalRoute = document.getElementById('modalRoute');
  const formRoute = document.getElementById('form-route');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalRoute.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formRoute);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Delivery Route';

      apiClient.show(API_ENDPOINTS.LOGISTICS.ROUTES.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('route-id').value = item.id;
          formRoute.querySelector('[name="route_name"]').value = item.route_name || '';
          formRoute.querySelector('[name="zone_area"]').value = item.zone_area || '';
          formRoute.querySelector('[name="driver_name"]').value = item.driver_name || '';
          formRoute.querySelector('[name="vehicle_id"]').value = item.vehicle_id || '';
          formRoute.querySelector('[name="number_of_stops"]').value = item.number_of_stops || '';
          formRoute.querySelector('[name="route_description"]').value = item.route_description || '';
          formRoute.querySelector('[name="status"]').value = item.status || 'Active';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Delivery Route';
      formRoute.reset();
      document.getElementById('route-id').value = '';
    }
  });

  formRoute.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('route-id').value;

    const formData = new FormData(formRoute);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.LOGISTICS.ROUTES.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.LOGISTICS.ROUTES.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalRoute).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formRoute, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.LOGISTICS.ROUTES.DESTROY, deleteId)
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