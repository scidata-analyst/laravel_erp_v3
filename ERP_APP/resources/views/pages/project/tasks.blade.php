@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">Tasks &amp; Milestones</div><div class="page-subtitle">Project task management and milestone tracking</div></div>
  <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalTask" id="btnAddTask"><i class="bi bi-plus-lg"></i> Add Task</button>
</div>
<div class="erp-card">
  <div class="erp-tabs">
    <div class="erp-tab active" data-tab="tab-kanban">Kanban</div>
    <div class="erp-tab" data-tab="tab-list">List View</div>
  </div>
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" id="task-search" placeholder="Search tasks and milestones..."/>
    </div>
    <select class="erp-form-control" id="task-status-filter" name="status" style="width:150px">
      <option>All Status</option>
      <option>Todo</option>
      <option>In Progress</option>
      <option>Review</option>
      <option>Done</option>
    </select>
    <select class="erp-form-control" id="task-per-page" style="width:90px">
      <option value="10">10</option>
      <option value="20" selected>20</option>
      <option value="50">50</option>
      <option value="100">100</option>
    </select>
  </div>
  <div id="tab-kanban" class="tab-panel active">
    <div class="row g-3">
      <div class="col-md-3"><div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
        <div class="d-flex justify-content-between align-items-center mb-3"><span style="font-size:12px;font-weight:600;color:var(--text-muted)">TODO</span><span class="badge-status badge-info" id="kanban-todo-count">0</span></div>
        <div id="kanban-todo"></div>
      </div></div>
      <div class="col-md-3"><div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
        <div class="d-flex justify-content-between align-items-center mb-3"><span style="font-size:12px;font-weight:600;color:var(--accent-4)">IN PROGRESS</span><span class="badge-status badge-pending" id="kanban-progress-count">0</span></div>
        <div id="kanban-progress"></div>
      </div></div>
      <div class="col-md-3"><div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
        <div class="d-flex justify-content-between align-items-center mb-3"><span style="font-size:12px;font-weight:600;color:var(--accent)">REVIEW</span><span class="badge-status badge-info" id="kanban-review-count">0</span></div>
        <div id="kanban-review"></div>
      </div></div>
      <div class="col-md-3"><div style="background:var(--bg-elevated);border-radius:var(--radius);padding:12px">
        <div class="d-flex justify-content-between align-items-center mb-3"><span style="font-size:12px;font-weight:600;color:var(--accent-2)">DONE</span><span class="badge-status badge-active" id="kanban-done-count">0</span></div>
        <div id="kanban-done"></div>
      </div></div>
    </div>
  </div>
  <div id="tab-list" class="tab-panel">
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-tasks">
        <thead><tr><th>Task</th><th>Project</th><th>Assignee</th><th>Priority</th><th>Due Date</th><th>Status</th><th>Progress</th><th>Actions</th></tr></thead>
        <tbody></tbody>
      </table>
    </div>
  </div>
  <div class="erp-pagination" id="task-pagination"></div>
</div>

<div class="modal fade" id="modalTask" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Task</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-12"><label class="erp-form-label">Task Title</label><input class="erp-form-control" name="title" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Project ID</label><input class="erp-form-control" name="project_id" type="text" placeholder="Project ID"/></div>
          <div class="col-md-6"><label class="erp-form-label">Assigned To</label><input class="erp-form-control" name="assigned_to" type="text" placeholder="Assignee name"/></div>
          <div class="col-md-4"><label class="erp-form-label">Priority</label><select class="erp-form-control" name="priority"><option value="High">High</option><option value="Medium">Medium</option><option value="Low">Low</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Due Date</label><input class="erp-form-control" name="due_date" type="date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Todo">Todo</option><option value="In Progress">In Progress</option><option value="Review">Review</option><option value="Done">Done</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea></div>
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

<div class="modal fade" id="modalProgress" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Update Progress</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-12"><label class="erp-form-label">Progress (%)</label><input class="erp-form-control" name="progress" type="number" min="0" max="100" placeholder="0-100"/></div>
          <div class="col-md-12"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="Todo">Todo</option><option value="In Progress">In Progress</option><option value="Review">Review</option><option value="Done">Done</option></select></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-progress-save">
          <i class="bi bi-check2"></i> Update
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)">Are you sure you want to delete this task?</p>
        <input type="hidden" name="delete_id" value=""/>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">
          <i class="bi bi-trash"></i> Delete
        </button>
      </div>
    </div>
  </div>
