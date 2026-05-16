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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupport"
        data-route="{{ route('support.store') }}" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Ticket</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer support…" />
      </div>
      <select class="erp-form-control" style="width:140px" id="filter-status">
        <option value="">All Status</option>
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
            <tr data-id="{{ $ticket->id }}">
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
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalSupport" title="Edit"
                    data-route="{{ route('support.update', $ticket->id) }}"
                    data-mode="edit"
                    data-ticket='@json($ticket)'><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" title="Delete"
                    data-route="{{ route('support.destroy', $ticket->id) }}"
                    data-label="Ticket"><i class="bi bi-trash"></i></button>
                </div>
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
        <form id="form-support">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Customer</label>
                <select class="erp-form-control" name="customer_id">
                  <option value="">Select Customer</option>
                  <option value="Acme Corporation">Acme Corporation</option>
                  <option value="Delta Retailers">Delta Retailers</option>
                  <option value="Omega Group">Omega Group</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Subject</label>
                <input class="erp-form-control" type="text" name="subject" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Priority</label>
                <select class="erp-form-control" name="priority">
                  <option value="Low">Low</option>
                  <option value="Medium">Medium</option>
                  <option value="High">High</option>
                  <option value="Urgent">Urgent</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Assign To</label>
                <select class="erp-form-control" name="assigned_user_id">
                  <option value="">Select</option>
                  <option value="Sara L.">Sara L.</option>
                  <option value="James R.">James R.</option>
                  <option value="Adam K.">Adam K.</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Category</label>
                <select class="erp-form-control" name="category">
                  <option value="Billing">Billing</option>
                  <option value="Delivery">Delivery</option>
                  <option value="Quality">Quality</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Description</label>
                <textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Create Ticket
            </button>
          </div>
        </form>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalSupport = document.getElementById('modalSupport');
    const modalDelete = document.getElementById('modalDelete');
    const formSupport = document.getElementById('form-support');
    let deleteUrl = null;

    modalSupport.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      const mode = btn?.dataset.mode || 'create';
      const route = btn?.dataset.route || '{{ route("support.store") }}';
      
      formSupport.action = route;
      formSupport.method = mode === 'create' ? 'POST' : 'PUT';
      
      const title = modalSupport.querySelector('.modal-title');
      const submitBtn = modalSupport.querySelector('.btn-modal-save');
      
      if (mode === 'edit') {
        title.textContent = 'Edit Support Ticket';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update Ticket';
        
        const ticket = JSON.parse(btn.dataset.ticket);
        formSupport.querySelector('[name="customer_id"]').value = ticket.customer_id || '';
        formSupport.querySelector('[name="subject"]').value = ticket.subject || '';
        formSupport.querySelector('[name="priority"]').value = ticket.priority || 'Low';
        formSupport.querySelector('[name="assigned_user_id"]').value = ticket.assigned_user_id || '';
        formSupport.querySelector('[name="category"]').value = ticket.category || 'Other';
        formSupport.querySelector('[name="description"]').value = ticket.description || '';
      } else {
        title.textContent = 'New Support Ticket';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Create Ticket';
        formSupport.reset();
      }
    });

    formSupport.addEventListener('submit', async function(e) {
      e.preventDefault();
      const submitBtn = formSupport.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

      try {
        const formData = new FormData(formSupport);
        const method = formSupport.method;
        const url = formSupport.action;

        const response = await fetch(url, {
          method: method,
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: method === 'PUT' ? new URLSearchParams(formData) : formData
        });

        const result = await response.json();

        if (result.success) {
          bootstrap.Modal.getInstance(modalSupport)?.hide();
          showToast(result.message || 'Ticket created successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to create ticket', 'error');
        }
      } catch (error) {
        showToast('An error occurred while saving', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Create Ticket';
      }
    });

    modalDelete.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      deleteUrl = btn?.dataset.route;
      const label = btn?.dataset.label || 'record';
      document.getElementById('delete-target').textContent = label;
    });

    document.getElementById('btn-confirm-delete').addEventListener('click', async function() {
      if (!deleteUrl) return;
      
      this.disabled = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';

      try {
        const response = await fetch(deleteUrl, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        });

        const result = await response.json();

        if (result.success) {
          bootstrap.Modal.getInstance(modalDelete)?.hide();
          showToast(result.message || 'Deleted successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to delete', 'error');
        }
      } catch (error) {
        showToast('An error occurred while deleting', 'error');
      } finally {
        this.disabled = false;
        this.innerHTML = '<i class="bi bi-trash"></i> Delete';
      }
    });

    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.className = `toast-notification toast-${type}`;
      toast.innerHTML = `
        <div class="toast-content">
          <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i>
          <span>${message}</span>
        </div>
      `;
      document.body.appendChild(toast);
      setTimeout(() => toast.remove(), 3000);
    }
  });
</script>
<style>
  .toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    padding: 12px 20px;
    border-radius: 6px;
    color: white;
    animation: slideIn 0.3s ease;
  }
  .toast-success { background: #28a745; }
  .toast-error { background: #dc3545; }
  .toast-content { display: flex; align-items: center; gap: 10px; }
  @keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
</style>
@endpush