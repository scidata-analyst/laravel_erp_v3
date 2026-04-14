@extends('layouts.erp')

@section('title', 'Customer Support')
@section('breadcrumb', 'Customer Support')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Customer Support</div>
      <div class="page-subtitle">Customer support tickets, complaints and resolution tracking</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupport"><i
          class="bi bi-plus-lg"></i> New Ticket</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer support…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Open</option>
        <option>In Progress</option>
        <option>Resolved</option>
        <option>Closed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Ticket #</th>
            <th>Customer</th>
            <th>Subject</th>
            <th>Priority</th>
            <th>Assigned To</th>
            <th>Created</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $ticket)
            <tr>
              <td>{{ $ticket->ticket_number }}</td>
              <td>{{ $ticket->customer_id ?? 'N/A' }}</td>
              <td>{{ $ticket->subject }}</td>
              <td>
                @if ($ticket->priority == 'Urgent')
                  <span class="badge-status badge-inactive">Urgent</span>
                @elseif ($ticket->priority == 'High')
                  <span class="badge-status badge-pending">High</span>
                @else
                  <span class="badge-status badge-info">{{ $ticket->priority }}</span>
                @endif
              </td>
              <td>{{ $ticket->assigned_user_id ?? 'N/A' }}</td>
              <td>{{ $ticket->created_at ? \Carbon\Carbon::parse($ticket->created_at)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if ($ticket->status == 'Open')
                  <span class="badge-status badge-pending">Open</span>
                @elseif ($ticket->status == 'In Progress')
                  <span class="badge-status badge-pending">In Progress</span>
                @elseif ($ticket->status == 'Resolved')
                  <span class="badge-status badge-active">Resolved</span>
                @else
                  <span class="badge-status badge-active">{{ $ticket->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalSupport" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Ticket" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalSupport" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Support Ticket</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Customer</label><select class="erp-form-control">
                <option>Acme Corporation</option>
                <option>Delta Retailers</option>
                <option>Omega Group</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Subject</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Priority</label><select class="erp-form-control">
                <option>Low</option>
                <option>Medium</option>
                <option>High</option>
                <option>Urgent</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Assign To</label><select class="erp-form-control">
                <option>Sara L.</option>
                <option>James R.</option>
                <option>Adam K.</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Category</label><select class="erp-form-control">
                <option>Billing</option>
                <option>Delivery</option>
                <option>Quality</option>
                <option>Other</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="3" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Create Ticket
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