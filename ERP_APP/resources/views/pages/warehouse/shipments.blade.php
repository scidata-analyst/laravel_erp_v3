@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Shipments</div>
    <div class="page-subtitle">Track outbound shipments and delivery status</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalShipment"><i class="bi bi-plus-lg"></i> New Shipment</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search shipments…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Preparing</option><option>Dispatched</option><option>In Transit</option><option>Delivered</option><option>Failed</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Shipment #</th><th>Origin</th><th>Destination</th><th>Carrier</th><th>Status</th><th>Shipped</th><th>Est. Arrival</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalShipment" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Shipment</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Shipment Number</label><input class="erp-form-control" name="shipment_number" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Carrier</label><input class="erp-form-control" name="carrier" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Origin</label><input class="erp-form-control" name="origin" type="text" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Destination</label><input class="erp-form-control" name="destination" type="text" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Preparing</option><option>Dispatched</option><option>In Transit</option><option>Delivered</option><option>Failed</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Shipped Date</label><input class="erp-form-control" name="shipped_date" type="date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Est. Arrival</label><input class="erp-form-control" name="estimated_arrival" type="date" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Create Shipment
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/warehouse/shipments';

  var statusBadge = function(s){
    if(s==='Delivered') return 'badge-active';
    if(s==='In Transit'||s==='Dispatched') return 'badge-info';
    if(s==='Failed') return 'badge-inactive';
    return 'badge-pending';
  };

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.shipment_number||'')+'</td>'
        +'<td>'+(item.origin||'')+'</td>'
        +'<td>'+(item.destination||'')+'</td>'
        +'<td>'+(item.carrier||'')+'</td>'
        +'<td><span class="badge-status '+statusBadge(item.status)+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.shipped_date||'—')+'</td>'
        +'<td>'+(item.estimated_arrival||'—')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Shipment" title="Delete"><i class="bi bi-trash"></i></button>'
        +'<button class="btn-erp btn-info btn-xs btn-icon btn-update-status" data-id="'+item.id+'" title="Update Status"><i class="bi bi-arrow-repeat"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalShipment').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalShipment');
    }
  });

  $('#modalShipment').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalShipment');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalShipment', res.data);
        new bootstrap.Modal($('#modalShipment')[0]).show();
      }
    });
  });

  $('#modalShipment .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalShipment');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Shipment updated','success'); bootstrap.Modal.getInstance($('#modalShipment')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Shipment created','success'); bootstrap.Modal.getInstance($('#modalShipment')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-update-status', function(){
    var id = $(this).data('id');
    var newStatus = prompt('Enter new status (Preparing/Dispatched/In Transit/Delivered/Failed):');
    if(newStatus){
      ErpApi.put(baseUrl+'/'+id+'/status', {status: newStatus}).then(function(res){
        if(res.success){ showToast(res.message||'Status updated','success'); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    }
  });
});
</script>
@endsection
