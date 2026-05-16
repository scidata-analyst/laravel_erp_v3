@extends('layouts.erp')

@section('title', 'AP / AR')
@section('breadcrumb', 'Accounting / AP / AR')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Accounts Payable / Receivable</div>
      <div class="page-subtitle">Manage AP and AR balances</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalAPAR" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Transaction</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main"
          placeholder="Search accounts payable / receivable…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Payable</option>
        <option>Receivable</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Ref #</th>
            <th>Party</th>
            <th>Type</th>
            <th>Due Date</th>
            <th>Amount</th>
            <th>Paid</th>
            <th>Balance</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $apar)
            <tr data-id="{{ $apar->id }}">
              <td>{{ $apar->reference ?? 'N/A' }}</td>
              <td>{{ $apar->party_name }}</td>
              <td>
                @if ($apar->ap_ar_type == 'Payable')
                  <span class="badge-status badge-purple">Payable</span>
                @else
                  <span class="badge-status badge-blue">Receivable</span>
                @endif
              </td>
              <td>{{ $apar->due_date ? \Carbon\Carbon::parse($apar->due_date)->format('Y-m-d') : 'N/A' }}</td>
              <td>${{ number_format($apar->amount, 2) }}</td>
              <td>$0</td>
              <td>${{ number_format($apar->amount, 2) }}</td>
              <td>
                @if ($apar->status == 'Paid')
                  <span class="badge-status badge-active">Paid</span>
                @elseif ($apar->status == 'Pending')
                  <span class="badge-status badge-pending">Pending</span>
                @else
                  <span class="badge-status badge-inactive">Overdue</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalAPAR" data-mode="edit" data-id="{{ $apar->id }}" title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Transaction" data-delete-id="{{ $apar->id }}" data-delete-url="{{ route('ap_ar.destroy', $apar->id) }}" title="Delete"><i class="bi bi-trash"></i></button>
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

  <div class="modal fade" id="modalAPAR" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New AP/AR Transaction</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formAPAR" data-route-store="{{ route('ap_ar.store') }}">
          <div class="modal-body">
            <input type="hidden" name="id" id="apar_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Party Name</label>
                <input class="erp-form-control" type="text" name="party_name" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Type</label>
                <select class="erp-form-control" name="ap_ar_type">
                  <option value="Payable">Payable</option>
                  <option value="Receivable">Receivable</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Amount ($)</label>
                <input class="erp-form-control" type="number" name="amount" placeholder="" step="0.01" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Due Date</label>
                <input class="erp-form-control" type="date" name="due_date" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Reference</label>
                <input class="erp-form-control" type="text" name="reference" placeholder="Invoice/PO ref" />
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save
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
  const modalAPAR = document.getElementById('modalAPAR');
  const formAPAR = document.getElementById('formAPAR');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteUrl = null;

  modalAPAR.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalAPAR.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit AP/AR Transaction';
      formAPAR.dataset.routeUpdate = '{{ route("ap_ar.update", ":id") }}'.replace(':id', id);
      fetch('{{ route("ap_ar.show", ":id") }}'.replace(':id', id))
        .then(r => r.json())
        .then(data => {
          document.getElementById('apar_id').value = data.id;
          formAPAR.querySelector('[name="party_name"]').value = data.party_name || '';
          formAPAR.querySelector('[name="ap_ar_type"]').value = data.ap_ar_type || 'Payable';
          formAPAR.querySelector('[name="amount"]').value = data.amount || '';
          formAPAR.querySelector('[name="due_date"]').value = data.due_date || '';
          formAPAR.querySelector('[name="reference"]').value = data.reference || '';
        });
    } else {
      modalTitle.textContent = 'New AP/AR Transaction';
      formAPAR.reset();
      document.getElementById('apar_id').value = '';
      formAPAR.dataset.routeUpdate = '';
    }
  });

  formAPAR.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('apar_id').value;
    const url = id ? formAPAR.dataset.routeUpdate : formAPAR.dataset.routeStore;
    const method = id ? 'PUT' : 'POST';

    const formData = new FormData(formAPAR);
    if (id) formData.append('_method', 'PUT');

    fetch(url, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        bootstrap.Modal.getInstance(modalAPAR).hide();
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