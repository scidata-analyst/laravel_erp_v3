@extends('layouts.erp')

@section('title', 'QC Checklists')
@section('breadcrumb', 'Quality Control / QC Checklists')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">QC Checklists</div>
    <div class="page-subtitle">Quality inspection checklists for products and production</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalQC"><i class="bi bi-plus-lg"></i> New Checklist</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search qc checklists…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Incoming</option><option>In-Process</option><option>Final</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Checklist #</th><th>Product/Batch</th><th>Inspector</th><th>Inspection Type</th><th>Items Checked</th><th>Pass Rate</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $checklist)
          <tr>
            <td>QC-{{ $checklist->id }}</td>
            <td>{{ $checklist->product_batch_work_order ?? 'N/A' }}</td>
            <td>{{ $checklist->inspector_id ?? 'N/A' }}</td>
            <td>{{ $checklist->inspection_type ?? 'N/A' }}</td>
            <td>0/0</td>
            <td>0%</td>
            <td>
              @if ($checklist->status == 'Passed')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Failed</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalQC" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Checklist" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalQC" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New QC Checklist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Product / Batch / Work Order</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Inspector</label><select class="erp-form-control"><option>Nadia Q.</option><option>Kamal I.</option></select></div><div class="col-md-4"><label class="erp-form-label">Inspection Type</label><select class="erp-form-control"><option>Incoming</option><option>In-Process</option><option>Final</option></select></div><div class="col-md-4"><label class="erp-form-label">Inspection Date</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Sample Size</label><input class="erp-form-control" type="number" placeholder=""/></div><div class="col-md-12"><label class="erp-form-label">Checklist Items / Notes</label><textarea class="erp-form-control" rows="3" placeholder="List inspection criteria…"></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Checklist
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
