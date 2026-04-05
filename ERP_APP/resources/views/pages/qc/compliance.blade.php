@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Compliance Reports</div>
    <div class="page-subtitle">Regulatory compliance reports and certification tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalCompliance"><i class="bi bi-plus-lg"></i> New Report</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search compliance reports…"/>
    </div>
    <select class="erp-form-control" name="status" style="width:140px"><option>All Status</option><option>Compliant</option><option>Non-Compliant</option><option>Pending</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Standard Name</th><th>Version</th><th>Status</th><th>Audit Date</th><th>Expiry Date</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalCompliance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Compliance Report</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="edit-id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Standard Name</label><input class="erp-form-control" name="standard_name" type="text" placeholder="e.g. ISO 9001:2015"/></div>
          <div class="col-md-6"><label class="erp-form-label">Version</label><input class="erp-form-control" name="version" type="text" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Compliant</option><option>Non-Compliant</option><option>Pending</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Audit Date</label><input class="erp-form-control" name="audit_date" type="date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Expiry Date</label><input class="erp-form-control" name="expiry_date" type="date" placeholder=""/></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save
        </button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  var baseUrl = '/qc/compliance';

  window.loadTableData = function() {
    ErpApi.loadTable(baseUrl, '#tbl-main tbody', function(item) {
      var badge = item.status==='Compliant'?'badge-active':(item.status==='Non-Compliant'?'badge-inactive':'badge-pending');
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.standard_name||'')+'</td>'
        +'<td>'+(item.version||'')+'</td>'
        +'<td><span class="badge-status '+badge+'">'+(item.status||'')+'</span></td>'
        +'<td>'+(item.audit_date||'—')+'</td>'
        +'<td>'+(item.expiry_date||'—')+'</td>'
        +'<td><div class="d-flex gap-1">'
        +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
        +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Compliance" title="Delete"><i class="bi bi-trash"></i></button>'
        +'</div></td></tr>';
    });
  };

  loadTableData();

  $('#modalCompliance').on('show.bs.modal', function(){
    if (!$('#edit-id').val()) {
      ErpApi.clearForm('#modalCompliance');
    }
  });

  $('#modalCompliance').on('hidden.bs.modal', function(){
    $('#edit-id').val('');
    ErpApi.clearForm('#modalCompliance');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get(baseUrl+'/'+id).then(function(res){
      if(res.success){
        $('#edit-id').val(id);
        ErpApi.populateForm('#modalCompliance', res.data);
        new bootstrap.Modal($('#modalCompliance')[0]).show();
      }
    });
  });

  $('#modalCompliance .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalCompliance');
    var id = $('#edit-id').val();
    if(id){
      ErpApi.put(baseUrl+'/'+id, data).then(function(res){
        if(res.success){ showToast(res.message||'Compliance updated','success'); bootstrap.Modal.getInstance($('#modalCompliance')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Update failed','error'); }
      });
    } else {
      ErpApi.post(baseUrl, data).then(function(res){
        if(res.success){ showToast(res.message||'Compliance created','success'); bootstrap.Modal.getInstance($('#modalCompliance')[0]).hide(); loadTableData(); }
        else{ showToast(res.message||'Save failed','error'); }
      });
    }
  });

  $(document).on('click', '.btn-load-active', function(){
    ErpApi.get(baseUrl+'/active').then(function(res){
      if(res.success){
        var data = res.data.data || res.data;
        var items = Array.isArray(data) ? data : [data];
        var tbody = $('#tbl-main tbody').empty();
        items.forEach(function(item){
          var badge = item.status==='Compliant'?'badge-active':(item.status==='Non-Compliant'?'badge-inactive':'badge-pending');
          tbody.append('<tr data-id="'+item.id+'">'
            +'<td>'+(item.standard_name||'')+'</td>'
            +'<td>'+(item.version||'')+'</td>'
            +'<td><span class="badge-status '+badge+'">'+(item.status||'')+'</span></td>'
            +'<td>'+(item.audit_date||'—')+'</td>'
            +'<td>'+(item.expiry_date||'—')+'</td>'
            +'<td><div class="d-flex gap-1">'
            +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
            +'<button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete" data-delete-url="'+baseUrl+'/'+item.id+'" data-delete-label="Compliance" title="Delete"><i class="bi bi-trash"></i></button>'
            +'</div></td></tr>');
        });
      }
    });
  });
});
</script>
@endsection
