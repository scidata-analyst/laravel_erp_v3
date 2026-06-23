@extends('layouts.erp')

@section('title', 'User Management')
@section('breadcrumb', 'User Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">User Management</div>
      <div class="page-subtitle">Create, manage and deactivate system users</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser" data-mode="create"><i class="bi bi-plus-lg"></i> Add User</button>
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
                     data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalUser"
                     title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $user->id }}"
                    data-delete-label="{{ $user->user_name ?? $user->name ?? '' }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete">
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
                  <div class="invalid-feedback" id="error-department"></div>
                </div>
              <div class="col-md-6" id="password-field">
                <label class="erp-form-label">Password <span class="text-danger">*</span></label>
                <input class="erp-form-control" type="password" name="password" id="user-password"
                  placeholder="Min 8 characters" />
                <div class="invalid-feedback" id="error-password"></div>
              </div>
                <div class="col-md-6">
                  <label class="erp-form-label">Status</label>
                  <select class="erp-form-control" name="is_active" id="user-is_active">
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                  <div class="invalid-feedback" id="error-is_active"></div>
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
    document.addEventListener('DOMContentLoaded', function() {
      const modalUser = document.getElementById('modalUser');
      const formUser = document.getElementById('form-user');
      const modalDelete = document.getElementById('modalDelete');
      const btnConfirmDelete = document.getElementById('btn-confirm-delete');
      const passwordField = document.getElementById('password-field');

      let deleteId = null;

      // Load roles dropdown via API
      function loadRoles(selectedId = null) {
        const roleSelect = formUser.querySelector('[name="role_id"]');
        // Remove all options except the first placeholder
        while (roleSelect.options.length > 1) roleSelect.remove(1);

        fetch(API_ENDPOINTS.USERS_ROLES.ROLES.ALL)
          .then(res => res.json())
          .then(res => {
            const roles = res.data || res;
            if (Array.isArray(roles)) {
              roles.forEach(role => {
                const opt = document.createElement('option');
                opt.value = role.id;
                opt.textContent = role.role_name || role.name;
                roleSelect.appendChild(opt);
              });
            }
            if (selectedId) roleSelect.value = selectedId;
          })
          .catch(() => showToast('Failed to load roles', 'error'));
      }

      modalUser.addEventListener('show.bs.modal', function(e) {
        clearFormErrors(formUser);
        const button = e.relatedTarget;
        const mode = button?.dataset.mode || 'create';
        const modalTitle = document.getElementById('modal-title');

        if (mode === 'edit') {
          const id = button.dataset.id;
          modalTitle.textContent = 'Edit User';
          passwordField.style.display = 'none';
          formUser.querySelector('[name="password"]').required = false;

          apiClient.show(API_ENDPOINTS.USERS_ROLES.USER.SHOW, id)
            .then(data => {
              const item = data.data || data;
              document.getElementById('user-id').value = item.id;
              formUser.querySelector('[name="user_name"]').value = item.user_name || item.name || '';
              formUser.querySelector('[name="email"]').value = item.email || '';
              formUser.querySelector('[name="department"]').value = item.department || '';
              formUser.querySelector('[name="is_active"]').value = (item.is_active == 1 || item.is_active == 'Active') ? 'Active' : 'Inactive';
              loadRoles(item.role_id);
            })
            .catch(error => showToast(error.message || 'Failed to load data', 'error'));
        } else {
          modalTitle.textContent = 'Add User';
          passwordField.style.display = '';
          formUser.querySelector('[name="password"]').required = true;
          formUser.reset();
          document.getElementById('user-id').value = '';
          loadRoles();
        }
      });

      formUser.addEventListener('submit', function(e) {
        e.preventDefault();
        const id = document.getElementById('user-id').value;

        const formData = new FormData(formUser);
        const payload = Object.fromEntries(formData.entries());

        let request;
        if (id) {
          request = apiClient.update(API_ENDPOINTS.USERS_ROLES.USER.UPDATE, id, payload);
        } else {
          request = apiClient.store(API_ENDPOINTS.USERS_ROLES.USER.STORE, payload);
        }

        request
        .then(data => {
          if (data.success || data.id) {
            bootstrap.Modal.getInstance(modalUser).hide();
            showToast(data.message || 'Success', 'success');
            setTimeout(() => location.reload(), 1000);
          } else {
            showToast(data.message || 'Error', 'error');
          }
        })
        .catch(error => {
          if (error.errors) {
            handleFormErrors(formUser, error.errors);
          } else {
            showToast(error.message || 'An error occurred', 'error');
          }
        });
      });

      modalDelete.addEventListener('show.bs.modal', function(e) {
        const button = e.relatedTarget;
        deleteId = button.dataset.deleteId;
        document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'this user';
      });

      btnConfirmDelete.addEventListener('click', function() {
        if (!deleteId) return;

        apiClient.destroy(API_ENDPOINTS.USERS_ROLES.USER.DESTROY, deleteId)
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
@endsection