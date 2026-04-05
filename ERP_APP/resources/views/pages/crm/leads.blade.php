@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Leads & Opportunities</div>
    <div class="page-subtitle">Track sales pipeline and conversion</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalLead" id="btn-add-lead"><i class="bi bi-plus-lg"></i> New Lead</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-3">
    <div class="kpi-tile blue">
      <div class="kpi-icon blue"><i class="bi bi-funnel"></i></div>
      <div class="kpi-value" id="kpi-total">84</div>
      <div class="kpi-label">Total Leads</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="kpi-tile yellow">
      <div class="kpi-icon yellow"><i class="bi bi-trophy"></i></div>
      <div class="kpi-value" id="kpi-opportunities">26</div>
      <div class="kpi-label">Opportunities</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="kpi-tile green">
      <div class="kpi-icon green"><i class="bi bi-check2-all"></i></div>
      <div class="kpi-value" id="kpi-won">18</div>
      <div class="kpi-label">Won</div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="kpi-tile red">
      <div class="kpi-icon red"><i class="bi bi-x-circle"></i></div>
      <div class="kpi-value" id="kpi-lost">9</div>
      <div class="kpi-label">Lost</div>
    </div>
  </div>
</div>
<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search leads & opportunities…" />
    </div>
    <select class="erp-form-control" name="status" style="width:140px">
      <option>All Status</option>
      <option>New</option>
      <option>Qualified</option>
      <option>Proposal</option>
      <option>Won</option>
      <option>Lost</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>Lead</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Value</th>
          <th>Source</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalLead" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Lead / Opportunity</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formLead">
          <input type="hidden" name="id" id="lead-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Lead Name</label><input
                class="erp-form-control" name="name" type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control"
                name="email" type="email" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control"
                name="phone" type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Source</label><select class="erp-form-control" name="source">
                <option>Website</option>
                <option>Referral</option>
                <option>Trade Show</option>
                <option>Cold Call</option>
                <option>Social Media</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Estimated Value ($)</label><input
                class="erp-form-control" name="estimated_value" type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Status</label><select
                class="erp-form-control" name="status">
                <option>New</option>
                <option>Qualified</option>
                <option>Proposal</option>
                <option>Won</option>
                <option>Lost</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea
                class="erp-form-control" name="notes" rows="2" placeholder=""></textarea></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-lead">
          <i class="bi bi-check2"></i> Save Lead
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  var badgeMap = {'New':'badge-info','Qualified':'badge-pending','Proposal':'badge-info','Won':'badge-active','Lost':'badge-inactive'};

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/crm/leads', function(item){
      var bc = badgeMap[item.status] || 'badge-pending';
      var convertBtn = item.status !== 'Won' ? '<button class="btn-erp btn-success btn-xs btn-convert" data-id="'+item.id+'" title="Convert"><i class="bi bi-arrow-right-circle"></i></button>' : '';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.email||'')+'</td>'
        +'<td>'+(item.phone||'')+'</td>'
        +'<td>$'+Number(item.estimated_value||0).toLocaleString()+'</td>'
        +'<td>'+(item.source||'')+'</td>'
        +'<td><span class="badge-status '+bc+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1">'+convertBtn+'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalLead" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/crm/leads/'+item.id+'" data-delete-label="Lead" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-lead').on('click', function(){
    ErpApi.clearForm('#formLead');
    $('#modalLead .modal-title').text('Add Lead / Opportunity');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get('/crm/leads/'+id, function(res){
      if(res.success){
        ErpApi.populateForm('#formLead', res.data);
        $('#modalLead .modal-title').text('Edit Lead');
      }
    });
  });

  $('#btn-save-lead').on('click', function(){
    var data = ErpApi.collectForm('#formLead');
    var id = data.id;
    delete data.id;
    if(id){
      ErpApi.put('/crm/leads/'+id, data, function(res){
        if(res.success){
          showToast(res.message || 'Lead updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalLead')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/crm/leads', data, function(res){
        if(res.success){
          showToast(res.message || 'Lead created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalLead')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-convert', function(){
    var id = $(this).data('id');
    if(confirm('Convert this lead to a customer?')){
      ErpApi.post('/crm/leads/'+id+'/convert', {}, function(res){
        if(res.success){
          showToast(res.message || 'Lead converted', 'success');
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/crm/leads/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Lead deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
