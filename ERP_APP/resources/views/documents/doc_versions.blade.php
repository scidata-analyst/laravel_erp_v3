@extends('layouts.erp')

@section('title', 'Version Control')
@section('breadcrumb', 'Version Control')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Version Control</div>
    <div class="page-subtitle">Track document revision history and access control</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalVersion"><i
        class="bi bi-plus-lg"></i> New Version</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search version control…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Latest</option>
      <option>Archived</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Document</th>
          <th>Version</th>
          <th>Changed By</th>
          <th>Change Summary</th>
          <th>Date</th>
          <th>Approved By</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $version)
          <tr>
            <td>{{ $version->document_id ?? 'N/A' }}</td>
            <td>{{ $version->version ?? 'v1.0' }}</td>
            <td>{{ $version->changed_by ?? 'N/A' }}</td>
            <td>{{ $version->change_summary ?? 'N/A' }}</td>
            <td>{{ $version->created_at ? \Carbon\Carbon::parse($version->created_at)->format('Y-m-d') : 'N/A' }}</td>
            <td>—</td>
            <td>
              @if ($version->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Archived</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                  data-bs-target="#modalVersion" title="Edit"><i class="bi bi-pencil"></i></button><button
                  class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                  data-delete-label="Version" title="Delete"><i class="bi bi-trash"></i></button></div>
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

<div class="modal fade" id="modalVersion" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add New Version</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Document</label><select class="erp-form-control">
              <option>Supplier Agreement – TechSource</option>
              <option>Employee Handbook</option>
              <option>Quality Manual</option>
            </select></div>
          <div class="col-md-3"><label class="erp-form-label">New Version</label><input class="erp-form-control"
              type="text" placeholder="v2.2" /></div>
          <div class="col-md-3"><label class="erp-form-label">Change Type</label><select class="erp-form-control">
              <option>Minor</option>
              <option>Major</option>
              <option>Correction</option>
            </select></div>
          <div class="col-md-12"><label class="erp-form-label">Change Summary</label><textarea
              class="erp-form-control" rows="2" placeholder="Describe what changed…"></textarea></div>
          <div class="col-md-6"><label class="erp-form-label">Approver</label><select class="erp-form-control">
              <option>Adam K.</option>
              <option>Sara L.</option>
              <option>Maya P.</option>
            </select></div>
          <div class="col-md-6"><label class="erp-form-label">Upload New File</label><input class="erp-form-control"
              type="file" placeholder="" /></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Version
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
