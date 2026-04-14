@extends('layouts.erp')

@section('title', 'Defect Tracking')
@section('breadcrumb', 'Quality Control / Defect Tracking')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Defect Tracking</div>
    <div class="page-subtitle">Log, track and resolve product defects and non-conformances</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDefect"><i
        class="bi bi-plus-lg"></i> Log Defect</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search defect tracking…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Open</option>
      <option>In Review</option>
      <option>Resolved</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Defect #</th>
          <th>Product</th>
          <th>Batch/Lot</th>
          <th>Defect Type</th>
          <th>Severity</th>
          <th>Raised By</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $defect)
          <tr>
            <td>DEF-{{ $defect->id }}</td>
            <td>{{ $defect->product_id ?? 'N/A' }}</td>
            <td>{{ $defect->batch_lot_number ?? 'N/A' }}</td>
            <td>{{ $defect->defect_type ?? 'N/A' }}</td>
            <td>
              @if ($defect->severity == 'Critical')
                <span class="badge-status badge-inactive">Critical</span>
              @elseif ($defect->severity == 'High')
                <span class="badge-status badge-pending">High</span>
              @else
                <span class="badge-status badge-info">{{ $defect->severity }}</span>
              @endif
            </td>
            <td>—</td>
            <td>
              @if ($defect->status == 'Resolved')
                <span class="badge-status badge-active">Resolved</span>
              @elseif ($defect->status == 'Open')
                <span class="badge-status badge-pending">Open</span>
              @else
                <span class="badge-status badge-pending">In Review</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                  data-bs-target="#modalDefect" title="Edit"><i class="bi bi-pencil"></i></button><button
                  class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                  data-delete-label="Defect" title="Delete"><i class="bi bi-trash"></i></button></div>
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

<div class="modal fade" id="modalDefect" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Defect</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control">
              <option>Assembled PCB Board</option>
              <option>Battery Pack 18V</option>
              <option>Steel Bracket</option>
            </select></div>
          <div class="col-md-6"><label class="erp-form-label">Batch / Lot</label><input class="erp-form-control"
              type="text" placeholder="LOT-XXXX-XXX" /></div>
          <div class="col-md-6"><label class="erp-form-label">Defect Type</label><input class="erp-form-control"
              type="text" placeholder="e.g. Dimensional Error" /></div>
          <div class="col-md-3"><label class="erp-form-label">Severity</label><select class="erp-form-control">
              <option>Low</option>
              <option>Medium</option>
              <option>High</option>
              <option>Critical</option>
            </select></div>
          <div class="col-md-3"><label class="erp-form-label">Qty Affected</label><input class="erp-form-control"
              type="number" placeholder="" /></div>
          <div class="col-md-12"><label class="erp-form-label">Description / Root Cause</label><textarea
              class="erp-form-control" rows="3" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Log Defect
        </button>
      </div>
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
