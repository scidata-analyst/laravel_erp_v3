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
                            data-id="{{ $task->id }}"
                            data-mode="edit"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalTask" 
                            title="Edit">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                            data-delete-id="{{ $task->id }}"
                            data-delete-label="Task"
                            data-bs-toggle="modal" 
                            data-bs-target="#modalDelete" 
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
document.addEventListener('DOMContentLoaded', function() {
  const modalTask = document.getElementById('modalTask');
  const formTask = document.getElementById('formTask');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalTask.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formTask);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalTaskTitle');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Task';

      apiClient.show(API_ENDPOINTS.PROJECTS.TASKS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('task_id').value = item.id;
          formTask.querySelector('[name="task_title"]').value = item.task_title || '';
          formTask.querySelector('[name="project_id"]').value = item.project_id || '';
          formTask.querySelector('[name="assigned_user_id"]').value = item.assigned_user_id || '';
          formTask.querySelector('[name="priority"]').value = item.priority || 'Low';
          formTask.querySelector('[name="due_date"]').value = item.due_date ? item.due_date.split('T')[0] : '';
          formTask.querySelector('[name="status"]').value = item.status || 'Todo';
          formTask.querySelector('[name="description"]').value = item.description || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Task';
      formTask.reset();
      document.getElementById('task_id').value = '';
    }
  });

  formTask.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('task_id').value;

    const formData = new FormData(formTask);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PROJECTS.TASKS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PROJECTS.TASKS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalTask).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formTask, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PROJECTS.TASKS.DESTROY, deleteId)
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