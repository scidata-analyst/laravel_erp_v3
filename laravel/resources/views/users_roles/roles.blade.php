@extends('layouts.erp')

@section('title', 'Roles & Permissions')
@section('breadcrumb', 'Roles & Permissions')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Roles &amp; Permissions</div>
      <div class="page-subtitle">Assign granular access control per role</div>
    </div>
    <button class="btn-erp btn-primary" id="btn-add-role" data-bs-toggle="modal" data-bs-target="#modalRole" data-mode="create"><i
        class="bi bi-plus-lg"></i> Add Role</button>
  </div>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="erp-card">
        <div class="card-header-bar">
          <div class="card-title">Roles</div>
          <button class="btn-erp btn-primary btn-sm" id="btn-add-role2" data-bs-toggle="modal" data-bs-target="#modalRole" data-mode="create"><i class="bi bi-plus-lg"></i> Add</button>
        </div>
        <div class="table-responsive">
          <table class="table table-dark table-hover" id="rolesTable">
            <thead>
              <tr>
                <th>Role</th>
                <th>Users</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="rolesTableBody">
              <tr>
                <td><i class="bi bi-shield-fill-check text-accent me-2"></i>Admin</td>
                <td><span class="badge-status badge-purple">3 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="1" data-name="Admin" data-description="Super Administrator" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-delete-id="1" data-delete-label="Admin" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-person-badge me-2"></i>Manager</td>
                <td><span class="badge-status badge-info">8 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="2" data-name="Manager" data-description="Manager Role" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-delete-id="2" data-delete-label="Manager" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-person me-2"></i>Staff</td>
                <td><span class="badge-status badge-pending">24 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="3" data-name="Staff" data-description="Staff Role" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-delete-id="3" data-delete-label="Staff" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-eye me-2"></i>Viewer</td>
                <td><span class="badge-status badge-active">12 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="4" data-name="Viewer" data-description="Viewer Role" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-delete-id="4" data-delete-label="Viewer" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-md-8">
      <div class="erp-card">
        <div class="card-header-bar">
          <div class="card-title">Permissions — Admin</div>
          <button class="btn-erp btn-primary btn-sm btn-save-perms"><i class="bi bi-check2"></i> Save</button>
        </div>
        <div class="perm-grid">
          <div class="pg-header">Module</div>
          <div class="pg-header">View</div>
          <div class="pg-header">Create</div>
          <div class="pg-header">Edit</div>
          <div class="pg-header">Delete</div>
          <div class="perm-row">
            <div>Inventory</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
          </div>
          <div class="perm-row">
            <div>Purchase</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
          </div>
          <div class="perm-row">
            <div>Sales</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
          </div>
          <div class="perm-row">
            <div>Accounting</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
            <div>
              <div class="perm-check"></div>
            </div>
          </div>
          <div class="perm-row">
            <div>HR</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
          </div>
          <div class="perm-row">
            <div>Reports</div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
            <div>
              <div class="perm-check on"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalRole" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modalRoleTitle">Add Role</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formRole">
          <input type="hidden" name="id" id="role_id">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-12"><label class="erp-form-label">Role Name</label><input class="erp-form-control"
                  type="text" name="name" id="role_name" placeholder="e.g. Procurement Officer" required /></div>
              <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                  name="description" id="role_description" rows="3" placeholder="Describe the role responsibilities…"></textarea></div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Create Role
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalRole = document.getElementById('modalRole');
  const formRole = document.getElementById('formRole');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalRole.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formRole);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modalRoleTitle');
    const btnSave = formRole.querySelector('.btn-modal-save');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Role';
      btnSave.innerHTML = '<i class="bi bi-check2"></i> Update Role';

      apiClient.show(API_ENDPOINTS.USERS_ROLES.ROLES.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('role_id').value = item.id;
          formRole.querySelector('[name="name"]').value = item.name || '';
          formRole.querySelector('[name="description"]').value = item.description || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Role';
      btnSave.innerHTML = '<i class="bi bi-check2"></i> Create Role';
      formRole.reset();
      document.getElementById('role_id').value = '';
    }
  });

  formRole.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('role_id').value;

    const formData = new FormData(formRole);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.USERS_ROLES.ROLES.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.USERS_ROLES.ROLES.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalRole).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formRole, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.USERS_ROLES.ROLES.DESTROY, deleteId)
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
