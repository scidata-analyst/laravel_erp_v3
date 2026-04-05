@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Customer Management</div>
    <div class="page-subtitle">Customer info, credit limits and receivables</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCustomer"><i class="bi bi-plus-lg"></i> Add Customer</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer management…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option value="active">Active</option><option value="blocked">Blocked</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Customer</th><th>Contact</th><th>Email</th><th>Credit Limit</th><th>Outstanding</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination"></div>
</div>

<div class="modal fade" id="modalCustomer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Customer</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
<div class="row g-3"><div class="col-md-6"><label class="erp-form-label">Company Name</label><input class="erp-form-control" name="name" type="text" placeholder="Company name"/></div><div class="col-md-6"><label class="erp-form-label">Contact Person</label><input class="erp-form-control" name="contact_person" type="text" placeholder="Contact name"/></div><div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" name="email" type="email" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" name="phone" type="text" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Credit Limit ($)</label><input class="erp-form-control" name="credit_limit" type="number" placeholder=""/></div><div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option value="active">Active</option><option value="blocked">Blocked</option></select></div><div class="col-md-12"><label class="erp-form-label">Billing Address</label><textarea class="erp-form-control" name="billing_address" rows="2" placeholder=""></textarea></div></div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Customer
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Confirm Delete</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <p style="color:var(--text-secondary)">Are you sure you want to delete this customer?</p>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-danger btn-confirm-delete">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
$(function(){
  var editingId = null;
  var deleteUrl = null;

  function statusBadge(status) {
    var cls = status === 'active' ? 'badge-active' : 'badge-inactive';
    var label = status === 'active' ? 'Active' : (status === 'blocked' ? 'Blocked' : status);
    return '<span class="badge-status ' + cls + '">' + label + '</span>';
  }

  function renderRow(item) {
    return '<tr>' +
      '<td>' + (item.name || '') + '</td>' +
      '<td>' + (item.contact_person || '') + '</td>' +
      '<td>' + (item.email || '') + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">$' + Number(item.credit_limit || 0).toLocaleString() + '</td>' +
      '<td style="font-family:IBM Plex Mono,monospace">$' + Number(item.outstanding || 0).toLocaleString() + '</td>' +
      '<td>' + statusBadge(item.status) + '</td>' +
      '<td><div class="d-flex gap-1">' +
        '<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalCustomer" title="Edit"><i class="bi bi-pencil"></i></button>' +
        '<button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-delete-url="/sales/customers/' + item.id + '" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button>' +
      '</div></td></tr>';
  }

  window.loadTableData = function() {
    ErpApi.loadTable('/sales/customers', '#tbl-main tbody', renderRow, '<tr><td colspan="7" class="text-center">No customers found</td></tr>');
  };

  loadTableData();

  $('#modalCustomer').on('show.bs.modal', function() {
    if (!editingId) {
      ErpApi.clearForm('#modalCustomer');
      $('#modalCustomer .modal-title').text('Add / Edit Customer');
    }
  });

  $('#modalCustomer').on('hidden.bs.modal', function() {
    editingId = null;
    ErpApi.clearForm('#modalCustomer');
  });

  $(document).on('click', '.btn-edit', function() {
    editingId = $(this).data('id');
    $('#modalCustomer .modal-title').text('Edit Customer');
    ErpApi.get('/sales/customers/' + editingId, {
      success: function(res) {
        ErpApi.populateForm('#modalCustomer', res.data);
      }
    });
  });

  $(document).on('click', '.btn-modal-save', function() {
    var data = ErpApi.collectForm('#modalCustomer');
    if (editingId) {
      ErpApi.put('/sales/customers/' + editingId, data, {
        success: function(res) {
          showToast(res.message || 'Customer updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalCustomer')).hide();
          loadTableData();
        },
        error: function() { showToast('Failed to update customer', 'danger'); }
      });
    } else {
      ErpApi.post('/sales/customers', data, {
        success: function(res) {
          showToast(res.message || 'Customer created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalCustomer')).hide();
          loadTableData();
        },
        error: function() { showToast('Failed to create customer', 'danger'); }
      });
    }
  });

  $(document).on('click', '.btn-delete', function() {
    deleteUrl = $(this).data('delete-url');
  });

  $(document).on('click', '.btn-confirm-delete', function() {
    if (!deleteUrl) return;
    ErpApi.del(deleteUrl, {
      success: function(res) {
        showToast(res.message || 'Customer deleted', 'success');
        bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
        loadTableData();
      },
      error: function() { showToast('Failed to delete customer', 'danger'); }
    });
    deleteUrl = null;
  });
});
</script>
@endsection
