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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalShipment"><i
          class="bi bi-plus-lg"></i> New Shipment</button>
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
          @foreach ($data as $shipment)
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
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalShipment" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Shipment" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalShipment" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Shipment</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Sales Order</label><select class="erp-form-control">
                <option>SO-2025-0441</option>
                <option>SO-2025-0440</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Carrier</label><select class="erp-form-control">
                <option>DHL</option>
                <option>FedEx</option>
                <option>UPS</option>
                <option>Local Courier</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Tracking Number</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Est. Delivery Date</label><input
                class="erp-form-control" type="date" placeholder="" /></div>
            <div class="col-md-12"><label class="erp-form-label">Shipping Address</label><textarea
                class="erp-form-control" rows="2" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Create Shipment
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
