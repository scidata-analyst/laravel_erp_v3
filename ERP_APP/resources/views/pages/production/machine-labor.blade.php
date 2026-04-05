@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Machine & Labor</div>
    <div class="page-subtitle">Track machine utilization and labor hours on production</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline" id="btn-cost-lookup"><i class="bi bi-calculator"></i> Cost Lookup</button>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalMachineLabor" id="btn-add-ml"><i class="bi bi-plus-lg"></i> Log Entry</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search machine & labor…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Machine</option><option>Labor</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Work Order</th><th>Resource</th><th>Type</th><th>Hours</th><th>Rate/hr</th><th>Total Cost</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalMachineLabor" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Machine / Labor Entry</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formMachineLabor">
          <input type="hidden" name="id" id="ml-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Work Order ID</label><input class="erp-form-control" name="work_order_id" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Resource Name</label><input class="erp-form-control" name="resource_name" type="text" placeholder="Machine or employee name"/></div>
            <div class="col-md-4"><label class="erp-form-label">Type</label><select class="erp-form-control" name="resource_type"><option>Machine</option><option>Labor</option></select></div>
            <div class="col-md-4"><label class="erp-form-label">Hours Used</label><input class="erp-form-control" name="hours" type="number" step="0.1" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Cost per Hour ($)</label><input class="erp-form-control" name="rate" type="number" step="0.01" placeholder=""/></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-ml">
          <i class="bi bi-check2"></i> Log Entry
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/production/machine-labor', function(item){
      var cost = (Number(item.hours||0) * Number(item.rate||0)).toFixed(2);
      var typeBadge = item.resource_type === 'Machine' ? 'badge-info' : 'badge-pending';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.work_order_number || item.work_order_id ||'')+'</td>'
        +'<td>'+(item.resource_name||'')+'</td>'
        +'<td><span class="badge-status '+typeBadge+'">'+(item.resource_type||'')+'</span></td>'
        +'<td>'+(item.hours||0)+'h</td>'
        +'<td>$'+Number(item.rate||0).toFixed(2)+'</td>'
        +'<td>$'+cost+'</td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalMachineLabor" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/production/machine-labor/'+item.id+'" data-delete-label="Entry" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-ml').on('click', function(){
    ErpApi.clearForm('#formMachineLabor');
    $('#modalMachineLabor .modal-title').text('Log Machine / Labor Entry');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get('/production/machine-labor/'+id, function(res){
      if(res.success){
        ErpApi.populateForm('#formMachineLabor', res.data);
        $('#modalMachineLabor .modal-title').text('Edit Entry');
      }
    });
  });

  $('#btn-save-ml').on('click', function(){
    var data = ErpApi.collectForm('#formMachineLabor');
    var id = data.id;
    delete data.id;
    data.cost = (Number(data.hours||0) * Number(data.rate||0)).toFixed(2);
    if(id){
      ErpApi.put('/production/machine-labor/'+id, data, function(res){
        if(res.success){
          showToast(res.message || 'Entry updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalMachineLabor')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/production/machine-labor', data, function(res){
        if(res.success){
          showToast(res.message || 'Entry logged', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalMachineLabor')).hide();
          loadTableData();
        }
      });
    }
  });

  $('#btn-cost-lookup').on('click', function(){
    var woId = prompt('Enter Work Order ID to lookup cost:');
    if(woId){
      ErpApi.get('/production/machine-labor/cost/'+woId, function(res){
        if(res.success){
          showToast('Total cost: $'+Number(res.data.total_cost||0).toFixed(2), 'info');
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/production/machine-labor/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Entry deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
