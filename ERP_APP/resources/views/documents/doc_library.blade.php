@extends('layouts.erp')

@section('title', 'Document Library')
@section('breadcrumb', 'Document Library')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Document Library</div>
    <div class="page-subtitle">Centralized document storage for contracts, POs and invoices</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalDocument"><i
        class="bi bi-plus-lg"></i> Upload Document</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search document library…" />
    </div>
    <select class="erp-form-control" style="width:140px">
      <option>All Status</option>
      <option>Contract</option>
      <option>Invoice</option>
      <option>PO</option>
      <option>Report</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Document Name</th>
          <th>Type</th>
          <th>Related To</th>
          <th>Version</th>
          <th>Size</th>
          <th>Uploaded By</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $doc)
          <tr>
            <td>{{ $doc->document_name }}</td>
            <td>{{ $doc->document_type ?? 'N/A' }}</td>
            <td>{{ $doc->related_to ?? 'N/A' }}</td>
            <td>{{ $doc->version ?? 'v1.0' }}</td>
            <td>0 KB</td>
            <td>{{ $doc->uploaded_by_user_id ?? 'N/A' }}</td>
            <td>{{ $doc->created_at ? \Carbon\Carbon::parse($doc->created_at)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              <div class="d-flex gap-1"><button class="btn-erp btn-success btn-xs btn-icon btn-export"
                  title="Download"><i class="bi bi-download"></i></button><button
                  class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDocument"
                  title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon"
                  data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-label="Upload Document"
                  title="Delete"><i class="bi bi-trash"></i></button></div>
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

<div class="modal fade" id="modalDocument" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Upload Document</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Document Name</label><input class="erp-form-control"
              type="text" placeholder="" /></div>
          <div class="col-md-6"><label class="erp-form-label">Document Type</label><select class="erp-form-control">
              <option>Contract</option>
              <option>Invoice</option>
              <option>Purchase Order</option>
              <option>Report</option>
              <option>Certificate</option>
            </select></div>
          <div class="col-md-6"><label class="erp-form-label">Related To</label><input class="erp-form-control"
              type="text" placeholder="Supplier, Customer, Project…" /></div>
          <div class="col-md-3"><label class="erp-form-label">Version</label><input class="erp-form-control"
              type="text" placeholder="v1.0" /></div>
          <div class="col-md-3"><label class="erp-form-label">Access Level</label><select class="erp-form-control">
              <option>Public</option>
              <option>Private</option>
              <option>Restricted</option>
            </select></div>
          <div class="col-md-12"><label class="erp-form-label">Upload File</label><input class="erp-form-control"
              type="file" placeholder="" /></div>
          <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control"
              rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Upload
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
