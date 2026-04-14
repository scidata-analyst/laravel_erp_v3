@extends('layouts.erp')

@section('title', 'Machine & Labor')
@section('breadcrumb', 'Production / Machine & Labor')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Machine & Labor</div>
      <div class="page-subtitle">Track machine utilization and labor hours on production</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalMachineLabor"><i
          class="bi bi-plus-lg"></i> Log Entry</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search machine & labor…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Machine</option>
        <option>Labor</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Work Order</th>
            <th>Resource</th>
            <th>Type</th>
            <th>Scheduled Hours</th>
            <th>Actual Hours</th>
            <th>Cost/hr</th>
            <th>Total Cost</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $ml)
            <tr>
              <td>WO-{{ $ml->work_order_id ?? 'N/A' }}</td>
              <td>{{ $ml->resource_name ?? 'N/A' }}</td>
              <td>{{ $ml->resource_type ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $ml->hours_used ?? 0 }}h</td>
              <td>${{ number_format($ml->cost_per_hour ?? 0, 2) }}</td>
              <td>${{ number_format($ml->total_cost ?? 0, 2) }}</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalMachineLabor" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Entry" title="Delete"><i class="bi bi-trash"></i></button></div>
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


  <div class="modal fade" id="modalMachineLabor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Machine / Labor Entry</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Work Order</label><select class="erp-form-control">
                <option>WO-2025-011</option>
                <option>WO-2025-010</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Resource Name</label><input class="erp-form-control"
                type="text" placeholder="Machine or employee name" /></div>
            <div class="col-md-4"><label class="erp-form-label">Type</label><select class="erp-form-control">
                <option>Machine</option>
                <option>Labor</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Hours Used</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Cost per Hour ($)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Log Entry
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- Delete Confirm Modal -->
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