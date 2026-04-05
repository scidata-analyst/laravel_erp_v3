@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Work Orders</div>
    <div class="page-subtitle">Production work orders and manufacturing scheduling</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalWorkOrder" id="btn-add-wo"><i class="bi bi-plus-lg"></i> New Work Order</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search work orders…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Scheduled</option><option>In Progress</option><option>Completed</option><option>On Hold</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>WO #</th><th>Product</th><th>Qty</th><th>Start Date</th><th>End Date</th><th>Produced</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalWorkOrder" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Work Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formWorkOrder">
          <input type="hidden" name="id" id="wo-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product ID</label><input class="erp-form-control" name="product_id" type="text" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Qty to Produce</label><input class="erp-form-control" name="quantity" type="number" placeholder=""/></div>
            <div class="col-md-3"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Scheduled</option><option>In Progress</option><option>Completed</option><option>On Hold</option></select></div>
            <div class="col-md-4"><label class="erp-form-label">Start Date</label><input class="erp-form-control" name="start_date" type="date" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">End Date</label><input class="erp-form-control" name="end_date" type="date" placeholder=""/></div>
            <div class="col-md-2"><label class="erp-form-label">Produced Qty</label><input class="erp-form-control" name="produced_qty" type="number" placeholder=""/></div>
            <div class="col-md-2"><label class="erp-form-label">Scrap Qty</label><input class="erp-form-control" name="scrap_qty" type="number" placeholder=""/></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-wo">
          <i class="bi bi-check2"></i> Create Work Order
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  var badgeMap = {'Scheduled':'badge-pending','In Progress':'badge-pending','Completed':'badge-active','On Hold':'badge-info'};

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/production/work-orders', function(item){
      var bc = badgeMap[item.status] || 'badge-pending';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.wo_number || 'WO-'+item.id)+'</td>'
        +'<td>'+(item.product_name || item.product_id ||'')+'</td>'
        +'<td>'+(item.quantity||0)+' units</td>'
        +'<td>'+(item.start_date||'')+'</td>'
        +'<td>'+(item.end_date||'')+'</td>'
        +'<td>'+(item.produced_qty||0)+'/'+(item.quantity||0)+'</td>'
        +'<td><span class="badge-status '+bc+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalWorkOrder" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-outline btn-xs btn-progress" data-id="'+item.id+'" title="Update Progress"><i class="bi bi-graph-up"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/production/work-orders/'+item.id+'" data-delete-label="Work Order" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-wo').on('click', function(){
    ErpApi.clearForm('#formWorkOrder');
    $('#modalWorkOrder .modal-title').text('New Work Order');
  });

  $('#btn-save-wo').on('click', function(){
    var data = ErpApi.collectForm('#formWorkOrder');
    var id = data.id;
    delete data.id;
    if(id){
      ErpApi.put('/production/work-orders/'+id, data, function(res){
        if(res.success){
          showToast(res.message || 'Work order updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalWorkOrder')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/production/work-orders', data, function(res){
        if(res.success){
          showToast(res.message || 'Work order created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalWorkOrder')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get('/production/work-orders/'+id, function(res){
      if(res.success){
        ErpApi.populateForm('#formWorkOrder', res.data);
        $('#modalWorkOrder .modal-title').text('Edit Work Order');
      }
    });
  });

  $(document).on('click', '.btn-progress', function(){
    var id = $(this).data('id');
    var produced = prompt('Enter produced quantity:');
    var scrap = prompt('Enter scrap quantity:');
    if(produced !== null){
      ErpApi.put('/production/work-orders/'+id+'/progress', {produced_qty: produced, scrap_qty: scrap||0}, function(res){
        if(res.success){
          showToast(res.message || 'Progress updated', 'success');
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/production/work-orders/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Work order deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
