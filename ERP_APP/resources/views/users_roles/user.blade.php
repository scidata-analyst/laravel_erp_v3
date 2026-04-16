@extends('layouts.erp')

@section('title', 'User Management')
@section('breadcrumb', 'User Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">User Management</div>
      <div class="page-subtitle">Create, manage and deactivate system users</div>
    </div>
    <button class="btn-erp btn-primary" id="btn-add-user"><i class="bi bi-plus-lg"></i> Add User</button>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input class="tbl-search" data-table="#tbl-users" type="text" placeholder="Search users…" />
      </div>
      <select class="erp-form-control" style="width:130px" id="filter-role">
        <option value="">All Roles</option>
        <option>Admin</option>
        <option>Manager</option>
        <option>Staff</option>
      </select>
      <select class="erp-form-control" style="width:130px" id="filter-status">
        <option value="">All Status</option>
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
      </select>
    </div>

    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-users">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Department</th>
            <th>Status</th>
            <th>Last Login</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $index => $user)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar-sm" style="background:linear-gradient(135deg,var(--accent),var(--accent-5))">
                    {{ strtoupper(substr($user->user_name ?? $user->name ?? 'U', 0, 2)) }}
                  </div>
                  {{ $user->user_name ?? $user->name ?? 'N/A' }}
                </div>
              </td>
              <td>{{ $user->email }}</td>
              <td><span class="badge-status badge-purple">{{ $user->role_name ?? 'N/A' }}</span></td>
              <td>{{ $user->department ?? 'N/A' }}</td>
              <td>
                @if(($user->is_active ?? $user->status) == 'Active' || ($user->is_active ?? 1) == 1)
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>{{ $user->last_login ?? 'Never' }}</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $user->id }}"
                    data-user_name="{{ $user->user_name ?? $user->name ?? '' }}" data-email="{{ $user->email }}"
                    data-role="{{ $user->role_name ?? '' }}" data-department="{{ $user->department ?? '' }}"
                    data-status="{{ ($user->is_active ?? $user->status) == 'Active' || ($user->is_active ?? 1) == 1 ? 'Active' : 'Inactive' }}"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $user->id }}"
                    data-user_name="{{ $user->user_name ?? $user->name ?? '' }}" title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted">No users found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-between align-items-center mt-5">
      <div>
        Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
      </div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>

  <div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-user">
          <div class="modal-body">
            <input type="hidden" name="id" id="user-id" value="" />
            <div class="row g-3">
