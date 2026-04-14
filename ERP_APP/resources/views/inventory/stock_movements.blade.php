@extends('layouts.erp')

@section('title', 'Stock In / Out')
@section('breadcrumb', 'Inventory / Stock In / Out')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Stock In / Out</div>
      <div class="page-subtitle">Warehouse-wise stock movement log</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalStockMove"><i
          class="bi bi-plus-lg"></i> New Movement</button>
    </div>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-4">
      <div class="kpi-tile green">
        <div class="kpi-icon green"><i class="bi bi-box-arrow-in-down"></i></div>
        <div class="kpi-value">+4,820</div>
        <div class="kpi-label">Stock In (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile red">
        <div class="kpi-icon red"><i class="bi bi-box-arrow-up-right"></i></div>
        <div class="kpi-value">-3,142</div>
        <div class="kpi-label">Stock Out (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-boxes"></i></div>
        <div class="kpi-value">14,230</div>
        <div class="kpi-label">Net Current Stock</div>
      </div>
    </div>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search stock in / out…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Stock In</option>
        <option>Stock Out</option>
        <option>Transfer</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Ref #</th>
            <th>Date</th>
            <th>Product</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Warehouse</th>
            <th>Reason</th>
            <th>User</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $movement)
            <tr>
              <td>MV-{{ $movement->id }}</td>
              <td>{{ $movement->created_at ? \Carbon\Carbon::parse($movement->created_at)->format('Y-m-d') : 'N/A' }}</td>
              <td>{{ $movement->product_id ?? 'N/A' }}</td>
              <td>
                @if ($movement->movement_type == 'Stock In')
                  <span class="badge-status badge-info">Stock In</span>
                @elseif ($movement->movement_type == 'Stock Out')
                  <span class="badge-status badge-info">Stock Out</span>
                @else
                  <span class="badge-status badge-info">{{ $movement->movement_type }}</span>
                @endif
              </td>
              <td>{{ $movement->quantity }}</td>
              <td>{{ $movement->from_warehouse_id ?? 'N/A' }} → {{ $movement->to_warehouse_id ?? 'N/A' }}</td>
              <td>{{ $movement->reason ?? 'N/A' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalStockMove" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Movement" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalStockMove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Stock Movement</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control">
                <option>HP ProBook 450</option>
                <option>Office Chair Pro</option>
              </select></div>
            <div class="col-md-6"><label class="erp-form-label">Movement Type</label><select class="erp-form-control">
                <option>Stock In</option>
                <option>Stock Out</option>
                <option>Transfer</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Quantity</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">From Warehouse</label><select class="erp-form-control">
                <option>WH-A</option>
                <option>WH-B</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">To Warehouse</label><select class="erp-form-control">
                <option>—</option>
                <option>WH-A</option>
                <option>WH-B</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Reason / Notes</label><textarea
                class="erp-form-control" rows="2" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Record Movement
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