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
                      title="Process">Process</button>
                  @endif
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $payroll->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPayroll"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-delete-id="{{ $payroll->id }}"
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
        <form id="form-payroll">
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
document.addEventListener('DOMContentLoaded', function() {
  const modalPayroll = document.getElementById('modalPayroll');
  const formPayroll = document.getElementById('form-payroll');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalPayroll.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formPayroll);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalPayroll.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Payroll';

      apiClient.show(API_ENDPOINTS.HR.PAYROLL.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('payroll_id').value = item.id;
          formPayroll.querySelector('[name="employee_id"]').value = item.employee_id || '';
          formPayroll.querySelector('[name="month"]').value = item.month || '';
          formPayroll.querySelector('[name="basic_salary"]').value = item.basic_salary || '';
          formPayroll.querySelector('[name="allowances"]').value = item.allowances || 0;
          formPayroll.querySelector('[name="deductions"]').value = item.deductions || 0;
          formPayroll.querySelector('[name="net_pay"]').value = item.net_pay || '';
          formPayroll.querySelector('[name="status"]').value = item.status || 'Pending';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Payroll';
      formPayroll.reset();
      document.getElementById('payroll_id').value = '';
    }
  });

  formPayroll.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('payroll_id').value;

    const formData = new FormData(formPayroll);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.HR.PAYROLL.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.HR.PAYROLL.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalPayroll).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formPayroll, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.HR.PAYROLL.DESTROY, deleteId)
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

  document.querySelectorAll('.btn-process-payment').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      apiClient.update(API_ENDPOINTS.HR.PAYROLL.UPDATE, id, { status: 'Paid' })
      .then(data => {
        if (data.success || data.id) {
          showToast('Payment processed successfully', 'success');
          setTimeout(() => location.reload(), 500);
        } else {
          showToast(data.message || 'Process failed', 'error');
        }
      })
      .catch(error => showToast(error.message || 'Process failed', 'error'));
    });
  });
});
</script>
@endpush