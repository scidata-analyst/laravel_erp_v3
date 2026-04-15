@extends('layouts.erp')

@section('title', 'Interaction History')
@section('breadcrumb', 'Interaction History')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Interaction History</div>
      <div class="page-subtitle">Customer interaction and communication history log</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalInteraction"
        data-route="{{ route('interactions.store') }}" data-mode="create"><i
          class="bi bi-plus-lg"></i> Log Interaction</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search interaction history…" />
      </div>
      <select class="erp-form-control" style="width:140px" id="filter-type">
        <option value="">All Types</option>
        <option>Call</option>
        <option>Email</option>
        <option>Meeting</option>
        <option>Demo</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Date</th>
            <th>Customer</th>
            <th>Contact</th>
            <th>Type</th>
            <th>Summary</th>
            <th>Duration</th>
            <th>Logged By</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $interaction)
            <tr data-id="{{ $interaction->id }}">
              <td>{{ $interaction->interaction_date ? \Carbon\Carbon::parse($interaction->interaction_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $interaction->customer_id ?? 'N/A' }}</td>
              <td>{{ $interaction->contact_person ?? 'N/A' }}</td>
              <td>{{ $interaction->interaction_type }}</td>
              <td>{{ $interaction->summary ?? 'N/A' }}</td>
              <td>{{ $interaction->duration ?? '—' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalInteraction" title="Edit"
                    data-route="{{ route('interactions.update', $interaction->id) }}"
                    data-mode="edit"
                    data-interaction='@json($interaction)'><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" title="Delete"
                    data-route="{{ route('interactions.destroy', $interaction->id) }}"
                    data-label="Interaction"><i class="bi bi-trash"></i></button>
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

  <div class="modal fade" id="modalInteraction" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Interaction</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-interaction">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Customer</label>
                <select class="erp-form-control" name="customer_id">
                  <option value="">Select Customer</option>
                  <option value="Acme Corporation">Acme Corporation</option>
                  <option value="Delta Retailers">Delta Retailers</option>
                  <option value="BetaCorp">BetaCorp</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Contact Person</label>
                <input class="erp-form-control" type="text" name="contact_person" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Interaction Type</label>
                <select class="erp-form-control" name="interaction_type">
                  <option value="Call">Call</option>
                  <option value="Email">Email</option>
                  <option value="Meeting">Meeting</option>
                  <option value="Demo">Demo</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Date</label>
                <input class="erp-form-control" type="date" name="interaction_date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Duration</label>
                <input class="erp-form-control" type="text" name="duration" placeholder="e.g. 30 min" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Summary / Notes</label>
                <textarea class="erp-form-control" name="summary" rows="3" placeholder=""></textarea>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Next Action</label>
                <input class="erp-form-control" type="text" name="next_action" placeholder="Follow up on…" />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save
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
    const modalInteraction = document.getElementById('modalInteraction');
    const modalDelete = document.getElementById('modalDelete');
    const formInteraction = document.getElementById('form-interaction');
    let deleteUrl = null;

    modalInteraction.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      const mode = btn?.dataset.mode || 'create';
      const route = btn?.dataset.route || '{{ route("interactions.store") }}';
      
      formInteraction.action = route;
      formInteraction.method = mode === 'create' ? 'POST' : 'PUT';
      
      const title = modalInteraction.querySelector('.modal-title');
      const submitBtn = modalInteraction.querySelector('.btn-modal-save');
      
      if (mode === 'edit') {
        title.textContent = 'Edit Interaction';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update';
        
        const interaction = JSON.parse(btn.dataset.interaction);
        formInteraction.querySelector('[name="customer_id"]').value = interaction.customer_id || '';
        formInteraction.querySelector('[name="contact_person"]').value = interaction.contact_person || '';
        formInteraction.querySelector('[name="interaction_type"]').value = interaction.interaction_type || 'Call';
        formInteraction.querySelector('[name="interaction_date"]').value = interaction.interaction_date || '';
        formInteraction.querySelector('[name="duration"]').value = interaction.duration || '';
        formInteraction.querySelector('[name="summary"]').value = interaction.summary || '';
        formInteraction.querySelector('[name="next_action"]').value = interaction.next_action || '';
      } else {
        title.textContent = 'Log Interaction';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save';
        formInteraction.reset();
      }
    });

    formInteraction.addEventListener('submit', async function(e) {
      e.preventDefault();
      const submitBtn = formInteraction.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

      try {
        const formData = new FormData(formInteraction);
        const method = formInteraction.method;
        const url = formInteraction.action;

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
          bootstrap.Modal.getInstance(modalInteraction)?.hide();
          showToast(result.message || 'Interaction saved successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to save interaction', 'error');
        }
      } catch (error) {
        showToast('An error occurred while saving', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save';
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