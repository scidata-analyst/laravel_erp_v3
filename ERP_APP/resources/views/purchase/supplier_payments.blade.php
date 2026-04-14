@extends('layouts.erp')

@section('title', 'Supplier Payments')
@section('breadcrumb', 'Supplier Payments')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Payments</div>
    <div class="page-subtitle">Track all outgoing payments to suppliers</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplierPay"><i class="bi bi-plus-lg"></i> New Payment</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier payments…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Paid</option><option>Pending</option><option>Overdue</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Payment #</th><th>Supplier</th><th>Invoice Ref</th><th>Amount</th><th>Payment Date</th><th>Method</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $payment)
          <tr>
            <td>{{ $payment->payment_number }}</td>
            <td>{{ $payment->supplier_id ?? 'N/A' }}</td>
            <td>{{ $payment->invoice_reference ?? 'N/A' }}</td>
            <td>${{ number_format($payment->amount, 2) }}</td>
            <td>{{ $payment->payment_date ? \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $payment->payment_method ?? 'N/A' }}</td>
            <td>
              @if ($payment->status == 'Paid')
                <span class="badge-status badge-active">Paid</span>
              @elseif ($payment->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @else
                <span class="badge-status badge-inactive">Overdue</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalSupplierPay" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Payment" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalSupplierPay" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Supplier Payment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Supplier</label><select class="erp-form-control"><option>TechSource Ltd.</option><option>GlobalParts Inc.</option></select></div><div class="col-md-6"><label class="erp-form-label">Invoice Reference</label><input class="erp-form-control" type="text" placeholder="INV-SUP-XXX"/></div><div class="col-md-4"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" type="number" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Payment Date</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Method</label><select class="erp-form-control"><option>Bank Transfer</option><option>Cheque</option><option>Cash</option></select></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Record Payment
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
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