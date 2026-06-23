@extends('layouts.erp')

@section('title', 'Project Cost Tracking')
@section('breadcrumb', 'Projects / Project Cost Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Project Cost Tracking</div>
      <div class="page-subtitle">Monitor budgets, expenses and cost variance per project</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProjectCost" data-mode="create">
        <i class="bi bi-plus-lg"></i> Log Cost
      </button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-cost" placeholder="Search project cost tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>On Budget</option>
        <option>Over Budget</option>
        <option>Under Budget</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-cost">
        <thead>
          <tr>
            <th>Project</th>
            <th>Budget</th>
            <th>Spent</th>
            <th>Remaining</th>
            <th>% Used</th>
            <th>Variance</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody id="cost-tbody">
          @forelse ($data as $cost)
            <tr data-id="{{ $cost->id }}">
              <td>{{ $cost->project_name ?? 'N/A' }}</td>
              <td>$0</td>
              <td>${{ number_format($cost->amount ?? 0, 2) }}</td>
              <td>$0</td>
              <td>0%</td>
              <td>$0</td>
              <td>
                @if ($cost->status == 'Approved')
                  <span class="badge-status badge-pending">On Budget</span>
                @else
                  <span class="badge-status badge-info">{{ $cost->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                          data-id="{{ $cost->id }}"
                          data-mode="edit"
                          data-bs-toggle="modal"
                          data-bs-target="#modalProjectCost"
                          title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                          data-delete-id="{{ $cost->id }}"
                          data-delete-label="Cost Entry"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDelete"
                          title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr><td colspan="8" class="text-center text-muted">No cost entries found</td></tr>
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

  <div class="modal fade" id="modalProjectCost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modalProjectCostTitle" style="color:var(--text-primary);font-weight:600">Log Project Cost</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formProjectCost">
          <div class="modal-body">
            <input type="hidden" id="cost_id" name="id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Project</label>
                <select class="erp-form-control" id="cost_project_id" name="project_id">
                  <option value="">Select Project</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Cost Category</label>
                <select class="erp-form-control" id="cost_category" name="category">
                  <option value="">Select Category</option>
                  <option value="Labor">Labor</option>
                  <option value="Material">Material</option>
                  <option value="Overhead">Overhead</option>
                  <option value="Software License">Software License</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Amount ($)</label>
                <input class="erp-form-control" type="number" id="cost_amount" name="amount" step="0.01" min="0" placeholder="0.00" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Date Incurred</label>
                <input class="erp-form-control" type="date" id="cost_incurred_date" name="incurred_date" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Approved By</label>
                <select class="erp-form-control" id="cost_approved_by" name="approved_by">
                  <option value="">Select Approver</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Description</label>
                <textarea class="erp-form-control" id="cost_description" name="description" rows="2" placeholder="Cost description"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Log Cost
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
  const modalProjectCost = document.getElementById('modalProjectCost');
  const formProjectCost = document.getElementById('formProjectCost');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalProjectCost.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formProjectCost);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalProjectCostTitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Cost';

      apiClient.show(API_ENDPOINTS.PROJECTS.PROJECT_COST.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('cost_id').value = item.id;
          formProjectCost.querySelector('[name="project_id"]').value = item.project_id || '';
          formProjectCost.querySelector('[name="category"]').value = item.category || '';
          formProjectCost.querySelector('[name="amount"]').value = item.amount || '';
          formProjectCost.querySelector('[name="incurred_date"]').value = item.incurred_date || '';
          formProjectCost.querySelector('[name="approved_by"]').value = item.approved_by || '';
          formProjectCost.querySelector('[name="description"]').value = item.description || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Log Project Cost';
      formProjectCost.reset();
      document.getElementById('cost_id').value = '';
    }
  });

  formProjectCost.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('cost_id').value;

    const formData = new FormData(formProjectCost);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PROJECTS.PROJECT_COST.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PROJECTS.PROJECT_COST.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalProjectCost).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formProjectCost, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PROJECTS.PROJECT_COST.DESTROY, deleteId)
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