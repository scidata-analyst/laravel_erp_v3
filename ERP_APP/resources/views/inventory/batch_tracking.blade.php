@extends('layouts.erp')

@section('title', 'Batch / Expiry Tracking')
@section('breadcrumb', 'Inventory / Batch / Expiry Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Batch / Expiry / Serial Tracking</div>
      <div class="page-subtitle">Track lot numbers, serial IDs and expiry dates</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBatch"><i
          class="bi bi-plus-lg"></i> Add Batch</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main"
          placeholder="Search batch / expiry / serial tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Expiring Soon</option>
        <option>Expired</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Batch/Lot #</th>
            <th>Serial</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Mfg Date</th>
            <th>Expiry</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $batch)
            <tr>
              <td>{{ $batch->batch_lot_number }}</td>
              <td>{{ $batch->serial_number ?? 'N/A' }}</td>
              <td>{{ $batch->product_id ?? 'N/A' }}</td>
              <td>{{ $batch->quantity }}</td>
              <td>{{ $batch->manufacture_date ? \Carbon\Carbon::parse($batch->manufacture_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $batch->expiry_date ? \Carbon\Carbon::parse($batch->expiry_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if (\Carbon\Carbon::parse($batch->expiry_date)->isPast())
                  <span class="badge-status badge-inactive">Expired</span>
                @else
                  <span class="badge-status badge-active">Active</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalBatch" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Batch" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalBatch" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Batch / Serial</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control">
                <option>Paracetamol 500mg</option>
                <option>Battery Pack</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Batch / Lot #</label><input class="erp-form-control"
                type="text" placeholder="LOT-XXXX-XXX" /></div>
            <div class="col-md-6"><label class="erp-form-label">Serial Number</label><input class="erp-form-control"
                type="text" placeholder="SN-XXXXX" /></div>
            <div class="col-md-6"><label class="erp-form-label">Quantity</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Manufacturing Date</label><input
                class="erp-form-control" type="date" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Expiry Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Batch
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