<div class="col-md-6">
              <label class="erp-form-label">Full Name <span class="text-danger">*</span></label>
              <input class="erp-form-control" type="text" name="user_name" id="user-name" placeholder="John Smith" required />
              <div class="invalid-feedback" id="error-user_name"></div>
            </div>
              <div class="col-md-6">
                <label class="erp-form-label">Email <span class="text-danger">*</span></label>
                <input class="erp-form-control" type="email" name="email" id="user-email" placeholder="john@company.com"
                  required />
                <div class="invalid-feedback" id="error-email"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Role <span class="text-danger">*</span></label>
                <select class="erp-form-control" name="role_id" id="user-role" required>
                  <option value="">Select Role</option>
                  <option value="1">Admin</option>
                  <option value="2">Manager</option>
                  <option value="3">Staff</option>
                  <option value="4">Viewer</option>
                </select>
                <div class="invalid-feedback" id="error-role_id"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Department</label>
                <select class="erp-form-control" name="department" id="user-department">
                  <option value="">Select Department</option>
                  <option value="IT">IT</option>
                  <option value="Sales">Sales</option>
                  <option value="Finance">Finance</option>
                  <option value="HR">HR</option>
                  <option value="Warehouse">Warehouse</option>
                </select>
              </div>
              <div class="col-md-6" id="password-field">
                <label class="erp-form-label">Password <span class="text-danger">*</span></label>
                <input class="erp-form-control" type="password" name="password" id="user-password"
                  placeholder="Min 8 characters" />
                <div class="invalid-feedback" id="error-password"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="user-status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Save User
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
            Are you sure you want to delete
            <strong id="delete-target" style="color:var(--text-primary)">this record</strong>?
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

  @push('scripts')
    <script>
      $(function () {
        var routes = {
          store: '{{ route("user.store") }}',
          update: '{{ route("user.update", ":id") }}',
          destroy: '{{ route("user.destroy", ":id") }}'
        };

        var $modal = $('#modalUser');
        var $form = $('#form-user');
        var $btnSave = $('#btn-save');
        var userId = null;
        var isEdit = false;

        // Open modal for new user
        $('#btn-add-user').on('click', function () {
          resetForm();
          isEdit = false;
          $('#modal-title').text('Add User');
          $('#password-field').show();
          $form.find('[name="password"]').prop('required', true);
          $modal.modal('show');
        });

        // Edit user
        $(document).on('click', '.btn-edit', function () {
          resetForm();
          isEdit = true;
          userId = $(this).data('id');
          $('#modal-title').text('Edit User');
          $('#password-field').hide();
          $form.find('[name="password"]').prop('required', false);

          $('#user-id').val(userId);
          $('#user-name').val($(this).data('user_name'));
          $('#user-email').val($(this).data('email'));
          $('#user-role').val($(this).data('role') === 'Admin' ? 1 : $(this).data('role') === 'Manager' ? 2 : $(this).data('role') === 'Staff' ? 3 : 4);
          $('#user-status').val($(this).data('status'));
          $('#user-department').val($(this).data('department'));

          $modal.modal('show');
        });

        // Delete confirmation
        $(document).on('click', '.btn-delete', function () {
          userId = $(this).data('id');
          var user_name = $(this).data('user_name');
          $('#delete-target').text(user_name || 'this user');
          $('#modalDelete').modal('show');
        });

        // Confirm delete
        $('#btn-confirm-delete').on('click', function () {
          $.ajax({
            url: routes.destroy.replace(':id', userId),
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
              if (res.success) {
                showToast(res.message || 'User deleted', 'success');
                $('#modalDelete').modal('hide');
                setTimeout(() => location.reload(), 1000);
              }
            },
            error: function (xhr) {
              showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
            }
          });
        });

        // Form submit
        $form.on('submit', function (e) {
          e.preventDefault();
          $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

          var url = isEdit ? routes.update.replace(':id', userId) : routes.store;
          var method = isEdit ? 'PUT' : 'POST';

          $.ajax({
            url: url,
            method: method,
            data: $form.serialize(),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
              if (res.success) {
                showToast(res.message || (isEdit ? 'User updated' : 'User created'), 'success');
                $modal.modal('hide');
                setTimeout(() => location.reload(), 1000);
              }
            },
            error: function (xhr) {
              var res = xhr.responseJSON;
              if (res && res.errors) {
                $.each(res.errors, function (field, messages) {
                  var $input = $form.find('[name="' + field + '"]');
                  $input.addClass('is-invalid');
                  $('#error-' + field).text(messages[0]).show();
                });
              } else if (res && res.message) {
                showToast(res.message, 'error');
              } else {
                showToast('An error occurred', 'error');
              }
            },
            complete: function () {
              $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save User');
            }
          });
        });

        function resetForm() {
          userId = null;
          isEdit = false;
          $form[0].reset();
          $form.find('.is-invalid').removeClass('is-invalid');
          $form.find('.invalid-feedback').hide().text('');
        }

        function showToast(msg, type) {
          type = type || 'info';
          var icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
          var color = type === 'success' ? 'var(--accent-2)' : type === 'error' ? 'var(--accent-3)' : 'var(--accent)';
          var $t = $('<div class="erp-toast ' + type + '"></div>')
            .html('<span style="font-weight:700;color:' + color + '">' + icon + '</span> ' + msg);
          $('#toast-container').append($t);
          setTimeout(function () { $t.css('opacity', 0); }, 2500);
          setTimeout(function () { $t.remove(); }, 2800);
        }
      });
    </script>
  @endpush
@endsection