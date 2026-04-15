@extends('layouts.erp')

@section('title', 'Roles & Permissions')
@section('breadcrumb', 'Roles & Permissions')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Roles &amp; Permissions</div>
      <div class="page-subtitle">Assign granular access control per role</div>
    </div>
    <button class="btn-erp btn-primary" id="btn-add-role" data-bs-toggle="modal" data-bs-target="#modalRole"><i
        class="bi bi-plus-lg"></i> Add Role</button>
  </div>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="erp-card">
        <div class="card-header-bar">
          <div class="card-title">Roles</div>
          <button class="btn-erp btn-primary btn-sm" id="btn-add-role2" data-bs-toggle="modal" data-bs-target="#modalRole"><i class="bi bi-plus-lg"></i> Add</button>
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
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="1" data-name="Admin" data-description="Super Administrator"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-id="1" data-name="Admin"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-person-badge me-2"></i>Manager</td>
                <td><span class="badge-status badge-info">8 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="2" data-name="Manager" data-description="Manager Role"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-id="2" data-name="Manager"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-person me-2"></i>Staff</td>
                <td><span class="badge-status badge-pending">24 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="3" data-name="Staff" data-description="Staff Role"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-id="3" data-name="Staff"><i class="bi bi-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td><i class="bi bi-eye me-2"></i>Viewer</td>
                <td><span class="badge-status badge-active">12 users</span></td>
                <td>
                  <button class="btn btn-sm btn-outline-info btn-edit" data-id="4" data-name="Viewer" data-description="Viewer Role"><i class="bi bi-pencil"></i></button>
                  <button class="btn btn-sm btn-outline-danger btn-delete" data-id="4" data-name="Viewer"><i class="bi bi-trash"></i></button>
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
$(document).ready(function() {
  $('#btn-add-role, #btn-add-role2').on('click', function() {
    $('#formRole')[0].reset();
    $('#role_id').val('');
    $('#modalRoleTitle').text('Add Role');
    $('.btn-modal-save').html('<i class="bi bi-check2"></i> Create Role');
  });

  $(document).on('click', '.btn-edit', function() {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const description = $(this).data('description') || '';
    
    $('#role_id').val(id);
    $('#role_name').val(name);
    $('#role_description').val(description);
    $('#modalRoleTitle').text('Edit Role');
    $('.btn-modal-save').html('<i class="bi bi-check2"></i> Update Role');
    $('#modalRole').modal('show');
  });

  let deleteId = null;

  $(document).on('click', '.btn-delete', function() {
    deleteId = $(this).data('id');
    const name = $(this).data('name');
    $('#delete-target').text(name);
    $('#modalDelete').modal('show');
  });

  $('#btn-confirm-delete').on('click', function() {
    const btn = $(this);
    const originalText = btn.html();
    
    btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Deleting...');
    
    $.ajax({
      url: '{{ route("role.destroy", ":id") }}'.replace(':id', deleteId),
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      success: function(response) {
        $('#modalDelete').modal('hide');
        showToast(response.message || 'Deleted successfully', 'success');
        setTimeout(() => window.location.reload(), 1500);
      },
      error: function(xhr) {
        const msg = xhr.responseJSON?.message || 'Error deleting role';
        showToast(msg, 'error');
        btn.prop('disabled', false).html(originalText);
      }
    });
  });

  function showToast(message, type) {
    const bg = type === 'success' ? '#28a745' : '#dc3545';
    const icon = type === 'success' ? 'bi-check-circle' : 'bi-exclamation-circle';
    const toast = $(`<div class="toast-notification" style="position:fixed;top:20px;right:20px;background:${bg};color:#fff;padding:12px 20px;border-radius:4px;z-index:9999;display:flex;align-items:center;gap:8px;animation:slideIn 0.3s ease">
      <i class="bi ${icon}"></i><span>${message}</span>
    </div>`);
    $('body').append(toast);
    setTimeout(() => toast.remove(), 3000);
  }
});
</script>
@endpush
