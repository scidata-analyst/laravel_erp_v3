@extends('layouts.erp')

@section('title', 'Goods Receipt Notes')
@section('breadcrumb', 'Goods Receipt Notes')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Goods Receipt Notes</div>
    <div class="page-subtitle">Record goods received from suppliers against purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalGRN"><i class="bi bi-plus-lg"></i> New GRN</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search goods receipt notes…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Received</option><option>Partial</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>GRN #</th><th>PO Reference</th><th>Supplier</th><th>Received Date</th><th>Items</th><th>Total Value</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $grn)
          <tr>
            <td>{{ $grn->grn_number }}</td>
            <td>{{ $grn->purchase_order_id ?? 'N/A' }}</td>
            <td>{{ $grn->supplier_name ?? 'N/A' }}</td>
            <td>{{ $grn->receipt_date ? \Carbon\Carbon::parse($grn->receipt_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1 items</td>
            <td>$0</td>
            <td>
              @if ($grn->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @elseif ($grn->status == 'Partial')
                <span class="badge-status badge-pending">Partial</span>
              @else
                <span class="badge-status badge-info">Draft</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalGRN" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="GRN" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalGRN" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Goods Receipt Note</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Purchase Order</label><select class="erp-form-control"><option>PO-2025-0091</option><option>PO-2025-0089</option></select></div><div class="col-md-6"><label class="erp-form-label">Supplier</label><input class="erp-form-control" type="text" placeholder="TechSource Ltd."/></div><div class="col-md-6"><label class="erp-form-label">Receipt Date</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Warehouse</label><select class="erp-form-control"><option>WH-A</option><option>WH-B</option></select></div><div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save GRN
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