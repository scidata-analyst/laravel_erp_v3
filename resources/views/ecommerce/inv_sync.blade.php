@extends('layouts.erp')

@section('title', 'Inventory Sync')
@section('breadcrumb', 'Inventory Sync')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Inventory Sync</div>
    <div class="page-subtitle">Monitor real-time inventory synchronization across all channels</div>
  </div>
  <button class="btn-erp btn-primary btn-force-sync" data-route="{{ route('inv_sync.forceSync') }}"><i class="bi bi-arrow-repeat"></i> Force Sync</button>
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
          <th>Actions</th>
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
            <td>
              <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                data-route="{{ route('inv_sync.destroy', $sync->id) }}" data-label="Sync Record" title="Delete"><i class="bi bi-trash"></i></button>
            </td>
          </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No inventory sync records found.</td></tr>
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

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalDelete = document.getElementById('modalDelete');
    let deleteUrl = null;

    document.querySelector('.btn-force-sync').addEventListener('click', async function() {
      const btn = this;
      btn.disabled = true;
      btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Syncing...';

      try {
        const response = await fetch(btn.dataset.route, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        });

        const result = await response.json();

        if (result.success) {
          showToast(result.message || 'Sync started successfully', 'success');
          setTimeout(() => window.location.reload(), 1500);
        } else {
          showToast(result.message || 'Failed to start sync', 'error');
        }
      } catch (error) {
        showToast('An error occurred while syncing', 'error');
      } finally {
        btn.disabled = false;
        btn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Force Sync';
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