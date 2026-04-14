@extends('layouts.erp')

@section('title', 'Sales Orders')
@section('breadcrumb', 'Sales Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Sales Orders</div>
    <div class="page-subtitle">Track and manage all sales orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSO"><i class="bi bi-plus-lg"></i> New Order</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search sales orders…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Pending</option><option>Confirmed</option><option>Dispatched</option><option>Delivered</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>SO #</th><th>Customer</th><th>Date</th><th>Items</th><th>Total</th><th>Delivery</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $order)
          <tr>
            <td>{{ $order->order_number }}</td>
            <td>{{ $order->customer_id ?? 'N/A' }}</td>
            <td>{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1</td>
            <td>${{ number_format($order->total_amount, 2) }}</td>
            <td>{{ $order->delivery_date ? \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              @if ($order->status == 'Delivered')
                <span class="badge-status badge-active">Delivered</span>
              @elseif ($order->status == 'Dispatched')
                <span class="badge-status badge-info">Dispatched</span>
              @elseif ($order->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @else
                <span class="badge-status badge-inactive">{{ $order->status }}</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalSO" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Order" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalSO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Sales Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

      <div class="row g-3 mb-3">
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Customer</label><select class="erp-form-control"><option>Acme Corporation</option><option>Delta Retailers</option></select></div></div>
        <div class="col-md-3"><div class="col-md-12"><label class="erp-form-label">Order Date</label><input class="erp-form-control" type="date" placeholder=""/></div></div>
        <div class="col-md-3"><div class="col-md-12"><label class="erp-form-label">Delivery Date</label><input class="erp-form-control" type="date" placeholder=""/></div></div>
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Payment Terms</label><select class="erp-form-control"><option>Net 30</option><option>Due on Receipt</option></select></div></div>
        <div class="col-md-6"><div class="col-md-12"><label class="erp-form-label">Discount (%)</label><input class="erp-form-control" type="number" placeholder="0"/></div></div>
      </div>
      <label class="erp-form-label">Order Items</label>
      <div class="erp-table-wrap"><table class="erp-table"><thead><tr><th>Product</th><th>Qty</th><th>Unit Price</th><th>Discount</th><th>Total</th></tr></thead>
      <tbody><tr>
        <td><select class="erp-form-control"><option>HP ProBook 450</option><option>Logitech MX Master</option></select></td>
        <td><input class="erp-form-control" type="number" style="width:70px" value="1"/></td>
        <td style="font-family:'IBM Plex Mono',monospace">$849.00</td>
        <td><input class="erp-form-control" type="number" style="width:70px" placeholder="0%"/></td>
        <td style="color:var(--accent-2);font-family:'IBM Plex Mono',monospace">$849.00</td>
      </tr></tbody></table></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Confirm Order
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