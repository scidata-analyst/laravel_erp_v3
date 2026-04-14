@extends('layouts.erp')

@section('title', 'POS Terminals')
@section('breadcrumb', 'POS Terminals')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">POS Terminals</div>
      <div class="page-subtitle">Point-of-sale terminal management and session tracking</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPOS"><i
          class="bi bi-plus-lg"></i> Add Terminal</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search pos terminals…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Online</option>
        <option>Offline</option>
        <option>Closed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Terminal ID</th>
            <th>Location</th>
            <th>Cashier</th>
            <th>Session Start</th>
            <th>Sales (Today)</th>
            <th>Transactions</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $pos)
            <tr>
              <td>{{ $pos->terminal_id }}</td>
              <td>{{ $pos->location ?? 'N/A' }}</td>
              <td>{{ $pos->assigned_cashier_id ?? '—' }}</td>
              <td>{{ $pos->created_at ? \Carbon\Carbon::parse($pos->created_at)->format('Y-m-d H:i') : '—' }}</td>
              <td>$0</td>
              <td>0 txns</td>
              <td>
                @if ($pos->status == 'Online' || $pos->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($pos->status == 'Offline')
                  <span class="badge-status badge-inactive">Offline</span>
                @else
                  <span class="badge-status badge-pending">{{ $pos->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalPOS" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Terminal" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalPOS" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add POS Terminal</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Terminal ID</label><input class="erp-form-control"
                type="text" placeholder="POS-XXX" /></div>
            <div class="col-md-6"><label class="erp-form-label">Location</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Assigned Cashier</label><select
                class="erp-form-control">
                <option>Anika R.</option>
                <option>Farhan S.</option>
                <option>Tania M.</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Warehouse / Inventory</label><select
                class="erp-form-control">
                <option>WH-A</option>
                <option>WH-B</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Receipt Printer</label><input class="erp-form-control"
                type="text" placeholder="Printer IP or model" /></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Terminal
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