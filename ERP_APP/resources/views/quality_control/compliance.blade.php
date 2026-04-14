@extends('layouts.erp')

@section('title', 'Compliance Reports')
@section('breadcrumb', 'Compliance Reports')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Compliance Reports</div>
    <div class="page-subtitle">Regulatory compliance reports and certification tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCompliance"><i class="bi bi-plus-lg"></i> New Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search compliance reports…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Compliant</option><option>Non-Compliant</option><option>Pending</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Report #</th><th>Standard/Regulation</th><th>Scope</th><th>Audit Date</th><th>Next Audit</th><th>Auditor</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $compliance)
        <tr>
          <td>COMP-{{ $compliance->id }}</td>
          <td>{{ $compliance->standard_regulation }}</td>
          <td>{{ $compliance->scope }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->audit_date)->format('Y-m-d') }}</td>
          <td>{{ \Carbon\Carbon::parse($compliance->next_audit_date)->format('Y-m-d') }}</td>
          <td>{{ $compliance->auditor }}</td>
          <td>
            @if($compliance->status === 'Compliant' || $compliance->status === 'Active')
            <span class="badge-status badge-active">Compliant</span>
            @elseif($compliance->status === 'Non-Compliant' || $compliance->status === 'Failed')
            <span class="badge-status badge-inactive">Failed</span>
            @elseif($compliance->status === 'Pending')
            <span class="badge-status badge-pending">Pending</span>
            @else
            <span class="badge-status">{{ $compliance->status }}</span>
            @endif
          </td>
          <td>
            <div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalCompliance" title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Report" title="Delete"><i class="bi bi-trash"></i></button>
            </div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No compliance reports found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="erp-pagination">
    {{ $data->links('pagination::bootstrap-5') }}
  </div>
</div>

<div class="modal fade" id="modalCompliance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Compliance Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Standard / Regulation</label><input class="erp-form-control" type="text" placeholder="e.g. ISO 9001:2015"/></div><div class="col-md-6"><label class="erp-form-label">Scope</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Audit Date</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Next Audit</label><input class="erp-form-control" type="date" placeholder=""/></div><div class="col-md-4"><label class="erp-form-label">Auditor</label><input class="erp-form-control" type="text" placeholder=""/></div><div class="col-md-12"><label class="erp-form-label">Findings / Notes</label><textarea class="erp-form-control" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save
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