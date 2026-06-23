@extends('layouts.erp')

@section('title', 'Customer Management')
@section('breadcrumb', 'Customer Management')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Customer Management</div>
    <div class="page-subtitle">Customer info, credit limits and receivables</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCustomer" data-mode="create"><i class="bi bi-plus-lg"></i> Add Customer</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer management…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Blocked</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Customer</th><th>Contact</th><th>Email</th><th>Credit Limit</th><th>Outstanding</th><th>Sales Rep</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $customer)
          <tr>
            <td>{{ $customer->company_name }}</td>
            <td>{{ $customer->contact_person }}</td>
            <td>{{ $customer->email }}</td>
            <td>${{ number_format($customer->credit_limit, 2) }}</td>
            <td>$0</td>
            <td>{{ $customer->sales_rep_id ?? 'N/A' }}</td>
            <td><span class="badge-status badge-active">Active</span></td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $customer->id }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalCustomer" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $customer->id }}" data-delete-label="{{ $customer->company_name }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Add Customer</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-customer">
        <div class="modal-body">
          <input type="hidden" name="id" id="customer-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Company Name</label>
              <input class="erp-form-control" type="text" name="company_name" id="company-name" placeholder="Company name" required />
              <div class="invalid-feedback" id="error-company_name"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Contact Person</label>
              <input class="erp-form-control" type="text" name="contact_person" id="contact-person" placeholder="Contact name" />
              <div class="invalid-feedback" id="error-contact_person"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Email</label>
              <input class="erp-form-control" type="email" name="email" id="email" placeholder="" />
              <div class="invalid-feedback" id="error-email"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Phone</label>
              <input class="erp-form-control" type="text" name="phone" id="phone" placeholder="" />
              <div class="invalid-feedback" id="error-phone"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Credit Limit ($)</label>
              <input class="erp-form-control" type="number" name="credit_limit" id="credit-limit" placeholder="" />
              <div class="invalid-feedback" id="error-credit_limit"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Sales Rep</label>
              <select class="erp-form-control" name="sales_rep_id" id="sales-rep">
                <option value="">Select Sales Rep</option>
                <option value="Sara L.">Sara L.</option>
                <option value="James R.">James R.</option>
              </select>
              <div class="invalid-feedback" id="error-sales_rep_id"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Billing Address</label>
              <textarea class="erp-form-control" name="billing_address" id="billing-address" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-billing_address"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Customer
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
  const modalCustomer = document.getElementById('modalCustomer');
  const formCustomer = document.getElementById('form-customer');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalCustomer.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formCustomer);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Customer';

      apiClient.show(API_ENDPOINTS.SALES.CUSTOMERS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('customer-id').value = item.id;
          formCustomer.querySelector('[name="company_name"]').value = item.company_name || '';
          formCustomer.querySelector('[name="contact_person"]').value = item.contact_person || '';
          formCustomer.querySelector('[name="email"]').value = item.email || '';
          formCustomer.querySelector('[name="phone"]').value = item.phone || '';
          formCustomer.querySelector('[name="credit_limit"]').value = item.credit_limit || '';
          formCustomer.querySelector('[name="sales_rep_id"]').value = item.sales_rep_id || '';
          formCustomer.querySelector('[name="billing_address"]').value = item.billing_address || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'Add Customer';
      formCustomer.reset();
      document.getElementById('customer-id').value = '';
    }
  });

  formCustomer.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('customer-id').value;

    const formData = new FormData(formCustomer);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.SALES.CUSTOMERS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.SALES.CUSTOMERS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalCustomer).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formCustomer, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.SALES.CUSTOMERS.DESTROY, deleteId)
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