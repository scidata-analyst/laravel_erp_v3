@extends('layouts.erp')

@section('title', 'User Management')
@section('breadcrumb', 'User Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">User Management</div>
      <div class="page-subtitle">Create, manage and deactivate system users</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser"><i
        class="bi bi-plus-lg"></i> Add User</button>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search"
          data-table="#tbl-users" type="text" placeholder="Search users…" /></div>
      <select class="erp-form-control" style="width:130px">
        <option>All Roles</option>
        <option>Admin</option>
        <option>Manager</option>
        <option>Staff</option>
      </select>
      <select class="erp-form-control" style="width:130px">
        <option>All Status</option>
        <option>Active</option>
        <option>Inactive</option>
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
          @foreach ($data as $user)
            <tr>
              <td>001</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar-sm" style="background:linear-gradient(135deg,var(--accent),var(--accent-5))">AK
                  </div> {{ $user->user_name }}
                </div>
              </td>
              <td>{{ $user->email }}</td>
              <td><span class="badge-status badge-purple">{{ $user->role_name }}</span></td>
              <td>IT</td>
              <td>
                @if ($user->is_active == 1)
                  <span class="badge-status badge-active">Active</span>
                @endif

                @if ($user->is_active == 0)
                  <span class="badge-status badge-inactive">InActive</span>
                @endif
              </td>
              <td>Today 10:22</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalUser"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" data-delete-label="User" title="Delete"><i
                      class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @endforeach
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


  <div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit User</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Full Name</label><input class="erp-form-control"
                type="text" placeholder="John Smith" /></div>
            <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control"
                type="email" placeholder="john@company.com" /></div>
            <div class="col-md-6"><label class="erp-form-label">Role</label><select class="erp-form-control">
                <option>Admin</option>
                <option>Manager</option>
                <option>Staff</option>
                <option>Viewer</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Department</label><select class="erp-form-control">
                <option>IT</option>
                <option>Sales</option>
                <option>Finance</option>
                <option>HR</option>
                <option>Warehouse</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Password</label><input class="erp-form-control"
                type="password" placeholder="••••••••" /></div>
            <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control">
                <option>Active</option>
                <option>Inactive</option>
              </select></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save User
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
