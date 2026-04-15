@extends('layouts.erp')

@section('title', 'Tasks & Milestones')
@section('breadcrumb', 'Projects / Tasks & Milestones')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Tasks &amp; Milestones</div>
      <div class="page-subtitle">Project task management and milestone tracking</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalTask" data-mode="create">
      <i class="bi bi-plus-lg"></i> Add Task
    </button>
  </div>
  <div class="erp-card">
    <div class="erp-tabs">
      <div class="erp-tab active" data-tab="tab-kanban">Kanban</div>
      <div class="erp-tab" data-tab="tab-list">List View</div>
    </div>
    <div id="tab-kanban" class="tab-panel active">
      <div class="row g-3">
        <div class="col-md-3">
          <div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
            <div class="d-flex justify-content-between align-items-center mb-3"><span
                style="font-size:12px;font-weight:600;color:var(--text-muted)">TODO</span><span
                class="badge-status badge-info">3</span></div>
            <div class="erp-card mb-2" style="padding:12px;cursor:drag">
              <div style="font-size:13px;font-weight:500">Design mockups</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Due: Jan 20</div>
              <div class="d-flex gap-1 mt-2"><span class="tag">Design</span></div>
            </div>
            <div class="erp-card mb-2" style="padding:12px;cursor:drag">
              <div style="font-size:13px;font-weight:500">Backend API docs</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Due: Jan 22</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
            <div class="d-flex justify-content-between align-items-center mb-3"><span
                style="font-size:12px;font-weight:600;color:var(--accent-4)">IN PROGRESS</span><span
                class="badge-status badge-pending">2</span></div>
            <div class="erp-card mb-2" style="padding:12px;cursor:grab;border-color:var(--accent-4)">
              <div style="font-size:13px;font-weight:500">Database migration</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Due: Jan 15</div>
              <div class="erp-progress mt-2">
                <div class="erp-progress-bar" style="width:65%;background:var(--accent-4)"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
            <div class="d-flex justify-content-between align-items-center mb-3"><span
                style="font-size:12px;font-weight:600;color:var(--accent)">REVIEW</span><span
                class="badge-status badge-info">1</span></div>
            <div class="erp-card mb-2" style="padding:12px;cursor:grab;border-color:var(--accent)">
              <div style="font-size:13px;font-weight:500">QA Testing round 2</div>
              <div style="font-size:11px;color:var(--text-muted);margin-top:4px">Due: Jan 14</div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
            <div class="d-flex justify-content-between align-items-center mb-3"><span
                style="font-size:12px;font-weight:600;color:var(--accent-2)">DONE</span><span
                class="badge-status badge-active">4</span></div>
            <div class="erp-card mb-2" style="padding:12px;opacity:.7">
              <div style="font-size:13px;font-weight:500;text-decoration:line-through">Setup dev environment</div>
            </div>
            <div class="erp-card mb-2" style="padding:12px;opacity:.7">
              <div style="font-size:13px;font-weight:500;text-decoration:line-through">Write user stories</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="tab-list" class="tab-panel">
      <div class="erp-table-wrap">
        <table class="erp-table" id="tbl-tasks">
          <thead>
            <tr>
              <th>Task</th>
              <th>Project</th>
              <th>Assignee</th>
              <th>Priority</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody id="tasks-tbody">
            @forelse ($data as $task)
              <tr data-id="{{ $task->id }}">
                <td>{{ $task->task_title }}</td>
                <td>{{ $task->project_name ?? 'N/A' }}</td>
                <td>{{ $task->assigned_user_id ?? 'N/A' }}</td>
                <td>
                  @if ($task->priority == 'High')
                    <span class="badge-status badge-inactive">High</span>
                  @elseif ($task->priority == 'Medium')
                    <span class="badge-status badge-pending">Medium</span>
                  @else
                    <span class="badge-status badge-info">Low</span>
                  @endif
                </td>
                <td>{{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d') : 'N/A' }}</td>
                <td>
                  @if ($task->status == 'Completed')
                    <span class="badge-status badge-active">Completed</span>
                  @elseif ($task->status == 'In Progress')
                    <span class="badge-status badge-pending">In Progress</span>
                  @else
                    <span class="badge-status badge-info">{{ $task->status }}</span>
                  @endif
                </td>
                <td>
                  <div class="d-flex gap-1">
                    <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTask" 
                            data-mode="edit"
                            data-id="{{ $task->id }}"
                            data-title="{{ $task->task_title }}"
                            data-project="{{ $task->project_id }}"
                            data-assignee="{{ $task->assigned_user_id }}"
                            data-priority="{{ $task->priority }}"
                            data-due="{{ $task->due_date }}"
                            data-status="{{ $task->status }}"
                            data-description="{{ $task->description ?? '' }}"
                            title="Edit">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                            data-bs-toggle="modal" 
                            data-bs-target="#modalDelete" 
                            data-id="{{ $task->id }}"
                            data-label="Task"
                            title="Delete">
                      <i class="bi bi-trash"></i>
                    </button>
                  </div>
                </td>
              </tr>
            @empty
              <tr><td colspan="7" class="text-center text-muted">No tasks found</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalTask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modalTaskTitle" style="color:var(--text-primary);font-weight:600">Add Task</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formTask">
          <div class="modal-body">
            <input type="hidden" id="task_id" name="id">
            <div class="row g-3">
              <div class="col-md-12">
                <label class="erp-form-label">Task Title</label>
                <input class="erp-form-control" type="text" id="task_title" name="task_title" placeholder="Task title" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Project</label>
                <select class="erp-form-control" id="task_project_id" name="project_id">
                  <option value="">Select Project</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Assignee</label>
                <select class="erp-form-control" id="task_assigned_user_id" name="assigned_user_id">
                  <option value="">Select Assignee</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Priority</label>
                <select class="erp-form-control" id="task_priority" name="priority">
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Due Date</label>
                <input class="erp-form-control" type="date" id="task_due_date" name="due_date" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" id="task_status" name="status">
                  <option value="Todo">Todo</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Review">Review</option>
                  <option value="Done">Done</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Description</label>
                <textarea class="erp-form-control" id="task_description" name="description" rows="3" placeholder="Task description"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Task
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
  let currentMode = 'create';
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
    fetch('{{ route("tasks.index") }}')
      .then(res => res.text())
      .then(html => {
        const tbody = document.querySelector('#tasks-tbody');
        const parser = new DOMParser();
        const doc = parser.parseFromString(html, 'text/html');
        const newTbody = doc.querySelector('#tasks-tbody');
        if (tbody && newTbody) tbody.innerHTML = newTbody.innerHTML;
      });
  }

  document.querySelectorAll('[data-bs-target="#modalTask"]').forEach(btn => {
    btn.addEventListener('click', function() {
      currentMode = this.dataset.mode || 'create';
      const form = document.getElementById('formTask');
      form.reset();
      document.getElementById('task_id').value = '';
      document.getElementById('modalTaskTitle').textContent = currentMode === 'edit' ? 'Edit Task' : 'Add Task';
    });
  });

  document.querySelector('#tbl-tasks').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-edit');
    if (btn) {
      currentMode = 'edit';
      document.getElementById('modalTaskTitle').textContent = 'Edit Task';
      document.getElementById('task_id').value = btn.dataset.id;
      document.getElementById('task_title').value = btn.dataset.title || '';
      document.getElementById('task_project_id').value = btn.dataset.project || '';
      document.getElementById('task_assigned_user_id').value = btn.dataset.assignee || '';
      document.getElementById('task_priority').value = btn.dataset.priority || 'Low';
      document.getElementById('task_due_date').value = btn.dataset.due || '';
      document.getElementById('task_status').value = btn.dataset.status || 'Todo';
      document.getElementById('task_description').value = btn.dataset.description || '';
    }
  });

  document.querySelector('#tbl-tasks').addEventListener('click', function(e) {
    const btn = e.target.closest('.btn-delete');
    if (btn) {
      deleteId = btn.dataset.id;
      document.getElementById('delete_id').value = deleteId;
      document.getElementById('delete-target').textContent = btn.dataset.label || 'record';
    }
  });

  document.getElementById('formTask').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('task_id').value;
    const url = id ? '{{ route("tasks.update", ["task" => ":id"]) }}'.replace(':id', id) : '{{ route("tasks.store") }}';
    const method = id ? 'PUT' : 'POST';

    const formData = {
      task_title: document.getElementById('task_title').value,
      project_id: document.getElementById('task_project_id').value,
      assigned_user_id: document.getElementById('task_assigned_user_id').value,
      priority: document.getElementById('task_priority').value,
      due_date: document.getElementById('task_due_date').value,
      status: document.getElementById('task_status').value,
      description: document.getElementById('task_description').value,
    };

    fetch(url, {
      method: method,
      headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast(id ? 'Task updated successfully' : 'Task created successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalTask')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error saving task', 'error');
      }
    })
    .catch(() => showToast('Error saving task', 'error'));
  });

  document.getElementById('btn-confirm-delete').addEventListener('click', function() {
    if (!deleteId) return;
    fetch('{{ route("tasks.destroy", ["task" => ":id"]) }}'.replace(':id', deleteId), {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        showToast('Task deleted successfully');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        reloadTable();
      } else {
        showToast(data.message || 'Error deleting task', 'error');
      }
    })
    .catch(() => showToast('Error deleting task', 'error'));
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