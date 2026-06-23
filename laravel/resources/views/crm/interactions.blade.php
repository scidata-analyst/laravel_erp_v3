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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalInteraction" data-mode="create"><i
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
                    data-bs-target="#modalInteraction" data-mode="edit" data-id="{{ $interaction->id }}"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" data-delete-id="{{ $interaction->id }}"
                    data-delete-label="Interaction" title="Delete"><i class="bi bi-trash"></i></button>
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
            <input type="hidden" name="id" id="interaction_id">
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
  const formInteraction = document.getElementById('form-interaction');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  /**
   * Handle show event for the Interaction Modal
   * Initializes the modal for either creating a new interaction or editing an existing one
   * @param {Event} e - The bootstrap modal show event
   */
  modalInteraction.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formInteraction);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalInteraction.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Interaction';

      apiClient.show(API_ENDPOINTS.CRM.INTERACTIONS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('interaction_id').value = item.id;
          formInteraction.querySelector('[name="customer_id"]').value = item.customer_id || '';
          formInteraction.querySelector('[name="contact_person"]').value = item.contact_person || '';
          formInteraction.querySelector('[name="interaction_type"]').value = item.interaction_type || 'Call';
          formInteraction.querySelector('[name="interaction_date"]').value = item.interaction_date || '';
          formInteraction.querySelector('[name="duration"]').value = item.duration || '';
          formInteraction.querySelector('[name="summary"]').value = item.summary || '';
          formInteraction.querySelector('[name="next_action"]').value = item.next_action || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Log Interaction';
      formInteraction.reset();
      document.getElementById('interaction_id').value = '';
    }
  });

  /**
   * Handle submission of the Interaction Form
   * Validates and saves the form data via APIClient
   * @param {Event} e - The form submit event
   */
  formInteraction.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('interaction_id').value;

    const formData = new FormData(formInteraction);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.CRM.INTERACTIONS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.CRM.INTERACTIONS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalInteraction).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formInteraction, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  /**
   * Handle the Delete Modal show event
   * Sets up the record ID to be deleted
   * @param {Event} e - The bootstrap modal show event
   */
  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'record';
  });

  /**
   * Handle confirmation of record deletion
   * Deletes the record via APIClient and reloads the page
   */
  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.CRM.INTERACTIONS.DESTROY, deleteId)
    .then(data => {
      if (data.success || !data.error) {
        bootstrap.Modal.getInstance(modalDelete).hide();
        showToast(data.message || 'Deleted successfully', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => showToast(error.message || 'An error occurred', 'error'));
  });
});
</script>
@endpush