@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Supplier Management</div>
    <div class="page-subtitle">Manage supplier info, contacts and ratings</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupplier" id="btnAddSupplier"><i class="bi bi-plus-lg"></i> Add Supplier</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search supplier management…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Active</option><option>Inactive</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Supplier</th><th>Contact</th><th>Email</th><th>Phone</th><th>Payment Terms</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="tbl-suppliers-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalSupplier" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Supplier</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Company Name</label><input class="erp-form-control" type="text" name="name" placeholder="Supplier Ltd."/></div>
          <div class="col-md-6"><label class="erp-form-label">Contact Person</label><input class="erp-form-control" type="text" name="contact_person" placeholder="Contact name"/></div>
          <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control" type="email" name="email" placeholder="contact@supplier.com"/></div>
          <div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" type="text" name="phone" placeholder="+1-555-0000"/></div>
          <div class="col-md-6"><label class="erp-form-label">Payment Terms</label><select class="erp-form-control" name="payment_terms"><option>Net 30</option><option>Net 60</option><option>Net 90</option><option>Prepaid</option></select></div>
          <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Active</option><option>Inactive</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Address</label><textarea class="erp-form-control" name="address" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Supplier
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  function renderRow(item) {
    var statusClass = item.status === 'Active' ? 'badge-active' : 'badge-inactive';
    return '<tr data-id="'+item.id+'">'
      +'<td>'+item.name+'</td>'
      +'<td>'+item.contact_person+'</td>'
      +'<td>'+item.email+'</td>'
      +'<td>'+item.phone+'</td>'
      +'<td>'+item.payment_terms+'</td>'
      +'<td><span class="badge-status '+statusClass+'">'+item.status+'</span></td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-supplier" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/purchase/suppliers/'+item.id+'" data-delete-label="Supplier" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/purchase/suppliers', '#tbl-suppliers-body', renderRow, 'No suppliers found');
  }

  loadTableData();

  $('#btnAddSupplier').on('click', function(){
    editId = null;
    ErpApi.clearForm('#modalSupplier');
    $('#modalSupplier .modal-title').text('Add / Edit Supplier');
  });

  $(document).on('click', '.btn-edit-supplier', function(){
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/purchase/suppliers/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalSupplier', res.data);
        $('#modalSupplier [name="id"]').val(id);
        $('#modalSupplier .modal-title').text('Edit Supplier');
        new bootstrap.Modal(document.getElementById('modalSupplier')).show();
      }
    });
  });

  $('#modalSupplier .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalSupplier');
    if(editId) {
      ErpApi.put('/purchase/suppliers/'+editId, data, {
        success: function(res){ showToast(res.message || 'Supplier updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalSupplier')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to update supplier','danger'); }
      });
    } else {
      ErpApi.post('/purchase/suppliers', data, {
        success: function(res){ showToast(res.message || 'Supplier created','success'); bootstrap.Modal.getInstance(document.getElementById('modalSupplier')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to create supplier','danger'); }
      });
    }
  });

  $(document).on('click', '[data-delete-url]', function(){
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label') || 'Item';
    if(confirm('Are you sure you want to delete this '+label+'?')) {
      ErpApi.del(url, {
        success: function(res){ showToast(res.message || label+' deleted','success'); loadTableData(); },
        error: function(){ showToast('Failed to delete '+label,'danger'); }
      });
    }
  });
});
</script>
@endsection