</div>

<script>
(function(){
  var editingId = null;
  var allItems = [];
  var currentPage = 1;

  function getFilteredItems() {
    var query = ($('#task-search').val() || '').toLowerCase().trim();
    var status = ($('#task-status-filter').val() || '').toLowerCase().trim();

    return allItems.filter(function(item) {
      var haystack = JSON.stringify(item || {}).toLowerCase();
      if (query && haystack.indexOf(query) === -1) return false;
      if (status && status !== 'all status' && (item.status || '').toLowerCase() !== status) return false;
      return true;
    });
  }

  function renderPagination(totalItems) {
    var perPage = parseInt($('#task-per-page').val(), 10) || 20;
    var totalPages = Math.max(1, Math.ceil(totalItems / perPage));
    if (currentPage > totalPages) currentPage = totalPages;

    if (totalPages <= 1) {
      $('#task-pagination').empty();
      return;
    }

    var html = '';
    if (currentPage > 1) {
      html += '<button class="pg-btn" data-page="' + (currentPage - 1) + '"><i class="bi bi-chevron-left"></i></button>';
    }
    for (var i = 1; i <= totalPages; i++) {
      html += '<button class="pg-btn' + (i === currentPage ? ' active' : '') + '" data-page="' + i + '">' + i + '</button>';
    }
    if (currentPage < totalPages) {
      html += '<button class="pg-btn" data-page="' + (currentPage + 1) + '"><i class="bi bi-chevron-right"></i></button>';
    }
    $('#task-pagination').html(html);
  }

  function renderViews() {
    var perPage = parseInt($('#task-per-page').val(), 10) || 20;
    var filtered = getFilteredItems();
    var start = (currentPage - 1) * perPage;
    var items = filtered.slice(start, start + perPage);
    var tbody = $('#tab-list tbody');
    tbody.empty();

    var todo = [], progress = [], review = [], done = [];
    items.forEach(function(item) {
        var priorityBadge = item.priority === 'High' ? 'badge-inactive' : (item.priority === 'Medium' ? 'badge-pending' : 'badge-active');
        var statusBadge = item.status === 'Done' ? 'badge-active' : (item.status === 'In Progress' ? 'badge-pending' : (item.status === 'Review' ? 'badge-info' : 'badge-info'));
        var progressWidth = item.progress || 0;

        tbody.append('<tr data-id="' + item.id + '">' +
          '<td>' + (item.title || '') + '</td>' +
          '<td>' + (item.project_id || '') + '</td>' +
          '<td>' + (item.assigned_to || '') + '</td>' +
          '<td><span class="badge-status ' + priorityBadge + '">' + (item.priority || '') + '</span></td>' +
          '<td>' + (item.due_date || '') + '</td>' +
          '<td><span class="badge-status ' + statusBadge + '">' + (item.status || '') + '</span></td>' +
          '<td><div class="erp-progress"><div class="erp-progress-bar" style="width:' + progressWidth + '%"></div></div><small>' + progressWidth + '%</small></td>' +
          '<td><div class="d-flex gap-1">' +
            '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" title="Edit"><i class="bi bi-pencil"></i></button>' +
            '<button class="btn-erp btn-outline btn-xs btn-icon btn-progress" title="Update Progress"><i class="bi bi-graph-up"></i></button>' +
            '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/project/tasks/' + item.id + '" title="Delete"><i class="bi bi-trash"></i></button>' +
          '</div></td></tr>');

        var card = '<div class="erp-card mb-2" style="padding:12px;cursor:grab' + (item.status === 'Done' ? ';opacity:.7' : '') + '">' +
          '<div style="font-size:13px;font-weight:500' + (item.status === 'Done' ? ';text-decoration:line-through' : '') + '">' + (item.title || '') + '</div>' +
          '<div style="font-size:11px;color:var(--text-muted);margin-top:4px">Due: ' + (item.due_date || 'N/A') + '</div>';
        if (item.status === 'In Progress' || item.status === 'Review') {
          card += '<div class="erp-progress mt-2"><div class="erp-progress-bar" style="width:' + progressWidth + '%;background:' + (item.status === 'In Progress' ? 'var(--accent-4)' : 'var(--accent)') + '"></div></div>';
        }
        card += '</div>';

        if (item.status === 'Todo') todo.push(card);
        else if (item.status === 'In Progress') progress.push(card);
        else if (item.status === 'Review') review.push(card);
        else done.push(card);
    });

    if (!items.length) {
      tbody.append('<tr><td colspan="8" style="text-align:center;color:var(--text-secondary);padding:24px">No tasks found</td></tr>');
    }

    $('#kanban-todo').html(todo.join(''));
    $('#kanban-progress').html(progress.join(''));
    $('#kanban-review').html(review.join(''));
    $('#kanban-done').html(done.join(''));
    $('#kanban-todo-count').text(todo.length);
    $('#kanban-progress-count').text(progress.length);
    $('#kanban-review-count').text(review.length);
    $('#kanban-done-count').text(done.length);
    renderPagination(filtered.length);
  }

  window.loadTableData = function() {
    ErpApi.get('/project/tasks', { per_page: 100 }, function(res) {
      allItems = (res.data && res.data.data) ? res.data.data : [];
      currentPage = 1;
      renderViews();
    });
  };

  $(document).on('input', '#task-search', function() {
    currentPage = 1;
    renderViews();
  });

  $(document).on('change', '#task-status-filter, #task-per-page', function() {
    currentPage = 1;
    renderViews();
  });

  $(document).on('click', '#task-pagination .pg-btn', function() {
    var page = parseInt($(this).data('page'), 10);
    if (!page) return;
    currentPage = page;
    renderViews();
  });

  $(document).on('click', '#btnAddTask', function() {
    editingId = null;
    ErpApi.clearForm('#modalTask');
    $('#modalTask .modal-title').text('Add / Edit Task');
  });

  $(document).on('click', '.btn-edit', function() {
    var row = $(this).closest('tr');
    var id = row.data('id');
    editingId = id;
    ErpApi.get('/project/tasks/' + id, function(res) {
      var item = res.data || res;
      ErpApi.populateForm('#modalTask', item);
      $('#modalTask input[name="id"]').val(item.id);
      $('#modalTask .modal-title').text('Edit Task');
      new bootstrap.Modal(document.getElementById('modalTask')).show();
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalTask');
    if (editingId) {
      ErpApi.put('/project/tasks/' + editingId, data, function(res) {
        showToast(res.message || 'Task updated', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalTask')).hide();
        loadTableData();
      });
    } else {
      delete data.id;
      ErpApi.post('/project/tasks', data, function(res) {
        showToast(res.message || 'Task created', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalTask')).hide();
        loadTableData();
      });
    }
  });

  $(document).on('click', '.btn-progress', function() {
    var id = $(this).closest('tr').data('id');
    $('#modalProgress input[name="id"]').val(id);
    ErpApi.get('/project/tasks/' + id, function(res) {
      var item = res.data || res;
      $('#modalProgress input[name="progress"]').val(item.progress || 0);
      $('#modalProgress select[name="status"]').val(item.status || 'Todo');
      new bootstrap.Modal(document.getElementById('modalProgress')).show();
    });
  });

  $(document).on('click', '.btn-progress-save', function() {
    var id = $('#modalProgress input[name="id"]').val();
    var data = {
      progress: parseInt($('#modalProgress input[name="progress"]').val()) || 0,
      status: $('#modalProgress select[name="status"]').val()
    };
    ErpApi.put('/project/tasks/' + id + '/progress', data, function(res) {
      showToast(res.message || 'Progress updated', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalProgress')).hide();
      loadTableData();
    });
  });

  $(document).on('click', '.btn-delete', function() {
    var deleteUrl = $(this).data('delete-url');
    $('#modalDelete input[name="delete_id"]').val(deleteUrl);
    new bootstrap.Modal(document.getElementById('modalDelete')).show();
  });

  $(document).on('click', '.btn-confirm-delete', function() {
    var url = $('#modalDelete input[name="delete_id"]').val();
    ErpApi.del(url, function(res) {
      showToast(res.message || 'Task deleted', 'success');
      bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
      loadTableData();
    });
  });

  loadTableData();
})();
</script>
@endsection
