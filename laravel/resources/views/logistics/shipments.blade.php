@extends('layouts.erp')

@section('title', 'Shipments')
@section('breadcrumb', 'Shipments')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Shipments</div>
      <div class="page-subtitle">Track outbound shipments and delivery status</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalShipment" data-mode="create"><i class="bi bi-plus-lg"></i> New Shipment</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search shipments…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Preparing</option>
        <option>Dispatched</option>
        <option>In Transit</option>
        <option>Delivered</option>
        <option>Failed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Shipment #</th>
            <th>Sales Order</th>
            <th>Customer</th>
            <th>Carrier</th>
            <th>Tracking #</th>
            <th>Est. Delivery</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($data as $shipment)
            <tr>
              <td>SHP-{{ $shipment->id }}</td>
              <td>{{ $shipment->sales_order_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $shipment->carrier ?? 'N/A' }}</td>
              <td>{{ $shipment->tracking_number ?? 'N/A' }}</td>
              <td>{{ $shipment->estimated_delivery_date ? \Carbon\Carbon::parse($shipment->estimated_delivery_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>
                @if ($shipment->status == 'Delivered')
                  <span class="badge-status badge-active">Delivered</span>
                @elseif ($shipment->status == 'In Transit')
                  <span class="badge-status badge-info">In Transit</span>
                @elseif ($shipment->status == 'Dispatched')
                  <span class="badge-status badge-info">Dispatched</span>
                @else
                  <span class="badge-status badge-pending">{{ $shipment->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                    data-id="{{ $shipment->id }}"
                    data-mode="edit"
                    data-bs-toggle="modal" data-bs-target="#modalShipment"
                    title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                    data-delete-id="{{ $shipment->id }}"
                    data-delete-label="SHP-{{ $shipment->id }}"
                    data-bs-toggle="modal" data-bs-target="#modalDelete"
                    title="Delete"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted">No shipments found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-5">
      <div>
        Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
      </div>
      <div>
        {{ $data->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalShipment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Shipment</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-shipment">
          <div class="modal-body">
            <input type="hidden" name="id" id="shipment-id" value="" />
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Sales Order</label>
                <input class="erp-form-control" type="text" name="sales_order_id" id="sales-order-id" placeholder="SO-XXXX-XXXX" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Carrier</label>
                <select class="erp-form-control" name="carrier" id="carrier">
                  <option value="DHL">DHL</option>
                  <option value="FedEx">FedEx</option>
                  <option value="UPS">UPS</option>
                  <option value="Local Courier">Local Courier</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Tracking Number</label>
                <input class="erp-form-control" type="text" name="tracking_number" id="tracking-number" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Est. Delivery Date</label>
                <input class="erp-form-control" type="date" name="estimated_delivery_date" id="estimated-delivery-date" placeholder="" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Shipping Address</label>
                <textarea class="erp-form-control" name="shipping_address" id="shipping-address" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-shipping_address"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="status">
                  <option value="Preparing">Preparing</option>
                  <option value="Dispatched">Dispatched</option>
                  <option value="In Transit">In Transit</option>
                  <option value="Delivered">Delivered</option>
                  <option value="Failed">Failed</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary" id="btn-save">
              <i class="bi bi-check2"></i> Create Shipment
            </button>
          </div>
        </form>
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
  const modalShipment = document.getElementById('modalShipment');
  const formShipment = document.getElementById('form-shipment');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalShipment.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formShipment);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Shipment';

      apiClient.show(API_ENDPOINTS.LOGISTICS.SHIPMENTS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('shipment-id').value = item.id;
          formShipment.querySelector('[name="sales_order_id"]').value = item.sales_order_id || '';
          formShipment.querySelector('[name="carrier"]').value = item.carrier || 'DHL';
          formShipment.querySelector('[name="tracking_number"]').value = item.tracking_number || '';
          formShipment.querySelector('[name="estimated_delivery_date"]').value = item.estimated_delivery_date || '';
          formShipment.querySelector('[name="shipping_address"]').value = item.shipping_address || '';
          formShipment.querySelector('[name="status"]').value = item.status || 'Preparing';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Shipment';
      formShipment.reset();
      document.getElementById('shipment-id').value = '';
    }
  });

  formShipment.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('shipment-id').value;

    const formData = new FormData(formShipment);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.LOGISTICS.SHIPMENTS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.LOGISTICS.SHIPMENTS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalShipment).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formShipment, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.LOGISTICS.SHIPMENTS.DESTROY, deleteId)
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