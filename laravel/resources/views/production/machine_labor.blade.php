@extends('layouts.erp')

@section('title', 'Machine & Labor')
@section('breadcrumb', 'Production / Machine & Labor')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Machine & Labor</div>
      <div class="page-subtitle">Track machine utilization and labor hours on production</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalMachineLabor" data-mode="create"><i class="bi bi-plus-lg"></i> Log Entry</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search machine & labor…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Machine</option>
        <option>Labor</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Work Order</th>
            <th>Resource</th>
            <th>Type</th>
            <th>Scheduled Hours</th>
            <th>Actual Hours</th>
            <th>Cost/hr</th>
            <th>Total Cost</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $ml)
            <tr>
              <td>WO-{{ $ml->work_order_id ?? 'N/A' }}</td>
              <td>{{ $ml->resource_name ?? 'N/A' }}</td>
              <td>{{ $ml->resource_type ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $ml->hours_used ?? 0 }}h</td>
              <td>${{ number_format($ml->cost_per_hour ?? 0, 2) }}</td>
              <td>${{ number_format($ml->total_cost ?? 0, 2) }}</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $ml->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalMachineLabor"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-delete-id="{{ $ml->id }}"
                    data-delete-label="Entry"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
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


  <div class="modal fade" id="modalMachineLabor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Log Machine / Labor Entry</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-machine-labor">
          <div class="modal-body">
            <input type="hidden" name="id" id="machine-labor-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Work Order</label>
                <input class="erp-form-control" type="number" name="work_order_id" id="work-order-id" placeholder="WO ID" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Resource Name</label>
                <input class="erp-form-control" type="text" name="resource_name" id="resource-name" placeholder="Machine or employee name" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Type</label>
                <select class="erp-form-control" name="resource_type" id="resource-type">
                  <option value="Machine">Machine</option>
                  <option value="Labor">Labor</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Hours Used</label>
                <input class="erp-form-control" type="number" name="hours_used" id="hours-used" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Cost per Hour ($)</label>
                <input class="erp-form-control" type="number" name="cost_per_hour" id="cost-per-hour" placeholder="" />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Log Entry
            </button>
          </div>
        </form>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalMachineLabor = document.getElementById('modalMachineLabor');
  const formMachineLabor = document.getElementById('form-machine-labor');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalMachineLabor.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formMachineLabor);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Machine / Labor Entry';

      apiClient.show(API_ENDPOINTS.PRODUCTION.MACHINE_LABOR.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('machine-labor-id').value = item.id;
          formMachineLabor.querySelector('[name="work_order_id"]').value = item.work_order_id || '';
          formMachineLabor.querySelector('[name="resource_name"]').value = item.resource_name || '';
          formMachineLabor.querySelector('[name="resource_type"]').value = item.resource_type || 'Machine';
          formMachineLabor.querySelector('[name="hours_used"]').value = item.hours_used || '';
          formMachineLabor.querySelector('[name="cost_per_hour"]').value = item.cost_per_hour || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Log Machine / Labor Entry';
      formMachineLabor.reset();
      document.getElementById('machine-labor-id').value = '';
    }
  });

  formMachineLabor.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('machine-labor-id').value;

    const formData = new FormData(formMachineLabor);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PRODUCTION.MACHINE_LABOR.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PRODUCTION.MACHINE_LABOR.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalMachineLabor).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formMachineLabor, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PRODUCTION.MACHINE_LABOR.DESTROY, deleteId)
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
