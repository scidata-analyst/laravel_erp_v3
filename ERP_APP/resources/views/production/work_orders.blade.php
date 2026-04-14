@extends('layouts.erp')

@section('title', 'Work Orders')
@section('breadcrumb', 'Production / Work Orders')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Work Orders</div>
      <div class="page-subtitle">Production work orders and manufacturing scheduling</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWorkOrder"><i
          class="bi bi-plus-lg"></i> New Work Order</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search work orders…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Scheduled</option>
        <option>In Progress</option>
        <option>Completed</option>
        <option>On Hold</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>WO #</th>
            <th>Product</th>
            <th>BOM</th>
            <th>Qty</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Assigned To</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $workOrder)
            <tr>
              <td>WO-{{ $workOrder->id }}</td>
              <td>{{ $workOrder->bom_id ?? 'N/A' }}</td>
              <td>BOM-{{ $workOrder->bom_id ?? 'N/A' }}</td>
              <td>{{ $workOrder->quantity_to_produce ?? 0 }} units</td>
              <td>{{ $workOrder->start_date ? \Carbon\Carbon::parse($workOrder->start_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $workOrder->end_date ? \Carbon\Carbon::parse($workOrder->end_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $workOrder->workshop_line ?? 'N/A' }}</td>
              <td>
                @if ($workOrder->status == 'Completed')
                  <span class="badge-status badge-active">Completed</span>
                @elseif ($workOrder->status == 'In Progress')
                  <span class="badge-status badge-pending">In Progress</span>
                @elseif ($workOrder->status == 'Scheduled')
                  <span class="badge-status badge-info">Scheduled</span>
                @else
                  <span class="badge-status badge-pending">{{ $workOrder->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalWorkOrder" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Work Order" title="Delete"><i class="bi bi-trash"></i></button></div>
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


  <div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Work Order</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product / BOM</label><select class="erp-form-control">
                <option>BOM-001 – Assembled PCB Board</option>
                <option>BOM-002 – Custom Cable</option>
              </select></div>
            <div class="col-md-3"><label class="erp-form-label">Qty to Produce</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-3"><label class="erp-form-label">Priority</label><select class="erp-form-control">
                <option>Normal</option>
                <option>High</option>
                <option>Urgent</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Start Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">End Date</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Workshop / Line</label><select class="erp-form-control">
                <option>Workshop A</option>
                <option>Workshop B</option>
                <option>Workshop C</option>
              </select></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Create Work Order
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