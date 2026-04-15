@extends('layouts.erp')

@section('title', 'Tax & Compliance')
@section('breadcrumb', 'Accounting / Tax & Compliance')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Tax & Compliance</div>
      <div class="page-subtitle">Configure tax rules, filing periods and compliance tracking</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalTax" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Tax Rule</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search tax & compliance…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>VAT</option>
        <option>Sales Tax</option>
        <option>Withholding</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Tax Name</th>
            <th>Type</th>
            <th>Rate</th>
            <th>Applicable On</th>
            <th>Filing Period</th>
            <th>Last Filed</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $tax)
            <tr data-id="{{ $tax->id }}">
              <td>{{ $tax->tax_name }}</td>
              <td>{{ $tax->tax_type }}</td>
              <td>{{ $tax->rate }}%</td>
              <td>{{ $tax->applicable_on ?? 'All Sales' }}</td>
              <td>{{ $tax->filing_period ?? 'Monthly' }}</td>
              <td>—</td>
              <td>
                @if ($tax->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalTax" data-mode="edit" data-id="{{ $tax->id }}" title="Edit"><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Tax Rule" data-delete-id="{{ $tax->id }}" data-delete-url="{{ route('tax.destroy', $tax->id) }}" title="Delete"><i class="bi bi-trash"></i></button>
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

  <div class="modal fade" id="modalTax" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Tax Rule</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="formTax" data-route-store="{{ route('tax.store') }}">
          <div class="modal-body">
            <input type="hidden" name="id" id="tax_id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Tax Name</label>
                <input class="erp-form-control" type="text" name="tax_name" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Tax Type</label>
                <select class="erp-form-control" name="tax_type">
                  <option value="VAT">VAT</option>
                  <option value="Sales Tax">Sales Tax</option>
                  <option value="Withholding">Withholding</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Rate (%)</label>
                <input class="erp-form-control" type="number" name="rate" placeholder="" step="0.01" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Filing Period</label>
                <select class="erp-form-control" name="filing_period">
                  <option value="Monthly">Monthly</option>
                  <option value="Quarterly">Quarterly</option>
                  <option value="Annually">Annually</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Applicable On</label>
                <select class="erp-form-control" name="applicable_on">
                  <option value="Sales">Sales</option>
                  <option value="Purchases">Purchases</option>
                  <option value="Both">Both</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Tax Rule
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
  const modalTax = document.getElementById('modalTax');
  const formTax = document.getElementById('formTax');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteUrl = null;

  modalTax.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = modalTax.querySelector('.modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Tax Rule';
      formTax.dataset.routeUpdate = '{{ route("tax.update", ":id") }}'.replace(':id', id);
      fetch('{{ route("tax.show", ":id") }}'.replace(':id', id))
        .then(r => r.json())
        .then(data => {
          document.getElementById('tax_id').value = data.id;
          formTax.querySelector('[name="tax_name"]').value = data.tax_name || '';
          formTax.querySelector('[name="tax_type"]').value = data.tax_type || 'VAT';
          formTax.querySelector('[name="rate"]').value = data.rate || '';
          formTax.querySelector('[name="filing_period"]').value = data.filing_period || 'Monthly';
          formTax.querySelector('[name="applicable_on"]').value = data.applicable_on || 'Sales';
        });
    } else {
      modalTitle.textContent = 'New Tax Rule';
      formTax.reset();
      document.getElementById('tax_id').value = '';
      formTax.dataset.routeUpdate = '';
    }
  });

  formTax.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('tax_id').value;
    const url = id ? formTax.dataset.routeUpdate : formTax.dataset.routeStore;
    const method = id ? 'PUT' : 'POST';

    const formData = new FormData(formTax);
    if (id) formData.append('_method', 'PUT');

    fetch(url, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: formData
    })
    .then(r => r.json())
    .then(data => {
      if (data.success) {
        bootstrap.Modal.getInstance(modalTax).hide();
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