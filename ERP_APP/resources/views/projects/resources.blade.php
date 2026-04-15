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
                          data-bs-toggle="modal"
                          data-bs-target="#modalResource"
                          data-mode="edit"
                          data-id="{{ $resource->id }}"
                          data-employee="{{ $resource->employee_id }}"
                          data-role="{{ $resource->role_on_project }}"
                          data-project="{{ $resource->project_id }}"
                          data-allocation="{{ $resource->allocation_percentage }}"
                          data-from="{{ $resource->from_date }}"
                          data-to="{{ $resource->to_date }}"
                          title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                          data-bs-toggle="modal"
                          data-bs-target="#modalDelete"
                          data-id="{{ $resource->id }}"
                          data-label="Resource Assignment"
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
    fetch('{{ route("resources.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#resources-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#resources-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalResource"]').forEach(btn => {
    btn.addEventListener('click', function() {
      const mode = this.dataset.mode || 'create';
      const form = document.getElementById('formResource');
      form.reset();
      document.getElementById('resource_id').value = '';
      document.getElementById('modalResourceTitle').textContent = mode === 'edit' ? 'Edit Resource' : 'Assign Resource';
    });
  });

  document.querySelector('#tbl-resources').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      document.getElementById('modalResourceTitle').textContent = 'Edit Resource';
      document.getElementById('resource_id').value = btn.dataset.id;
      document.getElementById('resource_employee_id').value = btn.dataset.employee || '';
      document.getElementById('resource_project_id').value = btn.dataset.project || '';
      document.getElementById('resource_allocation').value = btn.dataset.allocation || '';
      document.getElementById('resource_from_date').value = btn.dataset.from || '';
      document.getElementById('resource_to_date').value = btn.dataset.to || '';
      document.getElementById('resource_role').value = btn.dataset.role || '';
    }
  });

  document.querySelector('#tbl-resources').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formResource').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('resource_id').value;
    const url = id ? '{{ route("resources.update", ["id" => ":id"]) }}'.replace(':id', id) : '{{ route("resources.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      employee_id: document.getElementById('resource_employee_id').value,
      project_id: document.getElementById('resource_project_id').value,
      allocation_percentage: document.getElementById('resource_allocation').value,
      from_date: document.getElementById('resource_from_date').value,
      to_date: document.getElementById('resource_to_date').value,
      role_on_project: document.getElementById('resource_role').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'Resource updated successfully' : 'Resource assigned successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalResource')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving resource', 'error');
      }
    })
    .catch(() => showToast('Error saving resource', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("resources.destroy", ["id" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Resource deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting resource', 'error');
      }
    })
    .catch(() => showToast('Error deleting resource', 'error'));
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