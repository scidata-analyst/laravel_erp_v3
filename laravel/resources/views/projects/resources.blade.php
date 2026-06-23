@extends('layouts.erp')

@section('title', 'Resource Allocation')
@section('breadcrumb', 'Projects / Resource Allocation')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Resource Allocation</div>
      <div class="page-subtitle">Assign team members and assets to projects</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalResource" data-mode="create">
        <i class="bi bi-plus-lg"></i> Assign Resource
      </button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-resources" placeholder="Search resource allocation…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>ERP v2</option>
        <option>Mobile App</option>
        <option>Infrastructure</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-resources">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Role</th>
            <th>Project</th>
            <th>Allocation %</th>
            <th>From</th>
            <th>To</th>
            <th>Availability</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="resources-tbody">
          @forelse ($data as $resource)
            <tr data-id="{{ $resource->id }}">
              <td>{{ $resource->employee_id ?? 'N/A' }}</td>
              <td>{{ $resource->role_on_project ?? 'N/A' }}</td>
              <td>{{ $resource->project_name ?? 'N/A' }}</td>
              <td>{{ $resource->allocation_percentage ?? 0 }}%</td>
              <td>{{ $resource->from_date ? \Carbon\Carbon::parse($resource->from_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $resource->to_date ? \Carbon\Carbon::parse($resource->to_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ 100 - ($resource->allocation_percentage ?? 0) }}% free</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                          data-id="{{ $resource->id }}"
                          data-mode="edit"
                          data-bs-toggle="modal"
                          data-bs-target="#modalResource"
                          title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                          data-delete-id="{{ $resource->id }}"
                          data-delete-label="Resource Assignment"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDelete"
                          title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center text-muted">No resources found</td></tr>
          @endforelse
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

  <div class="modal fade" id="modalResource" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modalResourceTitle" style="color:var(--text-primary);font-weight:600">Assign Resource</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formResource">
          <div class="modal-body">
            <input type="hidden" id="resource_id" name="id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Employee</label>
                <select class="erp-form-control" id="resource_employee_id" name="employee_id">
                  <option value="">Select Employee</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Project</label>
                <select class="erp-form-control" id="resource_project_id" name="project_id">
                  <option value="">Select Project</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Allocation (%)</label>
                <input class="erp-form-control" type="number" id="resource_allocation" name="allocation_percentage" min="0" max="100" placeholder="0-100" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">From Date</label>
                <input class="erp-form-control" type="date" id="resource_from_date" name="from_date" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">To Date</label>
                <input class="erp-form-control" type="date" id="resource_to_date" name="to_date" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Role on Project</label>
                <input class="erp-form-control" type="text" id="resource_role" name="role_on_project" placeholder="e.g. Lead Developer" />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Assignment
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
            Are you sure you want to delete this <strong id="delete-target">record</strong>? This action cannot be undone.
          </p>
          <input type="hidden" id="delete_id">
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
  const modalResource = document.getElementById('modalResource');
  const formResource = document.getElementById('formResource');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalResource.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formResource);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalResourceTitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Resource';

      apiClient.show(API_ENDPOINTS.PROJECTS.RESOURCES.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('resource_id').value = item.id;
          formResource.querySelector('[name="employee_id"]').value = item.employee_id || '';
          formResource.querySelector('[name="project_id"]').value = item.project_id || '';
          formResource.querySelector('[name="allocation_percentage"]').value = item.allocation_percentage || '';
          formResource.querySelector('[name="from_date"]').value = item.from_date ? item.from_date.split('T')[0] : '';
          formResource.querySelector('[name="to_date"]').value = item.to_date ? item.to_date.split('T')[0] : '';
          formResource.querySelector('[name="role_on_project"]').value = item.role_on_project || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Assign Resource';
      formResource.reset();
      document.getElementById('resource_id').value = '';
    }
  });

  formResource.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('resource_id').value;

    const formData = new FormData(formResource);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PROJECTS.RESOURCES.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PROJECTS.RESOURCES.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalResource).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formResource, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PROJECTS.RESOURCES.DESTROY, deleteId)
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