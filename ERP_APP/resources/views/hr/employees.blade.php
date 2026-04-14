@extends('layouts.erp')

@section('title', 'Employee Management')
@section('breadcrumb', 'Human Resources / Employee Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Employee Management</div>
      <div class="page-subtitle">Staff directory, departments and contracts</div>
    </div>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalEmployee"><i
        class="bi bi-plus-lg"></i> Add Employee</button>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search"
          data-table="#tbl-emp" type="text" placeholder="Search employees…" /></div>
      <select class="erp-form-control" style="width:130px">
        <option>All Depts</option>
        <option>IT</option>
        <option>Sales</option>
        <option>HR</option>
        <option>Finance</option>
        <option>Warehouse</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-emp">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Position</th>
            <th>Department</th>
            <th>Phone</th>
            <th>Join Date</th>
            <th>Salary</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $employee)
            <tr>
              <td>{{ $employee->employee_id }}</td>
              <td>
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar-sm" style="background:linear-gradient(135deg,var(--accent),var(--accent-5))">{{ strtoupper(substr($employee->full_name, 0, 2)) }}</div>{{ $employee->full_name }}
                </div>
              </td>
              <td>{{ $employee->designation }}</td>
              <td>{{ $employee->department }}</td>
              <td>{{ $employee->phone }}</td>
              <td>{{ $employee->join_date ? \Carbon\Carbon::parse($employee->join_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>${{ number_format($employee->basic_salary, 2) }}</td>
              <td>
                @if ($employee->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalEmployee" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Employee" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalEmployee" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Employee</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Full Name</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Employee ID</label><input class="erp-form-control"
                type="text" placeholder="EMP-XXX" /></div>
            <div class="col-md-6"><label class="erp-form-label">Position / Designation</label><input
                class="erp-form-control" type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Department</label><select class="erp-form-control">
                <option>IT</option>
                <option>Sales</option>
                <option>HR</option>
                <option>Finance</option>
                <option>Warehouse</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Basic Salary ($)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Join Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Contract Type</label><select class="erp-form-control">
                <option>Permanent</option>
                <option>Contract</option>
                <option>Intern</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control"
                type="email" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" type="text"
                placeholder="" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Employee
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