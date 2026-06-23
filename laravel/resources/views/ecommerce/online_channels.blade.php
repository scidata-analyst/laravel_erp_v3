@extends('layouts.erp')

@section('title', 'Online Sales Channels')
@section('breadcrumb', 'Online Sales Channels')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Online Sales Channels</div>
      <div class="page-subtitle">Manage e-commerce platform integrations and online sales</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalChannel" data-mode="create"><i
          class="bi bi-plus-lg"></i> Add Channel</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search online sales channels…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Shopify</option>
        <option>WooCommerce</option>
        <option>Daraz</option>
        <option>Facebook</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Channel Name</th>
            <th>Platform</th>
            <th>Orders (MTD)</th>
            <th>Revenue (MTD)</th>
            <th>Sync Status</th>
            <th>Last Synced</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $channel)
            <tr>
              <td>{{ $channel->channel_name }}</td>
              <td>{{ $channel->platform }}</td>
              <td>0</td>
              <td>$0</td>
              <td>
                @if ($channel->status == 'Active')
                  Synced
                @else
                  Pending
                @endif
              </td>
              <td>{{ $channel->updated_at ? \Carbon\Carbon::parse($channel->updated_at)->format('Y-m-d H:i') : 'N/A' }}</td>
              <td>
                @if ($channel->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalChannel" data-mode="edit" data-id="{{ $channel->id }}" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-id="{{ $channel->id }}" data-delete-label="Channel" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalChannel" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Sales Channel</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-channel">
          <div class="modal-body">
            <input type="hidden" name="id" id="channel_id">
            <div class="row g-3">
              <div class="col-md-6"><label class="erp-form-label">Channel Name</label><input class="erp-form-control"
                  type="text" name="channel_name" placeholder="" /></div>
              <div class="col-md-6"><label class="erp-form-label">Platform</label><select class="erp-form-control" name="platform">
                  <option value="">Select Platform</option>
                  <option value="Shopify">Shopify</option>
                  <option value="WooCommerce">WooCommerce</option>
                  <option value="Daraz">Daraz</option>
                  <option value="Facebook Shop">Facebook Shop</option>
                </select></div>
              <div class="col-md-12"><label class="erp-form-label">API / Store URL</label><input class="erp-form-control"
                  type="text" name="api_url" placeholder="https://yourstore.myshopify.com" /></div>
              <div class="col-md-6"><label class="erp-form-label">API Key</label><input class="erp-form-control"
                  type="password" name="api_key" placeholder="••••••••••••" /></div>
              <div class="col-md-6"><label class="erp-form-label">Sync Frequency</label><select class="erp-form-control" name="sync_frequency">
                  <option value="15">Every 15 min</option>
                  <option value="60">Every hour</option>
                  <option value="1440">Daily</option>
                </select></div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Connect Channel
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
  const modalChannel = document.getElementById('modalChannel');
  const formChannel = document.getElementById('form-channel');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalChannel.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formChannel);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalChannel.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Sales Channel';

      apiClient.show(API_ENDPOINTS.ECOMMERCE.ONLINE_CHANNELS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('channel_id').value = item.id;
          formChannel.querySelector('[name="channel_name"]').value = item.channel_name || '';
          formChannel.querySelector('[name="platform"]').value = item.platform || '';
          formChannel.querySelector('[name="api_url"]').value = item.api_url || '';
          formChannel.querySelector('[name="api_key"]').value = '';
          formChannel.querySelector('[name="sync_frequency"]').value = item.sync_frequency || '15';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Sales Channel';
      formChannel.reset();
      document.getElementById('channel_id').value = '';
    }
  });

  formChannel.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('channel_id').value;

    const formData = new FormData(formChannel);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.ECOMMERCE.ONLINE_CHANNELS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.ECOMMERCE.ONLINE_CHANNELS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalChannel).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formChannel, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.ECOMMERCE.ONLINE_CHANNELS.DESTROY, deleteId)
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