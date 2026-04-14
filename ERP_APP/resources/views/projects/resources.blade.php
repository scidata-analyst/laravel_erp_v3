@extends('layouts.erp')

@section('title', 'Resource Allocation')
@section('breadcrumb', 'Projects / Resource Allocation')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Resource Allocation</div>
      <div class="page-subtitle">Assign team members and assets to projects</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalResource"><i
          class="bi bi-plus-lg"></i> Assign Resource</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search resource allocation…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>ERP v2</option>
        <option>Mobile App</option>
        <option>Infrastructure</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Role</th>
            <th>Project</th>
            <th>Allocation %</th>
            <th>From</th>
            <th>To</th>
            <th>Availability</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $resource)
            <tr>
              <td>{{ $resource->employee_id ?? 'N/A' }}</td>
              <td>{{ $resource->role_on_project ?? 'N/A' }}</td>
              <td>{{ $resource->project_name ?? 'N/A' }}</td>
              <td>{{ $resource->allocation_percentage ?? 0 }}%</td>
              <td>{{ $resource->from_date ? \Carbon\Carbon::parse($resource->from_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $resource->to_date ? \Carbon\Carbon::parse($resource->to_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ 100 - ($resource->allocation_percentage ?? 0) }}% free</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalResource" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Assign Resource" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalResource" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Assign Resource</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Employee</label><select class="erp-form-control">
                <option>Adam Khan</option>
                <option>Sara Lee</option>
                <option>James R.</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Project</label><input class="erp-form-control"
                type="text" placeholder="Project name" /></div>
            <div class="col-md-4"><label class="erp-form-label">Allocation (%)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">From Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">To Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Role on Project</label><input class="erp-form-control"
                type="text" placeholder="e.g. Lead Developer" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Assignment
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