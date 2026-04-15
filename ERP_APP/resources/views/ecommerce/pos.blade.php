@extends('layouts.erp')

@section('title', 'POS Terminals')
@section('breadcrumb', 'POS Terminals')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">POS Terminals</div>
      <div class="page-subtitle">Point-of-sale terminal management and session tracking</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPOS" data-mode="create" data-route="{{ route('pos.store') }}"><i
          class="bi bi-plus-lg"></i> Add Terminal</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search pos terminals…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Online</option>
        <option>Offline</option>
        <option>Closed</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Terminal ID</th>
            <th>Location</th>
            <th>Cashier</th>
            <th>Session Start</th>
            <th>Sales (Today)</th>
            <th>Transactions</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $pos)
            <tr>
              <td>{{ $pos->terminal_id }}</td>
              <td>{{ $pos->location ?? 'N/A' }}</td>
              <td>{{ $pos->assigned_cashier_id ?? '—' }}</td>
              <td>{{ $pos->created_at ? \Carbon\Carbon::parse($pos->created_at)->format('Y-m-d H:i') : '—' }}</td>
              <td>$0</td>
              <td>0 txns</td>
              <td>
                @if ($pos->status == 'Online' || $pos->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($pos->status == 'Offline')
                  <span class="badge-status badge-inactive">Offline</span>
                @else
                  <span class="badge-status badge-pending">{{ $pos->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalPOS" data-mode="edit" data-route="{{ route('pos.update', $pos->id) }}" data-pos='{{ json_encode($pos) }}' title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-route="{{ route('pos.destroy', $pos->id) }}" data-label="Terminal" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalPOS" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add POS Terminal</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-pos" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6"><label class="erp-form-label">Terminal ID</label><input class="erp-form-control"
                  type="text" name="terminal_id" placeholder="POS-XXX" /></div>
              <div class="col-md-6"><label class="erp-form-label">Location</label><input class="erp-form-control"
                  type="text" name="location" placeholder="" /></div>
              <div class="col-md-6"><label class="erp-form-label">Assigned Cashier</label><select
                  class="erp-form-control" name="assigned_cashier_id">
                  <option value="">Select Cashier</option>
                  <option value="Anika R.">Anika R.</option>
                  <option value="Farhan S.">Farhan S.</option>
                  <option value="Tania M.">Tania M.</option>
                </select></div>
              <div class="col-md-6"><label class="erp-form-label">Warehouse / Inventory</label><select
                  class="erp-form-control" name="warehouse_id">
                  <option value="">Select Warehouse</option>
                  <option value="WH-A">WH-A</option>
                  <option value="WH-B">WH-B</option>
                </select></div>
              <div class="col-md-6"><label class="erp-form-label">Receipt Printer</label><input class="erp-form-control"
                  type="text" name="printer_ip" placeholder="Printer IP or model" /></div>
              <div class="col-md-6"><label class="erp-form-label">Status</label><select
                  class="erp-form-control" name="status">
                  <option value="Active">Active</option>
                  <option value="Offline">Offline</option>
                </select></div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Terminal
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
    const modalPOS = document.getElementById('modalPOS');
    const modalDelete = document.getElementById('modalDelete');
    const formPOS = document.getElementById('form-pos');
    let deleteUrl = null;

    modalPOS.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      const mode = btn?.dataset.mode || 'create';
      const route = btn?.dataset.route || '{{ route("pos.store") }}';
      
      formPOS.action = route;
      formPOS.method = mode === 'create' ? 'POST' : 'PUT';
      
      const title = modalPOS.querySelector('.modal-title');
      const submitBtn = modalPOS.querySelector('.btn-modal-save');
      
      if (mode === 'edit') {
        title.textContent = 'Edit POS Terminal';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update Terminal';
        
        const pos = JSON.parse(btn.dataset.pos);
        formPOS.querySelector('[name="terminal_id"]').value = pos.terminal_id || '';
        formPOS.querySelector('[name="location"]').value = pos.location || '';
        formPOS.querySelector('[name="assigned_cashier_id"]').value = pos.assigned_cashier_id || '';
        formPOS.querySelector('[name="warehouse_id"]').value = pos.warehouse_id || '';
        formPOS.querySelector('[name="printer_ip"]').value = pos.printer_ip || '';
        formPOS.querySelector('[name="status"]').value = pos.status || 'Active';
      } else {
        title.textContent = 'Add POS Terminal';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Terminal';
        formPOS.reset();
      }
    });

    formPOS.addEventListener('submit', async function(e) {
      e.preventDefault();
      const submitBtn = formPOS.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

      try {
        const formData = new FormData(formPOS);
        const method = formPOS.method;
        const url = formPOS.action;

        const response = await fetch(url, {
          method: method,
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: method === 'PUT' ? new URLSearchParams(formData) : formData
        });

        const result = await response.json();

        if (result.success) {
          bootstrap.Modal.getInstance(modalPOS)?.hide();
          showToast(result.message || 'Terminal saved successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to save terminal', 'error');
        }
      } catch (error) {
        showToast('An error occurred while saving', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Terminal';
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