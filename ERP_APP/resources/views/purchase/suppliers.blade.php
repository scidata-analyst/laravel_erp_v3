@extends('layouts.erp')

@section('title', 'Supplier Management')
@section('breadcrumb', 'Supplier Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Management</div>
    <div class="page-subtitle">Manage supplier info, contacts and ratings</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplier"><i class="bi bi-plus-lg"></i> Add Supplier</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Supplier</th><th>Contact</th><th>Email</th><th>Country</th><th>Payment Terms</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $supplier)
          <tr>
            <td>{{ $supplier->company_name }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->country }}</td>
            <td>{{ $supplier->payment_terms }}</td>
            <td>⭐⭐⭐⭐</td>
            <td>
              @if ($supplier->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Inactive</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalSupplier" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Supplier" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalSupplier" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Supplier</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Company Name</label><input class="erp-form-control" type="text" placeholder="Supplier Ltd."/></div><div class="col-md-6"><label class="erp-form-label">Contact Person</label><input class="erp-form-control" type="text" placeholder="Contact name"/></div><div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" type="email" placeholder="contact@supplier.com"/></div><div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" type="text" placeholder="+1-555-0000"/></div><div class="col-md-4"><label class="erp-form-label">Country</label><input class="erp-form-control" type="text" placeholder="USA"/></div><div class="col-md-4"><label class="erp-form-label">Payment Terms</label><select class="erp-form-control"><option>Net 30</option><option>Net 60</option><option>Net 90</option><option>Prepaid</option></select></div><div class="col-md-4"><label class="erp-form-label">Currency</label><select class="erp-form-control"><option>USD</option><option>EUR</option><option>GBP</option><option>BDT</option></select></div><div class="col-md-12"><label class="erp-form-label">Address</label><textarea class="erp-form-control" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Supplier
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