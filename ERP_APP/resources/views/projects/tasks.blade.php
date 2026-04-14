@extends('layouts.erp')

@section('title', 'Tasks & Milestones')
@section('breadcrumb', 'Projects / Tasks & Milestones')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Tasks &amp; Milestones</div>
      <div class="page-subtitle">Project task management and milestone tracking</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalTask"><i
        class="bi bi-plus-lg"></i> Add Task</button>
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
        <table class="erp-table">
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
          <tbody>
            @foreach ($data as $task)
              <tr>
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
                  <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                      data-bs-target="#modalTask" title="Edit"><i class="bi bi-pencil"></i></button><button
                      class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                      data-delete-label="Task" title="Delete"><i class="bi bi-trash"></i></button></div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalTask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Task</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12"><label class="erp-form-label">Task Title</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Project</label><input class="erp-form-control"
                type="text" placeholder="Project name" /></div>
            <div class="col-md-6"><label class="erp-form-label">Assignee</label><select class="erp-form-control">
                <option>Adam K.</option>
                <option>Sara L.</option>
                <option>James R.</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Priority</label><select class="erp-form-control">
                <option>High</option>
                <option>Medium</option>
                <option>Low</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Due Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control">
                <option>Todo</option>
                <option>In Progress</option>
                <option>Review</option>
                <option>Done</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="3" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Task
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
  </div>
@endsection