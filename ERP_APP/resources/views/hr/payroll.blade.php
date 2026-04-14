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
            <tr>
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
                @if ($payroll->status == 'Paid')
                  <button class="btn-erp btn-outline btn-xs"><i class="bi bi-file-earmark-text"></i> Slip</button>
                @else
                  <button class="btn-erp btn-success btn-xs btn-process-payment">Process</button>
                @endif
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