@extends('layouts.erp')

@section('title', 'Discounts & Promotions')
@section('breadcrumb', 'Discounts & Promotions')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Discounts & Promotions</div>
    <div class="page-subtitle">Create and manage discount rules and promotional campaigns</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPromo" data-mode="create"><i class="bi bi-plus-lg"></i> New Promotion</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search discounts & promotions…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Active</option><option>Scheduled</option><option>Expired</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Promo Code</th><th>Description</th><th>Discount</th><th>Type</th><th>Valid From</th><th>Valid To</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @foreach ($data as $promo)
          <tr>
            <td>{{ $promo->promo_code }}</td>
            <td>{{ $promo->description }}</td>
            <td>
              @if ($promo->discount_type == 'Percentage')
                {{ $promo->discount_value }}%
              @else
                ${{ number_format($promo->discount_value, 2) }}
              @endif
            </td>
            <td>{{ $promo->discount_type }}</td>
            <td>{{ $promo->valid_from ? \Carbon\Carbon::parse($promo->valid_from)->format('Y-m-d') : 'N/A' }}</td>
            <td>{{ $promo->valid_to ? \Carbon\Carbon::parse($promo->valid_to)->format('Y-m-d') : 'N/A' }}</td>
            <td>
              @if ($promo->status == 'Active')
                <span class="badge-status badge-active">Active</span>
              @elseif ($promo->status == 'Scheduled')
                <span class="badge-status badge-pending">Scheduled</span>
              @else
                <span class="badge-status badge-inactive">Expired</span>
              @endif
            </td>
            <td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="{{ $promo->id }}" data-mode="edit" data-bs-toggle="modal" data-bs-target="#modalPromo" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-id="{{ $promo->id }}" data-delete-label="{{ $promo->promo_code }}" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>
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

<div class="modal fade" id="modalPromo" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Promotion</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-promotion">
        <div class="modal-body">
          <input type="hidden" name="id" id="promotion-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Promo Code</label>
              <input class="erp-form-control" type="text" name="promo_code" id="promo-code" placeholder="PROMO2025" />
              <div class="invalid-feedback" id="error-promo_code"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Description</label>
              <input class="erp-form-control" type="text" name="description" id="description" placeholder="" />
              <div class="invalid-feedback" id="error-description"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Discount Value</label>
              <input class="erp-form-control" type="number" name="discount_value" id="discount-value" placeholder="" />
              <div class="invalid-feedback" id="error-discount_value"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Type</label>
              <select class="erp-form-control" name="discount_type" id="discount-type">
                <option value="Percentage">Percentage</option>
                <option value="Fixed Amount">Fixed Amount</option>
                <option value="Free Shipping">Free Shipping</option>
              </select>
              <div class="invalid-feedback" id="error-discount_type"></div>
            </div>
            <div class="col-md-4">
              <label class="erp-form-label">Min. Order ($)</label>
              <input class="erp-form-control" type="number" name="min_order" id="min-order" placeholder="" />
              <div class="invalid-feedback" id="error-min_order"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Valid From</label>
              <input class="erp-form-control" type="date" name="valid_from" id="valid-from" />
              <div class="invalid-feedback" id="error-valid_from"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Valid To</label>
              <input class="erp-form-control" type="date" name="valid_to" id="valid-to" />
              <div class="invalid-feedback" id="error-valid_to"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Applicable Products/Categories</label>
              <input class="erp-form-control" type="text" name="applicable_products" id="applicable-products" placeholder="All or specify…" />
              <div class="invalid-feedback" id="error-applicable_products"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save Promotion
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
  const modalPromo = document.getElementById('modalPromo');
  const formPromotion = document.getElementById('form-promotion');
  const modalDelete = document.getElementById('modalDelete');
  const btnConfirmDelete = document.getElementById('btn-confirm-delete');

  let deleteId = null;

  modalPromo.addEventListener('show.bs.modal', function(e) {
    clearFormErrors(formPromotion);
    const button = e.relatedTarget;
    const mode = button?.dataset.mode || 'create';
    const modalTitle = document.getElementById('modal-title');

    if (mode === 'edit') {
      const id = button.dataset.id;
      modalTitle.textContent = 'Edit Promotion';

      apiClient.show(API_ENDPOINTS.SALES.PROMOTIONS.SHOW, id)
        .then(data => {
          const item = data.data || data;
          document.getElementById('promotion-id').value = item.id;
          formPromotion.querySelector('[name="promo_code"]').value = item.promo_code || '';
          formPromotion.querySelector('[name="description"]').value = item.description || '';
          formPromotion.querySelector('[name="discount_value"]').value = item.discount_value || '';
          formPromotion.querySelector('[name="discount_type"]').value = item.discount_type || '';
          formPromotion.querySelector('[name="min_order"]').value = item.min_order || '';
          formPromotion.querySelector('[name="valid_from"]').value = item.valid_from ? item.valid_from.split('T')[0] : '';
          formPromotion.querySelector('[name="valid_to"]').value = item.valid_to ? item.valid_to.split('T')[0] : '';
          formPromotion.querySelector('[name="applicable_products"]').value = item.applicable_products || '';
        })
        .catch(error => showToast(error.message || 'Failed to load data', 'error'));
    } else {
      modalTitle.textContent = 'New Promotion';
      formPromotion.reset();
      document.getElementById('promotion-id').value = '';
    }
  });

  formPromotion.addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('promotion-id').value;

    const formData = new FormData(formPromotion);
    const payload = Object.fromEntries(formData.entries());

    let request;
    if (id) {
      request = apiClient.update(API_ENDPOINTS.SALES.PROMOTIONS.UPDATE, id, payload);
    } else {
      request = apiClient.store(API_ENDPOINTS.SALES.PROMOTIONS.STORE, payload);
    }

    request
    .then(data => {
      if (data.success || data.id) {
        bootstrap.Modal.getInstance(modalPromo).hide();
        showToast(data.message || 'Success', 'success');
        setTimeout(() => location.reload(), 1000);
      } else {
        showToast(data.message || 'Error', 'error');
      }
    })
    .catch(error => {
      if (error.errors) {
        handleFormErrors(formPromotion, error.errors);
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

    apiClient.destroy(API_ENDPOINTS.SALES.PROMOTIONS.DESTROY, deleteId)
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