@extends('layouts.erp')

@section('title', 'Multi-Warehouse Management')
@section('breadcrumb', 'Multi-Warehouse Management')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Multi-Warehouse Management</div>
      <div class="page-subtitle">Manage multiple warehouse locations and capacity</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWarehouse"><i
          class="bi bi-plus-lg"></i> Add Warehouse</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main"
          placeholder="Search multi-warehouse management…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Inactive</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Warehouse</th>
            <th>Code</th>
            <th>Location</th>
            <th>Manager</th>
            <th>Capacity</th>
            <th>Used</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $warehouse)
            <tr>
              <td>{{ $warehouse->warehouse_name }}</td>
              <td>{{ $warehouse->warehouse_code }}</td>
              <td>{{ $warehouse->location_address ?? 'N/A' }}</td>
              <td>{{ $warehouse->manager_id ?? 'N/A' }}</td>
              <td>{{ number_format($warehouse->capacity_units ?? 0) }} units</td>
              <td>0 (0%)</td>
              <td>
                @if ($warehouse->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalWarehouse" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Warehouse" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalWarehouse" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Warehouse</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Warehouse Name</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-3"><label class="erp-form-label">Code</label><input class="erp-form-control" type="text"
                placeholder="WH-X" /></div>
            <div class="col-md-3"><label class="erp-form-label">Type</label><select class="erp-form-control">
                <option>Standard</option>
                <option>Cold Storage</option>
                <option>Bonded</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Location / Address</label><input
                class="erp-form-control" type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Manager</label><select class="erp-form-control">
                <option>Adam K.</option>
                <option>James R.</option>
                <option>Sara L.</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Capacity (units)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Warehouse
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
