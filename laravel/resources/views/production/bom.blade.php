@extends('layouts.erp')

@section('title', 'Bill of Materials')
@section('breadcrumb', 'Production / Bill of Materials')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Bill of Materials</div>
      <div class="page-subtitle">Define bill of materials for manufactured products</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBOM" data-mode="create"><i class="bi bi-plus-lg"></i> New BOM</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search bill of materials…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Draft</option>
        <option>Archived</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>BOM #</th>
            <th>Product</th>
            <th>Version</th>
            <th>Components</th>
            <th>Est. Cost</th>
            <th>Lead Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $bom)
            <tr>
              <td>BOM-{{ $bom->id }}</td>
              <td>{{ $bom->finished_product_name }}</td>
              <td>{{ $bom->version ?? 'v1.0' }}</td>
              <td>0 components</td>
              <td>$0.00</td>
              <td>{{ $bom->lead_time_days ?? 0 }} days</td>
              <td>
                @if ($bom->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($bom->status == 'Draft')
                  <span class="badge-status badge-info">Draft</span>
                @else
                  <span class="badge-status badge-inactive">Archived</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $bom->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalBOM"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-delete-id="{{ $bom->id }}"
                    data-delete-label="BOM-{{ $bom->id }}"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    title="Delete"><i class="bi bi-trash"></i></button>
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


  <div class="modal fade" id="modalBOM" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Bill of Materials</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-bom">
          <div class="modal-body">
            <input type="hidden" name="id" id="bom-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Finished Product</label>
                <input class="erp-form-control" type="text" name="finished_product_name" id="finished_product_name" placeholder="Product name" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Version</label>
                <input class="erp-form-control" type="text" name="version" id="bom-version" placeholder="v1.0" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Lead Time (days)</label>
                <input class="erp-form-control" type="number" name="lead_time_days" id="lead_time_days" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="bom-status">
                  <option value="Draft">Draft</option>
                  <option value="Active">Active</option>
                  <option value="Archived">Archived</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Save BOM
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
  const modalBOM = document.getElementById('modalBOM');
  const formBOM = document.getElementById('form-bom');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalBOM.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formBOM);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Bill of Materials';

      apiClient.show(API_ENDPOINTS.PRODUCTION.BOM.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('bom-id').value = item.id;
          formBOM.querySelector('[name="finished_product_name"]').value = item.finished_product_name || '';
          formBOM.querySelector('[name="version"]').value = item.version || 'v1.0';
          formBOM.querySelector('[name="lead_time_days"]').value = item.lead_time_days || '';
          formBOM.querySelector('[name="status"]').value = item.status || 'Draft';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Bill of Materials';
      formBOM.reset();
      document.getElementById('bom-id').value = '';
    }
  });

  formBOM.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('bom-id').value;

    const formData = new FormData(formBOM);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PRODUCTION.BOM.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PRODUCTION.BOM.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalBOM).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formBOM, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PRODUCTION.BOM.DESTROY, deleteId)
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
