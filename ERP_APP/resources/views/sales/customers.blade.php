@extends('layouts.erp')

@section('title', 'Customer Management')
@section('breadcrumb', 'Customer Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Customer Management</div>
    <div class="page-subtitle">Customer info, credit limits and receivables</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="bi bi-plus-lg"></i> Add Customer</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Blocked</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Customer</th><th>Contact</th><th>Email</th><th>Credit Limit</th><th>Outstanding</th><th>Sales Rep</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $customer)
          <tr>
            <td>{{ $customer->company_name }}</td>
            <td>{{ $customer->contact_person }}</td>
            <td>{{ $customer->email }}</td>
            <td>${{ number_format($customer->credit_limit, 2) }}</td>
            <td>$0</td>
            <td>{{ $customer->sales_rep_id ?? 'N/A' }}</td>
            <td><span class="badge-status badge-active">Active</span></td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalCustomer" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Customer" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Customer</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Company Name</label><input class="erp-form-control" type="text" placeholder="Company name"/></div><div class="col-md-6"><label class="erp-form-label">Contact Person</label><input class="erp-form-control" type="text" placeholder="Contact name"/></div><div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" type="email" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Credit Limit ($)</label><input class="erp-form-control" type="number" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Sales Rep</label><select class="erp-form-control"><option>Sara L.</option><option>James R.</option></select></div><div class="col-md-12"><label class="erp-form-label">Billing Address</label><textarea class="erp-form-control" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Customer
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