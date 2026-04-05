@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Interaction History</div>
    <div class="page-subtitle">Customer interaction and communication history log</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline" id="btn-lookup-subject"><i class="bi bi-search"></i> By Subject</button>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalInteraction" id="btn-add-interaction"><i class="bi bi-plus-lg"></i> Log Interaction</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search interaction history…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Call</option><option>Email</option><option>Meeting</option><option>Demo</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Date</th><th>Subject Type</th><th>Subject ID</th><th>Type</th><th>Notes</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalInteraction" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Interaction</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formInteraction">
          <input type="hidden" name="id" id="int-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Subject Type</label><select class="erp-form-control" name="subject_type"><option>Customer</option><option>Lead</option><option>Ticket</option></select></div>
            <div class="col-md-6"><label class="erp-form-label">Subject ID</label><input class="erp-form-control" name="subject_id" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Interaction Type</label><select class="erp-form-control" name="type"><option>Call</option><option>Email</option><option>Meeting</option><option>Demo</option></select></div>
            <div class="col-md-6"><label class="erp-form-label">Date</label><input class="erp-form-control" name="interaction_date" type="date" placeholder=""/></div>
            <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control" name="notes" rows="3" placeholder=""></textarea></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-interaction">
          <i class="bi bi-check2"></i> Save
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  var editId = null;

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/crm/interactions', function(item){
      var typeBadge = item.type === 'Meeting' ? 'badge-info' : (item.type === 'Call' ? 'badge-active' : 'badge-pending');
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.interaction_date||'')+'</td>'
        +'<td>'+(item.subject_type||'')+'</td>'
        +'<td>'+(item.subject_id||'')+'</td>'
        +'<td><span class="badge-status '+typeBadge+'">'+(item.type||'')+'</span></td>'
        +'<td>'+(item.notes||'')+'</td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalInteraction" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/crm/interactions/'+item.id+'" data-delete-label="Interaction" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  function renderInteractionRow(item){
    var typeBadge = item.type === 'Meeting' ? 'badge-info' : (item.type === 'Call' ? 'badge-active' : 'badge-pending');
    return '<tr data-id="'+item.id+'">'
      +'<td>'+(item.interaction_date||'')+'</td>'
      +'<td>'+(item.subject_type||'')+'</td>'
      +'<td>'+(item.subject_id||'')+'</td>'
      +'<td><span class="badge-status '+typeBadge+'">'+(item.type||'')+'</span></td>'
      +'<td>'+(item.notes||'')+'</td>'
      +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalInteraction" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/crm/interactions/'+item.id+'" data-delete-label="Interaction" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
      +'</tr>';
  }

  loadTableData();

  $('#btn-add-interaction').on('click', function(){
    editId = null;
    ErpApi.clearForm('#formInteraction');
    $('#modalInteraction .modal-title').text('Log Interaction');
  });

  $(document).on('click', '.btn-edit', function(){
    editId = $(this).data('id');
    ErpApi.get('/crm/interactions/'+editId, function(res){
      if(res.success){
        ErpApi.populateForm('#formInteraction', res.data);
        $('#modalInteraction .modal-title').text('Edit Interaction');
      }
    });
  });

  $('#btn-save-interaction').on('click', function(){
    var data = ErpApi.collectForm('#formInteraction');
    if(editId){
      ErpApi.put('/crm/interactions/'+editId, data, function(res){
        if(res.success){
          showToast(res.message || 'Interaction updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalInteraction')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/crm/interactions', data, function(res){
        if(res.success){
          showToast(res.message || 'Interaction logged', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalInteraction')).hide();
          loadTableData();
        }
      });
    }
  });

  $('#btn-lookup-subject').on('click', function(){
    var subjectType = prompt('Enter subject type (Customer/Lead/Ticket):');
    var subjectId = prompt('Enter subject ID:');
    if(subjectType && subjectId){
      ErpApi.get('/crm/interactions/by-subject', { subject_type: subjectType, subject_id: subjectId }, function(res){
        if(res.success){
          showToast('Found '+(res.data.data ? res.data.data.length : 0)+' interactions', 'info');
          if(res.data.data){
            ErpApi.setTableData('#tbl-main', res.data.data, renderInteractionRow, 'No interactions found');
          }
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/crm/interactions/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Interaction deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
