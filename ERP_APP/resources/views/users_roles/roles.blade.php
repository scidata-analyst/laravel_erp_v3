@extends('layouts.erp')

@section('title', 'Roles & Permissions')
@section('breadcrumb', 'Roles & Permissions')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Roles &amp; Permissions</div>
      <div class="page-subtitle">Assign granular access control per role</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalRole"><i
        class="bi bi-plus-lg"></i> Add Role</button>
  </div>
  <div class="row g-3">
    <div class="col-md-4">
      <div class="erp-card">
        <div class="card-header-bar">
          <div class="card-title">Roles</div>
        </div>
        <div class="stat-row" style="cursor:pointer;padding:10px 8px">
          <div class="stat-row-label"><i class="bi bi-shield-fill-check text-accent me-2"></i>Admin</div><span
            class="badge-status badge-purple">3 users</span>
        </div>
        <div class="stat-row" style="cursor:pointer;padding:10px 8px">
          <div class="stat-row-label"><i class="bi bi-person-badge me-2"></i>Manager</div><span
            class="badge-status badge-info">8 users</span>
        </div>
        <div class="stat-row" style="cursor:pointer;padding:10px 8px">
          <div class="stat-row-label"><i class="bi bi-person me-2"></i>Staff</div><span
            class="badge-status badge-pending">24 users</span>
        </div>
        <div class="stat-row" style="cursor:pointer;padding:10px 8px">
          <div class="stat-row-label"><i class="bi bi-eye me-2"></i>Viewer</div><span
            class="badge-status badge-active">12 users</span>
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
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Role</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12"><label class="erp-form-label">Role Name</label><input class="erp-form-control"
                type="text" placeholder="e.g. Procurement Officer" /></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="3" placeholder="Describe the role responsibilities…"></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Create Role
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
