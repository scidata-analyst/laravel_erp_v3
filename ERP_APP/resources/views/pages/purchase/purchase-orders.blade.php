@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Purchase Orders</div>
    <div class="page-subtitle">Create, approve and track purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPO" id="btnAddPO"><i class="bi bi-plus-lg"></i> New PO</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search purchase orders…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Draft</option><option>Pending</option><option>Approved</option><option>Received</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>PO #</th><th>Supplier</th><th>Date</th><th>Total</th><th>Status</th><th>Notes</th><th>Actions</th></tr></thead>
      <tbody id="tbl-po-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalPO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Create Purchase Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3 mb-3">
          <div class="col-md-6"><label class="erp-form-label">Supplier</label><select class="erp-form-control" name="supplier_id"><option value="">Select Supplier</option><option value="1">TechSource Ltd.</option><option value="2">GlobalParts Inc.</option></select></div>
          <div class="col-md-3"><label class="erp-form-label">Order Date</label><input class="erp-form-control" type="date" name="order_date" placeholder=""/></div>
          <div class="col-md-3"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Draft</option><option>Pending</option><option>Approved</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Submit PO
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var editId = null;

  function statusBadge(status) {
    var map = {'Approved':'badge-info','Pending':'badge-pending','Draft':'badge-info','Received':'badge-active'};
    return '<span class="badge-status '+(map[status]||'badge-info')+'">'+status+'</span>';
  }

  function renderRow(item) {
    return '<tr data-id="'+item.id+'">'
      +'<td>PO-'+item.id+'</td>'
      +'<td>'+(item.supplier_name || item.supplier_id)+'</td>'
      +'<td>'+item.order_date+'</td>'
      +'<td>$'+Number(item.total_amount||0).toLocaleString()+'</td>'
      +'<td>'+statusBadge(item.status)+'</td>'
      +'<td>'+(item.notes||'—')+'</td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-success btn-xs btn-update-status" data-id="'+item.id+'" data-status="'+item.status+'" title="Update Status">Status</button>'
      +'<button class="btn-erp btn-outline btn-xs btn-receive-po" data-id="'+item.id+'" title="Receive"><i class="bi bi-box-arrow-in-down"></i></button>'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-po" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/purchase/purchase-orders/'+item.id+'" data-delete-label="PO" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/purchase/purchase-orders', '#tbl-po-body', renderRow, 'No purchase orders found');
  }

  loadTableData();

  $('#btnAddPO').on('click', function(){
    editId = null;
    ErpApi.clearForm('#modalPO');
    $('#modalPO .modal-title').text('Create Purchase Order');
  });

  $(document).on('click', '.btn-edit-po', function(){
    var id = $(this).data('id');
    editId = id;
    ErpApi.get('/purchase/purchase-orders/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalPO', res.data);
        $('#modalPO [name="id"]').val(id);
        $('#modalPO .modal-title').text('Edit Purchase Order');
        new bootstrap.Modal(document.getElementById('modalPO')).show();
      }
    });
  });

  $('#modalPO .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalPO');
    if(editId) {
      ErpApi.put('/purchase/purchase-orders/'+editId, data, {
        success: function(res){ showToast(res.message || 'PO updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalPO')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to update PO','danger'); }
      });
    } else {
      ErpApi.post('/purchase/purchase-orders', data, {
        success: function(res){ showToast(res.message || 'PO created','success'); bootstrap.Modal.getInstance(document.getElementById('modalPO')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to create PO','danger'); }
      });
    }
  });

  $(document).on('click', '.btn-update-status', function(){
    var id = $(this).data('id');
    var newStatus = prompt('Enter new status (Draft/Pending/Approved/Received):', $(this).data('status'));
    if(newStatus) {
      ErpApi.put('/purchase/purchase-orders/'+id+'/status', {status: newStatus}, {
        success: function(res){ showToast(res.message || 'Status updated','success'); loadTableData(); },
        error: function(){ showToast('Failed to update status','danger'); }
      });
    }
  });

  $(document).on('click', '.btn-receive-po', function(){
    var id = $(this).data('id');
    if(confirm('Mark this PO as received?')) {
      ErpApi.post('/purchase/purchase-orders/'+id+'/receive', {}, {
        success: function(res){ showToast(res.message || 'PO marked as received','success'); loadTableData(); },
        error: function(){ showToast('Failed to receive PO','danger'); }
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
