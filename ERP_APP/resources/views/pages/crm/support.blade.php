@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Customer Support</div>
    <div class="page-subtitle">Customer support tickets, complaints and resolution tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalSupport" id="btn-add-ticket"><i class="bi bi-plus-lg"></i> New Ticket</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search customer support…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Open</option><option>In Progress</option><option>Resolved</option><option>Closed</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Ticket #</th><th>Customer</th><th>Subject</th><th>Priority</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalSupport" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Support Ticket</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formSupport">
          <input type="hidden" name="id" id="ticket-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Customer ID</label><input class="erp-form-control" name="customer_id" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Subject</label><input class="erp-form-control" name="subject" type="text" placeholder=""/></div>
            <div class="col-md-4"><label class="erp-form-label">Priority</label><select class="erp-form-control" name="priority"><option>Low</option><option>Medium</option><option>High</option><option>Urgent</option></select></div>
            <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Open</option><option>In Progress</option><option>Resolved</option><option>Closed</option></select></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="3" placeholder=""></textarea></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-ticket">
          <i class="bi bi-check2"></i> Create Ticket
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  var badgeMap = {'Open':'badge-pending','In Progress':'badge-pending','Resolved':'badge-active','Closed':'badge-inactive'};
  var priorityMap = {'Low':'badge-active','Medium':'badge-info','High':'badge-pending','Urgent':'badge-inactive'};

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/crm/support', function(item){
      var bc = badgeMap[item.status] || 'badge-pending';
      var pc = priorityMap[item.priority] || 'badge-info';
      var resolveBtn = (item.status !== 'Resolved' && item.status !== 'Closed') ? '<button class="btn-erp btn-success btn-xs btn-resolve" data-id="'+item.id+'" title="Resolve"><i class="bi bi-check-circle"></i></button>' : '';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.ticket_number || 'TKT-'+item.id)+'</td>'
        +'<td>'+(item.customer_name || item.customer_id ||'')+'</td>'
        +'<td>'+(item.subject||'')+'</td>'
        +'<td><span class="badge-status '+pc+'">'+(item.priority||'')+'</span></td>'
        +'<td>'+(item.description||'').substring(0,50)+((item.description||'').length > 50 ? '…' : '')+'</td>'
        +'<td><span class="badge-status '+bc+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1">'+resolveBtn+'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalSupport" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/crm/support/'+item.id+'" data-delete-label="Ticket" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-ticket').on('click', function(){
    ErpApi.clearForm('#formSupport');
    $('#modalSupport .modal-title').text('New Support Ticket');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get('/crm/support/'+id, function(res){
      if(res.success){
        ErpApi.populateForm('#formSupport', res.data);
        $('#modalSupport .modal-title').text('Edit Support Ticket');
      }
    });
  });

  $('#btn-save-ticket').on('click', function(){
    var data = ErpApi.collectForm('#formSupport');
    var id = data.id;
    delete data.id;
    if(id){
      ErpApi.put('/crm/support/'+id, data, function(res){
        if(res.success){
          showToast(res.message || 'Ticket updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalSupport')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/crm/support', data, function(res){
        if(res.success){
          showToast(res.message || 'Ticket created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalSupport')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-resolve', function(){
    var id = $(this).data('id');
    var resolution = prompt('Enter resolution notes:');
    if(resolution !== null){
      ErpApi.post('/crm/support/'+id+'/resolve', {resolution: resolution}, function(res){
        if(res.success){
          showToast(res.message || 'Ticket resolved', 'success');
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/crm/support/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Ticket deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
