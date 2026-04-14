@extends('layouts.erp')

@section('title', 'Inventory Sync')
@section('breadcrumb', 'Inventory Sync')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Inventory Sync</div>
    <div class="page-subtitle">Monitor real-time inventory synchronization across all channels</div>
  </div>
  <button class="btn-erp btn-primary btn-force-sync"><i class="bi bi-arrow-repeat"></i> Force Sync</button>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input"><span class="si"><i class="bi bi-search"></i></span><input class="tbl-search" data-table="#tbl-invsync" type="text" placeholder="Search products…" /></div>
    <select class="erp-form-control" style="width:130px">
      <option>All Channels</option>
      <option>Synced</option>
      <option>Out of Sync</option>
      <option>Error</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-invsync">
      <thead>
        <tr>
          <th>Product</th>
          <th>SKU</th>
          <th>ERP Stock</th>
          <th>Shopify</th>
          <th>Daraz</th>
          <th>POS</th>
          <th>Last Sync</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $sync)
        <tr>
          <td>{{ $sync->channel_id }}</td>
          <td>{{ $sync->channel_id }}</td>
          <td>{{ $sync->total_synced_items }}</td>
          <td>{{ $sync->total_synced_items - $sync->sync_errors }}</td>
          <td>{{ $sync->sync_errors }}</td>
          <td>{{ $sync->total_synced_items }}</td>
          <td style="{{ $sync->sync_errors > 0 ? 'color:var(--accent-4)' : '' }}">{{ \Carbon\Carbon::parse($sync->last_sync_time)->format('Y-m-d H:i') }}{{ $sync->sync_errors > 0 ? ' ⚠' : '' }}</td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted">No inventory sync records found.</td></tr>
        @endforelse
      </tbody>
    </table>
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