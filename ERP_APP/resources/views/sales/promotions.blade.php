@extends('layouts.erp')

@section('title', 'Discounts & Promotions')
@section('breadcrumb', 'Discounts & Promotions')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Discounts & Promotions</div>
    <div class="page-subtitle">Create and manage discount rules and promotional campaigns</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPromo"><i class="bi bi-plus-lg"></i> New Promotion</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search discounts & promotions…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Scheduled</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Promo Code</th><th>Description</th><th>Discount</th><th>Type</th><th>Valid From</th><th>Valid To</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $promo)
          <tr>
            <td>{{ $promo->promo_code }}</td>
            <td>{{ $promo->description }}</td>
            <td>
              @if ($promo->discount_type == 'Percentage')
                {{ $promo->discount_value }}%
              @else
                ${{ number_format($promo->discount_value, 2) }}
              @endif
            </td>
            <td>{{ $promo->discount_type }}</td>
            <td>{{ $promo->valid_from ? \Carbon\Carbon::parse($promo->valid_from)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $promo->valid_to ? \Carbon\Carbon::parse($promo->valid_to)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              @if ($promo->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @elseif ($promo->status == 'Scheduled')
                <span class="badge-status badge-pending">Scheduled</span>
              @else
                <span class="badge-status badge-inactive">Expired</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalPromo" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Promotion" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalPromo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Promotion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Promo Code</label><input class="erp-form-control" type="text" placeholder="PROMO2025"/></div><div class="col-md-6"><label class="erp-form-label">Description</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Discount Value</label><input class="erp-form-control" type="number" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Type</label><select class="erp-form-control"><option>Percentage</option><option>Fixed Amount</option><option>Free Shipping</option></select></div><div class="col-md-4"><label class="erp-form-label">Min. Order ($)</label><input class="erp-form-control" type="number" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Valid From</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Valid To</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-12"><label class="erp-form-label">Applicable Products/Categories</label><input class="erp-form-control" type="text" placeholder="All or specify…"/></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Promotion
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