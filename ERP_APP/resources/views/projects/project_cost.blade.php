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
                          data-bs-toggle="modal"
                          data-bs-target="#modalProjectCost"
                          data-mode="edit"
                          data-id="{{ $cost->id }}"
                          data-project="{{ $cost->project_id }}"
                          data-category="{{ $cost->category }}"
                          data-amount="{{ $cost->amount }}"
                          data-date="{{ $cost->incurred_date }}"
                          data-approved="{{ $cost->approved_by }}"
                          data-description="{{ $cost->description ?? '' }}"
                          title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDelete"
                          data-id="{{ $cost->id }}"
                          data-label="Cost Entry"
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
(function() {
  let deleteId = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => { toast.classList.remove('show'); setTimeout(() => toast.remove(), 300); }, 3000);
  }

  function reloadTable() {
    fetch('{{ route("project_cost.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#cost-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#cost-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalProjectCost"]').forEach(btn => {
    btn.addEventListener('click', function() {
      const mode = this.dataset.mode || 'create';
      const form = document.getElementById('formProjectCost');
      form.reset();
      document.getElementById('cost_id').value = '';
      document.getElementById('modalProjectCostTitle').textContent = mode === 'edit' ? 'Edit Cost' : 'Log Project Cost';
    });
  });

  document.querySelector('#tbl-cost').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      document.getElementById('modalProjectCostTitle').textContent = 'Edit Cost';
      document.getElementById('cost_id').value = btn.dataset.id;
      document.getElementById('cost_project_id').value = btn.dataset.project || '';
      document.getElementById('cost_category').value = btn.dataset.category || '';
      document.getElementById('cost_amount').value = btn.dataset.amount || '';
      document.getElementById('cost_incurred_date').value = btn.dataset.date || '';
      document.getElementById('cost_approved_by').value = btn.dataset.approved || '';
      document.getElementById('cost_description').value = btn.dataset.description || '';
    }
  });

  document.querySelector('#tbl-cost').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formProjectCost').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('cost_id').value;
    const url = id ? '{{ route("project_cost.update", ["project_cost" => ":id"]) }}'.replace(':id', id) : '{{ route("project_cost.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      project_id: document.getElementById('cost_project_id').value,
      category: document.getElementById('cost_category').value,
      amount: document.getElementById('cost_amount').value,
      incurred_date: document.getElementById('cost_incurred_date').value,
      approved_by: document.getElementById('cost_approved_by').value,
      description: document.getElementById('cost_description').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'Cost updated successfully' : 'Cost logged successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalProjectCost')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving cost', 'error');
      }
    })
    .catch(() => showToast('Error saving cost', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("project_cost.destroy", ["project_cost" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Cost deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting cost', 'error');
      }
    })
    .catch(() => showToast('Error deleting cost', 'error'));
  });
})();
</script>
<style>
.toast-notification {
  position: fixed;
  bottom: 20px;
  right: 20px;
  padding: 12px 20px;
  background: var(--bg-elevated);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  color: var(--text-primary);
  font-size: 14px;
  z-index: 9999;
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
}
.toast-notification.show { opacity: 1; transform: translateY(0); }
.toast-success i { color: var(--accent-2); }
.toast-error i { color: var(--accent-3); }
</style>
@endpush