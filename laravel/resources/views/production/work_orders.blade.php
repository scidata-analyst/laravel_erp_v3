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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWorkOrder" data-mode="create"><i class="bi bi-plus-lg"></i> New Work Order</button>
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
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $workOrder->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalWorkOrder"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-delete-id="{{ $workOrder->id }}"
                    data-delete-label="WO-{{ $workOrder->id }}"
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


  <div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Work Order</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-work-order">
          <div class="modal-body">
            <input type="hidden" name="id" id="work-order-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product / BOM</label>
                <input class="erp-form-control" type="number" name="bom_id" id="bom-id" placeholder="BOM ID" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Qty to Produce</label>
                <input class="erp-form-control" type="number" name="quantity_to_produce" id="quantity-to-produce" placeholder="" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Priority</label>
                <select class="erp-form-control" name="priority" id="priority">
                  <option value="Normal">Normal</option>
                  <option value="High">High</option>
                  <option value="Urgent">Urgent</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Start Date</label>
                <input class="erp-form-control" type="date" name="start_date" id="start-date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">End Date</label>
                <input class="erp-form-control" type="date" name="end_date" id="end-date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Workshop / Line</label>
                <select class="erp-form-control" name="workshop_line" id="workshop-line">
                  <option value="Workshop A">Workshop A</option>
                  <option value="Workshop B">Workshop B</option>
                  <option value="Workshop C">Workshop C</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="work-order-status">
                  <option value="Scheduled">Scheduled</option>
                  <option value="In Progress">In Progress</option>
                  <option value="Completed">Completed</option>
                  <option value="On Hold">On Hold</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Create Work Order
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
  const modalWorkOrder = document.getElementById('modalWorkOrder');
  const formWorkOrder = document.getElementById('form-work-order');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalWorkOrder.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formWorkOrder);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Work Order';

      apiClient.show(API_ENDPOINTS.PRODUCTION.WORK_ORDERS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('work-order-id').value = item.id;
          formWorkOrder.querySelector('[name="bom_id"]').value = item.bom_id || '';
          formWorkOrder.querySelector('[name="quantity_to_produce"]').value = item.quantity_to_produce || '';
          formWorkOrder.querySelector('[name="priority"]').value = item.priority || 'Normal';
          formWorkOrder.querySelector('[name="start_date"]').value = item.start_date ? item.start_date.split('T')[0] : '';
          formWorkOrder.querySelector('[name="end_date"]').value = item.end_date ? item.end_date.split('T')[0] : '';
          formWorkOrder.querySelector('[name="workshop_line"]').value = item.workshop_line || 'Workshop A';
          formWorkOrder.querySelector('[name="status"]').value = item.status || 'Scheduled';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Work Order';
      formWorkOrder.reset();
      document.getElementById('work-order-id').value = '';
    }
  });

  formWorkOrder.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('work-order-id').value;

    const formData = new FormData(formWorkOrder);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PRODUCTION.WORK_ORDERS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PRODUCTION.WORK_ORDERS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalWorkOrder).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formWorkOrder, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.PRODUCTION.WORK_ORDERS.DESTROY, deleteId)
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
