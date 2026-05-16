@extends('layouts.erp')

@section('title', 'Attendance & Leave')
@section('breadcrumb', 'Human Resources / Attendance & Leave')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Attendance & Leave</div>
      <div class="page-subtitle">Daily attendance records and leave request management</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalAttendance"><i
          class="bi bi-plus-lg"></i> Log Attendance</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search attendance & leave…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Present</option>
        <option>Absent</option>
        <option>Leave</option>
        <option>Half Day</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Date</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Hours</th>
            <th>Leave Type</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $attendance)
            <tr data-id="{{ $attendance->id }}">
              <td>{{ $attendance->employee_id ?? 'N/A' }}</td>
              <td>{{ $attendance->attendance_date ? \Carbon\Carbon::parse($attendance->attendance_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $attendance->check_in_time ?? '—' }}</td>
              <td>{{ $attendance->check_out_time ?? '—' }}</td>
              <td>—</td>
              <td>{{ $attendance->leave_type ?? '—' }}</td>
              <td>
                @if ($attendance->status == 'Present')
                  <span class="badge-status badge-active">Present</span>
                @elseif ($attendance->status == 'Absent')
                  <span class="badge-status badge-inactive">Absent</span>
                @elseif ($attendance->status == 'Leave')
                  <span class="badge-status badge-pending">Leave</span>
                @else
                  <span class="badge-status badge-info">{{ $attendance->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $attendance->id }}"
                    data-url="{{ route('attendance.show', $attendance->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalAttendance"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $attendance->id }}"
                    data-url="{{ route('attendance.destroy', $attendance->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete"
                    data-delete-label="Attendance"
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

  <div class="modal fade" id="modalAttendance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Attendance</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-attendance" method="POST">
          @csrf
          <input type="hidden" name="_method" value="POST" id="form-method">
          <input type="hidden" name="id" id="attendance_id">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Employee</label>
                <select class="erp-form-control" name="employee_id" required>
                  <option value="">Select Employee</option>
                  <option>Adam Khan</option>
                  <option>Sara Lee</option>
                  <option>James R.</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Date</label>
                <input class="erp-form-control" type="date" name="attendance_date" placeholder="" required />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Check In</label>
                <input class="erp-form-control" type="time" name="check_in_time" placeholder="" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Check Out</label>
                <input class="erp-form-control" type="time" name="check_out_time" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" required>
                  <option value="Present">Present</option>
                  <option value="Absent">Absent</option>
                  <option value="Leave">Leave</option>
                  <option value="Half Day">Half Day</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Leave Type (if applicable)</label>
                <select class="erp-form-control" name="leave_type">
                  <option value="">—</option>
                  <option value="Annual Leave">Annual Leave</option>
                  <option value="Sick Leave">Sick Leave</option>
                  <option value="Maternity">Maternity</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save
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
  const ROUTE_STORE = '{{ route("attendance.store") }}';
  const ROUTE_UPDATE = '{{ route("attendance.update", ["id" => "__ID__"]) }}';
  const ROUTE_DESTROY = '{{ route("attendance.destroy", ["id" => "__ID__"]) }}';
  let deleteUrl = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle' : 'x-circle'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }

  function resetForm() {
    $('#form-attendance')[0].reset();
    $('#form-method').val('POST');
    $('#attendance_id').val('');
    $('#modalAttendance .modal-title').text('Log Attendance');
  }

  $('#modalAttendance').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (btn.classList.contains('btn-edit')) {
      const id = btn.dataset.id;
      $.ajax({
        url: btn.dataset.url,
        method: 'GET',
        success: function(data) {
          $('#form-method').val('PUT');
          $('#attendance_id').val(data.id);
          $('#modalAttendance .modal-title').text('Edit Attendance');
          $('#form-attendance select[name="employee_id"]').val(data.employee_id);
          $('#form-attendance input[name="attendance_date"]').val(data.attendance_date);
          $('#form-attendance input[name="check_in_time"]').val(data.check_in_time);
          $('#form-attendance input[name="check_out_time"]').val(data.check_out_time);
          $('#form-attendance select[name="status"]').val(data.status);
          $('#form-attendance select[name="leave_type"]').val(data.leave_type || '');
        }
      });
    } else {
      resetForm();
    }
  });

  $('#form-attendance').on('submit', function(e) {
    e.preventDefault();
    const id = $('#attendance_id').val();
    const url = id ? ROUTE_UPDATE.replace('__ID__', id) : ROUTE_STORE;
    const method = id ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $(this).serialize(),
      success: function() {
        $('#modalAttendance').modal('hide');
        showToast(id ? 'Attendance updated successfully' : 'Attendance logged successfully');
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