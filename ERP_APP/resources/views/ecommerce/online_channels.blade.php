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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalChannel"><i
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
                    data-bs-target="#modalChannel" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Channel" title="Delete"><i class="bi bi-trash"></i></button></div>
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
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Channel Name</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Platform</label><select class="erp-form-control">
                <option>Shopify</option>
                <option>WooCommerce</option>
                <option>Daraz</option>
                <option>Facebook Shop</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">API / Store URL</label><input class="erp-form-control"
                type="text" placeholder="https://yourstore.myshopify.com" /></div>
            <div class="col-md-6"><label class="erp-form-label">API Key</label><input class="erp-form-control"
                type="password" placeholder="••••••••••••" /></div>
            <div class="col-md-6"><label class="erp-form-label">Sync Frequency</label><select class="erp-form-control">
                <option>Every 15 min</option>
                <option>Every hour</option>
                <option>Daily</option>
              </select></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Connect Channel
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