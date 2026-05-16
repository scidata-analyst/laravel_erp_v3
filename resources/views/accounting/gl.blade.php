@extends('layouts.erp')

@section('title', 'General Ledger')
@section('breadcrumb', 'Accounting / General Ledger')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">General Ledger</div>
      <div class="page-subtitle">Chart of accounts and journal entries</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalGL" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Entry</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search general ledger…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Assets</option>
        <option>Liabilities</option>
        <option>Equity</option>
        <option>Revenue</option>
        <option>Expense</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Account Code</th>
            <th>Account Name</th>
            <th>Type</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $gl)
            <tr data-id="{{ $gl->id }}">
              <td>{{ $gl->code }}</td>
              <td>{{ $gl->name }}</td>
              <td><span class="badge-status badge-info">{{ $gl->type }}</span></td>
              <td>${{ number_format($gl->debit ?? 0, 2) }}</td>
              <td>${{ number_format($gl->credit ?? 0, 2) }}</td>
              <td>${{ number_format(($gl->credit ?? 0) - ($gl->debit ?? 0), 2) }}</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalGL" data-mode="edit" data-id="{{ $gl->id }}" title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Entry" data-delete-id="{{ $gl->id }}" data-delete-url="{{ route('gl.destroy', $gl->id) }}" title="Delete"><i class="bi bi-trash"></i></button>
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

  <div class="modal fade" id="modalGL" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Journal Entry</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formGL" data-route-store="{{ route('gl.store') }}">
          <div class="modal-body">
            <input type="hidden" name="id" id="gl_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Account Code</label>
                <input class="erp-form-control" type="text" name="code" placeholder="e.g. 1001" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Account Name</label>
                <input class="erp-form-control" type="text" name="name" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Account Type</label>
                <select class="erp-form-control" name="type">
                  <option value="Asset">Asset</option>
                  <option value="Liability">Liability</option>
                  <option value="Equity">Equity</option>
                  <option value="Revenue">Revenue</option>
                  <option value="Expense">Expense</option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Debit ($)</label>
                <input class="erp-form-control" type="number" name="debit" placeholder="" step="0.01" />
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Credit ($)</label>
                <input class="erp-form-control" type="number" name="credit" placeholder="" step="0.01" />
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Narration</label>
                <textarea class="erp-form-control" name="narration" rows="2" placeholder=""></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Post Entry
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Confirm Modal -->
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
  const modalGL = document.getElementById('modalGL');
  const formGL = document.getElementById('formGL');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteUrl = null;

  modalGL.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalGL.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Journal Entry';
      formGL.dataset.routeUpdate = '{{ route("gl.update", ":id") }}'.replace(':id', id);
      fetch('{{ route("gl.show", ":id") }}'.replace(':id', id))
        .then(r => r.json())
        .then(data => {
          document.getElementById('gl_id').value = data.id;
          formGL.querySelector('[name="code"]').value = data.code || '';
          formGL.querySelector('[name="name"]').value = data.name || '';
          formGL.querySelector('[name="type"]').value = data.type || 'Asset';
          formGL.querySelector('[name="debit"]').value = data.debit || '';
          formGL.querySelector('[name="credit"]').value = data.credit || '';
          formGL.querySelector('[name="narration"]').value = data.narration || '';
        });
    } else {
      modalTitle.textContent = 'New Journal Entry';
      formGL.reset();
      document.getElementById('gl_id').value = '';
      formGL.dataset.routeUpdate = '';
    }
  });

  formGL.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('gl_id').value;
    const url = id ? formGL.dataset.routeUpdate : formGL.dataset.routeStore;
    const method = id ? 'PUT' : 'POST';

    const formData = new FormData(formGL);
    if (id) formData.append('_method', 'PUT');

    fetch(url, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        bootstrap.Modal.getInstance(modalGL).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(() => showToast('An error occurred', 'error'));
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteUrl = button.dataset.deleteUrl;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'record';
  });

  btnConfirmDelete.addEventListener('click', function() {
    fetch(deleteUrl, {
      method: 'DELETE',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        bootstrap.Modal.getInstance(modalDelete).hide();
        showToast(data.message || 'Deleted successfully', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(() => showToast('An error occurred', 'error'));
  });
});
</script>
@endpush