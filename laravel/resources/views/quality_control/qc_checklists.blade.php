@extends('layouts.erp')

@section('title', 'QC Checklists')
@section('breadcrumb', 'Quality Control / QC Checklists')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">QC Checklists</div>
    <div class="page-subtitle">Quality inspection checklists for products and production</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalQC" data-mode="create"><i class="bi bi-plus-lg"></i> New Checklist</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search qc checklists…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Incoming</option><option>In-Process</option><option>Final</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Checklist #</th><th>Product/Batch</th><th>Inspector</th><th>Inspection Type</th><th>Items Checked</th><th>Pass Rate</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $checklist)
          <tr>
            <td>QC-{{ $checklist->id }}</td>
            <td>{{ $checklist->product_batch_work_order ?? 'N/A' }}</td>
            <td>{{ $checklist->inspector_id ?? 'N/A' }}</td>
            <td>{{ $checklist->inspection_type ?? 'N/A' }}</td>
            <td>0/0</td>
            <td>0%</td>
            <td>
              @if ($checklist->status == 'Passed')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Failed</span>
              @endif
            </td>
            <td><div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                data-id="{{ $checklist->id }}"
                data-mode="edit"
                data-bs-toggle="modal" data-bs-target="#modalQC"
                title="Edit"><i class="bi bi-pencil"></i></button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                data-delete-id="{{ $checklist->id }}"
                data-delete-label="Checklist" 
                data-bs-toggle="modal" data-bs-target="#modalDelete"
                title="Delete"><i class="bi bi-trash"></i></button>
            </div></td>
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

<div class="modal fade" id="modalQC" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New QC Checklist</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-checklist">
          <input type="hidden" name="id" id="checklist-id">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Product / Batch / Work Order</label>
              <input class="erp-form-control" type="text" name="product_batch_work_order" placeholder=""/>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Inspector</label>
              <select class="erp-form-control" name="inspector_id">
                <option value="">Select Inspector</option>
                <option>Nadia Q.</option>
                <option>Kamal I.</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Inspection Type</label>
              <select class="erp-form-control" name="inspection_type">
                <option value="">Select Type</option>
                <option>Incoming</option>
                <option>In-Process</option>
                <option>Final</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Inspection Date</label>
              <input class="erp-form-control" type="date" name="inspection_date"/>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Sample Size</label>
              <input class="erp-form-control" type="number" name="sample_size" placeholder=""/>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Checklist Items / Notes</label>
              <textarea class="erp-form-control" name="notes" rows="3" placeholder="List inspection criteria…"></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save Checklist
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
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
  const modalQC = document.getElementById('modalQC');
  const formChecklist = document.getElementById('form-checklist');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalQC.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formChecklist);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit QC Checklist';

      apiClient.show(API_ENDPOINTS.QUALITY_CONTROL.QC_CHECKLISTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('checklist-id').value = item.id;
          formChecklist.querySelector('[name="product_batch_work_order"]').value = item.product_batch_work_order || '';
          formChecklist.querySelector('[name="inspector_id"]').value = item.inspector_id || '';
          formChecklist.querySelector('[name="inspection_type"]').value = item.inspection_type || '';
          formChecklist.querySelector('[name="inspection_date"]').value = item.inspection_date ? item.inspection_date.split('T')[0] : '';
          formChecklist.querySelector('[name="sample_size"]').value = item.sample_size || '';
          formChecklist.querySelector('[name="notes"]').value = item.notes || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New QC Checklist';
      formChecklist.reset();
      document.getElementById('checklist-id').value = '';
    }
  });

  formChecklist.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('checklist-id').value;

    const formData = new FormData(formChecklist);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.QUALITY_CONTROL.QC_CHECKLISTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.QUALITY_CONTROL.QC_CHECKLISTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalQC).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formChecklist, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'record';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.QUALITY_CONTROL.QC_CHECKLISTS.DESTROY, deleteId)
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