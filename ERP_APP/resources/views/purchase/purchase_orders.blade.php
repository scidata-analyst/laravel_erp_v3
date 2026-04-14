@extends('layouts.erp')

@section('title', 'Purchase Orders')
@section('breadcrumb', 'Purchase Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Purchase Orders</div>
    <div class="page-subtitle">Create, approve and track purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPO"><i class="bi bi-plus-lg"></i> New PO</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search purchase orders…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Pending</option><option>Approved</option><option>Received</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>PO #</th><th>Supplier</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Approved By</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $po)
          <tr>
            <td>{{ $po->po_number }}</td>
            <td>{{ $po->supplier_id ?? 'N/A' }}</td>
            <td>{{ $po->order_date ? \Carbon\Carbon::parse($po->order_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1</td>
            <td>${{ number_format($po->total_amount, 2) }}</td>
            <td>
              @if ($po->status == 'Approved')
                <span class="badge-status badge-info">Approved</span>
              @elseif ($po->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @elseif ($po->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @else
                <span class="badge-status badge-inactive">{{ $po->status }}</span>
              @endif
            </td>
            <td>—</td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-success btn-xs btn-approve-po">Approve</button><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalPO" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="PO" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalPO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Create Purchase Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

      <div class="row g-3 mb-3">
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Supplier</label><select class="erp-form-control"><option>TechSource Ltd.</option><option>GlobalParts Inc.</option></select></div></div>
        <div class="col-md-3"><div class="col-md-12"><label class="erp-form-label">Order Date</label><input class="erp-form-control" type="date" placeholder=""/></div></div>
        <div class="col-md-3"><div class="col-md-12"><label class="erp-form-label">Expected Delivery</label><input class="erp-form-control" type="date" placeholder=""/></div></div>
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Warehouse</label><select class="erp-form-control"><option>WH-A</option><option>WH-B</option></select></div></div>
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Payment Terms</label><select class="erp-form-control"><option>Net 30</option><option>Net 60</option><option>Prepaid</option></select></div></div>
      </div>
      <label class="erp-form-label">Order Items</label>
      <div class="erp-table-wrap"><table class="erp-table"><thead><tr><th>Product</th><th>Qty</th><th>Unit Cost</th><th>Total</th></tr></thead>
      <tbody><tr>
        <td><input class="erp-form-control" placeholder="Product name" style="min-width:160px"/></td>
        <td><input class="erp-form-control" type="number" style="width:80px" placeholder="1"/></td>
        <td><input class="erp-form-control" type="number" style="width:100px" placeholder="0.00"/></td>
        <td style="color:var(--accent);font-family:'IBM Plex Mono',monospace">$0.00</td>
      </tr></tbody></table></div>
      <button class="btn-erp btn-outline btn-sm mt-2"><i class="bi bi-plus"></i> Add Line</button>
      <div class="d-flex justify-content-end mt-3"><div class="text-end">
        <div class="stat-row-label">Subtotal: <span class="stat-row-val">$0.00</span></div>
        <div class="stat-row-label">Tax (10%): <span class="stat-row-val">$0.00</span></div>
        <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-top:6px">Total: $0.00</div>
      </div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Submit PO
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