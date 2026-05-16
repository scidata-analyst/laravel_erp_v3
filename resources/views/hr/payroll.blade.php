@extends('layouts.erp')

@section('title', 'Payroll')
@section('breadcrumb', 'Human Resources / Payroll')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Payroll</div>
      <div class="page-subtitle">Monthly payroll processing and salary slips</div>
    </div>
    <button class="btn-erp btn-primary" id="btn-run-payroll"><i class="bi bi-play-circle"></i> Run Payroll</button>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-3">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-wallet2"></i></div>
        <div class="kpi-value">$182K</div>
        <div class="kpi-label">Total Payroll (Jan)</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile green">
        <div class="kpi-icon green"><i class="bi bi-check-circle"></i></div>
        <div class="kpi-value">42</div>
        <div class="kpi-label">Processed</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile yellow">
        <div class="kpi-icon yellow"><i class="bi bi-hourglass-split"></i></div>
        <div class="kpi-value">3</div>
        <div class="kpi-label">Pending</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile red">
        <div class="kpi-icon red"><i class="bi bi-x-circle"></i></div>
        <div class="kpi-value">0</div>
        <div class="kpi-label">Failed</div>
      </div>
    </div>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search"
          data-table="#tbl-payroll" type="text" placeholder="Search payroll…" /></div>
      <select class="erp-form-control" style="width:150px">
        <option>January 2025</option>
        <option>December 2024</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-payroll">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Designation</th>
            <th>Basic</th>
            <th>Allowances</th>
            <th>Deductions</th>
            <th>Net Pay</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $payroll)
            <tr data-id="{{ $payroll->id }}">
              <td>{{ $payroll->employee_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>${{ number_format($payroll->basic_salary, 2) }}</td>
              <td>${{ number_format($payroll->allowances ?? 0, 2) }}</td>
              <td>${{ number_format($payroll->deductions ?? 0, 2) }}</td>
              <td>${{ number_format($payroll->net_pay, 2) }}</td>
              <td>
                @if ($payroll->status == 'Paid')
                  <span class="badge-status badge-active">Paid</span>
                @else
                  <span class="badge-status badge-pending">Pending</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  @if ($payroll->status == 'Paid')
                    <button class="btn-erp btn-outline btn-xs"><i class="bi bi-file-earmark-text"></i> Slip</button>
                  @else
                    <button class="btn-erp btn-success btn-xs btn-process-payment"
                      data-id="{{ $payroll->id }}"
                      data-url="{{ route('payroll.show', $payroll->id) }}"
                      title="Process">Process</button>
                  @endif
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $payroll->id }}"
                    data-url="{{ route('payroll.show', $payroll->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPayroll"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $payroll->id }}"
                    data-url="{{ route('payroll.destroy', $payroll->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete"
                    data-delete-label="Payroll Record"
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

  <div class="modal fade" id="modalPayroll" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Edit Payroll</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-payroll" method="POST">
          @csrf
          <input type="hidden" name="_method" value="POST" id="form-method">
          <input type="hidden" name="id" id="payroll_id">
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
                <label class="erp-form-label">Month</label>
                <input class="erp-form-control" type="month" name="month" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Basic Salary ($)</label>
                <input class="erp-form-control" type="number" name="basic_salary" placeholder="" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Allowances ($)</label>
                <input class="erp-form-control" type="number" name="allowances" placeholder="0" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Deductions ($)</label>
                <input class="erp-form-control" type="number" name="deductions" placeholder="0" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Net Pay ($)</label>
                <input class="erp-form-control" type="number" name="net_pay" placeholder="" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" required>
                  <option value="Pending">Pending</option>
                  <option value="Paid">Paid</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Payroll
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
  const ROUTE_STORE = '{{ route("payroll.store") }}';
  const ROUTE_UPDATE = '{{ route("payroll.update", ["id" => "__ID__"]) }}';
  const ROUTE_DESTROY = '{{ route("payroll.destroy", ["id" => "__ID__"]) }}';
  let deleteUrl = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle' : 'x-circle'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }

  function resetForm() {
    $('#form-payroll')[0].reset();
    $('#form-method').val('POST');
    $('#payroll_id').val('');
    $('#modalPayroll .modal-title').text('Add Payroll');
  }

  $('#modalPayroll').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (btn.classList.contains('btn-edit')) {
      const id = btn.dataset.id;
      $.ajax({
        url: btn.dataset.url,
        method: 'GET',
        success: function(data) {
          $('#form-method').val('PUT');
          $('#payroll_id').val(data.id);
          $('#modalPayroll .modal-title').text('Edit Payroll');
          $('#form-payroll select[name="employee_id"]').val(data.employee_id);
          $('#form-payroll input[name="month"]').val(data.month);
          $('#form-payroll input[name="basic_salary"]').val(data.basic_salary);
          $('#form-payroll input[name="allowances"]').val(data.allowances || 0);
          $('#form-payroll input[name="deductions"]').val(data.deductions || 0);
          $('#form-payroll input[name="net_pay"]').val(data.net_pay);
          $('#form-payroll select[name="status"]').val(data.status);
        }
      });
    } else {
      resetForm();
    }
  });

  $('#form-payroll').on('submit', function(e) {
    e.preventDefault();
    const id = $('#payroll_id').val();
    const url = id ? ROUTE_UPDATE.replace('__ID__', id) : ROUTE_STORE;
    const method = id ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $(this).serialize(),
      success: function() {
        $('#modalPayroll').modal('hide');
        showToast(id ? 'Payroll updated successfully' : 'Payroll created successfully');
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

  $(document).on('click', '.btn-process-payment', function() {
    const btn = $(this);
    const id = btn.data('id');
    $.ajax({
      url: ROUTE_UPDATE.replace('__ID__', id),
      method: 'PUT',
      data: { _token: '{{ csrf_token() }}', status: 'Paid' },
      success: function() {
        showToast('Payment processed successfully');
        setTimeout(() => location.reload(), 500);
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Process failed', 'error');
      }
    });
  });
})();
</script>
@endpush