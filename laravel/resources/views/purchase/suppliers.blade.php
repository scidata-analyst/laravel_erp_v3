@extends('layouts.erp')

@section('title', 'Supplier Management')
@section('breadcrumb', 'Supplier Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Management</div>
    <div class="page-subtitle">Manage supplier info, contacts and ratings</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplier" data-mode="create"><i class="bi bi-plus-lg"></i> Add Supplier</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Supplier</th><th>Contact</th><th>Email</th><th>Country</th><th>Payment Terms</th><th>Rating</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $supplier)
          <tr>
            <td>{{ $supplier->company_name }}</td>
            <td>{{ $supplier->contact_person }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->country }}</td>
            <td>{{ $supplier->payment_terms }}</td>
            <td>⭐⭐⭐⭐</td>
            <td>
              @if ($supplier->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @else
                <span class="badge-status badge-inactive">Inactive</span>
              @endif
            </td>
            <td>
              <div class="d-flex gap-1">
                <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $supplier->id }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalSupplier" title="Edit"><i class="bi bi-pencil"></i></button>
                <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $supplier->id }}" data-delete-label="{{ $supplier->company_name }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No suppliers found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalSupplier" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Supplier</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-supplier">
        <div class="modal-body">
          <input type="hidden" name="id" id="supplier-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Company Name</label>
              <input class="erp-form-control" type="text" name="company_name" id="company-name" placeholder="Supplier Ltd." required />
              <div class="invalid-feedback" id="error-company_name"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Contact Person</label>
              <input class="erp-form-control" type="text" name="contact_person" id="contact-person" placeholder="Contact name" />
              <div class="invalid-feedback" id="error-contact_person"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Email</label>
              <input class="erp-form-control" type="email" name="email" id="email" placeholder="contact@supplier.com" required />
              <div class="invalid-feedback" id="error-email"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Contact Person</label>
              <input class="erp-form-control" type="text" name="contact_person" id="contact-person" placeholder="Contact name" required />
              <div class="invalid-feedback" id="error-contact_person"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Phone</label>
              <input class="erp-form-control" type="text" name="phone" id="phone" placeholder="+1-555-0000" required />
              <div class="invalid-feedback" id="error-phone"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Country</label>
              <input class="erp-form-control" type="text" name="country" id="country" placeholder="USA" required />
              <div class="invalid-feedback" id="error-country"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Net 90">Net 90</option>
                <option value="Prepaid">Prepaid</option>
              </select>
              <div class="invalid-feedback" id="error-payment_terms"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Currency</label>
              <select class="erp-form-control" name="currency" id="currency">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="BDT">BDT</option>
              </select>
              <div class="invalid-feedback" id="error-currency"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Address</label>
              <textarea class="erp-form-control" name="address" id="address" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-address"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Status</label>
              <select class="erp-form-control" name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <div class="invalid-feedback" id="error-status"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Country</label>
              <input class="erp-form-control" type="text" name="country" id="country" placeholder="USA" required />
              <div class="invalid-feedback" id="error-country"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Net 90">Net 90</option>
                <option value="Prepaid">Prepaid</option>
              </select>
              <div class="invalid-feedback" id="error-payment_terms"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Currency</label>
              <select class="erp-form-control" name="currency" id="currency">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="BDT">BDT</option>
              </select>
              <div class="invalid-feedback" id="error-currency"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Address</label>
              <textarea class="erp-form-control" name="address" id="address" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-address"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Status</label>
              <select class="erp-form-control" name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
              <div class="invalid-feedback" id="error-status"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Country</label>
              <input class="erp-form-control" type="text" name="country" id="country" placeholder="USA" />
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Net 90">Net 90</option>
                <option value="Prepaid">Prepaid</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Currency</label>
              <select class="erp-form-control" name="currency" id="currency">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
                <option value="GBP">GBP</option>
                <option value="BDT">BDT</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Address</label>
              <textarea class="erp-form-control" name="address" id="address" rows="2" placeholder=""></textarea>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Status</label>
              <select class="erp-form-control" name="status" id="status">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Supplier
          </button>
        </div>
      </form>
    </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const modalSupplier = document.getElementById('modalSupplier');
  const formSupplier = document.getElementById('form-supplier');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalSupplier.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formSupplier);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Supplier';

      apiClient.show(API_ENDPOINTS.PURCHASE.SUPPLIERS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('supplier-id').value = item.id;
          formSupplier.querySelector('[name="company_name"]').value = item.company_name || '';
          formSupplier.querySelector('[name="contact_person"]').value = item.contact_person || '';
          formSupplier.querySelector('[name="email"]').value = item.email || '';
          formSupplier.querySelector('[name="phone"]').value = item.phone || '';
          formSupplier.querySelector('[name="country"]').value = item.country || '';
          formSupplier.querySelector('[name="payment_terms"]').value = item.payment_terms || 'Net 30';
          formSupplier.querySelector('[name="currency"]').value = item.currency || 'USD';
          formSupplier.querySelector('[name="address"]').value = item.address || '';
          formSupplier.querySelector('[name="status"]').value = item.status || 'Active';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Supplier';
      formSupplier.reset();
      document.getElementById('supplier-id').value = '';
    }
  });

  formSupplier.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('supplier-id').value;

    const formData = new FormData(formSupplier);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.PURCHASE.SUPPLIERS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.PURCHASE.SUPPLIERS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalSupplier).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formSupplier, error.errors);
      } else {
        showToast(error.message || 'An error occurred', 'error');
      }
    });
  });

  modalDelete.addEventListener('show.bs.modal', function(e) {
    const button = e.relatedTarget;
    deleteId = button.dataset.deleteId;
    document.getElementById('delete-target').textContent = button.dataset.deleteLabel || 'this supplier';
  });

  btnConfirmDelete.addEventListener('click', function() {
    if (!deleteId) return;

    apiClient.destroy(API_ENDPOINTS.PURCHASE.SUPPLIERS.DESTROY, deleteId)
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
@endpush
@endsection