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
            <tr data-id="{{ $employee->id }}">
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
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $employee->id }}"
                    data-url="{{ route('employees.show', $employee->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalEmployee"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $employee->id }}"
                    data-url="{{ route('employees.destroy', $employee->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete"
                    data-delete-label="Employee"
                    title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
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

  <div class="modal fade" id="modalEmployee" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Employee</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-employee" method="POST">
          @csrf
          <input type="hidden" name="_method" value="POST" id="form-method">
          <input type="hidden" name="id" id="employee_id">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Full Name</label>
                <input class="erp-form-control" type="text" name="full_name" placeholder="" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Employee ID</label>
                <input class="erp-form-control" type="text" name="employee_id" placeholder="EMP-XXX" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Position / Designation</label>
                <input class="erp-form-control" type="text" name="designation" placeholder="" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Department</label>
                <select class="erp-form-control" name="department" required>
                  <option value="">Select Department</option>
                  <option>IT</option>
                  <option>Sales</option>
                  <option>HR</option>
                  <option>Finance</option>
                  <option>Warehouse</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Basic Salary ($)</label>
                <input class="erp-form-control" type="number" name="basic_salary" placeholder="" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Join Date</label>
                <input class="erp-form-control" type="date" name="join_date" placeholder="" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Contract Type</label>
                <select class="erp-form-control" name="contract_type" required>
                  <option value="Permanent">Permanent</option>
                  <option value="Contract">Contract</option>
                  <option value="Intern">Intern</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Email</label>
                <input class="erp-form-control" type="email" name="email" placeholder="" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Phone</label>
                <input class="erp-form-control" type="text" name="phone" placeholder="" required />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Employee
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
(function() {
  const ROUTE_STORE = '{{ route("employees.store") }}';
  const ROUTE_UPDATE = '{{ route("employees.update", ["id" => "__ID__"]) }}';
  const ROUTE_DESTROY = '{{ route("employees.destroy", ["id" => "__ID__"]) }}';
  let deleteUrl = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle' : 'x-circle'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }

  function resetForm() {
    $('#form-employee')[0].reset();
    $('#form-method').val('POST');
    $('#employee_id').val('');
    $('#modalEmployee .modal-title').text('Add / Edit Employee');
  }

  $('#modalEmployee').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (btn.classList.contains('btn-edit')) {
      const id = btn.dataset.id;
      $.ajax({
        url: btn.dataset.url,
        method: 'GET',
        success: function(data) {
          $('#form-method').val('PUT');
          $('#employee_id').val(data.id);
          $('#modalEmployee .modal-title').text('Edit Employee');
          $('#form-employee input[name="full_name"]').val(data.full_name);
          $('#form-employee input[name="employee_id"]').val(data.employee_id);
          $('#form-employee input[name="designation"]').val(data.designation);
          $('#form-employee select[name="department"]').val(data.department);
          $('#form-employee input[name="basic_salary"]').val(data.basic_salary);
          $('#form-employee input[name="join_date"]').val(data.join_date);
          $('#form-employee select[name="contract_type"]').val(data.contract_type || 'Permanent');
          $('#form-employee input[name="email"]').val(data.email);
          $('#form-employee input[name="phone"]').val(data.phone);
        }
      });
    } else {
      resetForm();
    }
  });

  $('#form-employee').on('submit', function(e) {
    e.preventDefault();
    const id = $('#employee_id').val();
    const url = id ? ROUTE_UPDATE.replace('__ID__', id) : ROUTE_STORE;
    const method = id ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $(this).serialize(),
      success: function() {
        $('#modalEmployee').modal('hide');
        showToast(id ? 'Employee updated successfully' : 'Employee created successfully');
        setTimeout(() => location.reload(), 500);
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Operation failed', 'error');
      }
    });
  });

  $('#modalDelete').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    deleteUrl = btn.dataset.url;
    $('#delete-target').text(btn.dataset.deleteLabel || 'record');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: deleteUrl,
      method: 'DELETE',
      data: { _token: '{{ csrf_token() }}' },
      success: function() {
        $('#modalDelete').modal('hide');
        showToast('Record deleted successfully');
        setTimeout(() => location.reload(), 500);
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
      }
    });
  });
})();
</script>
@endpush