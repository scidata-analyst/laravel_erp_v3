@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Bill of Materials</div>
    <div class="page-subtitle">Define bill of materials for manufactured products</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBOM" id="btn-add-bom"><i class="bi bi-plus-lg"></i> New BOM</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search bill of materials…" />
    </div>
    <select class="erp-form-control" name="status" style="width:140px">
      <option>All Status</option>
      <option>Active</option>
      <option>Draft</option>
      <option>Archived</option>
    </select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead>
        <tr>
          <th>BOM #</th>
          <th>Product</th>
          <th>Version</th>
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

<div class="modal fade" id="modalBOM" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content"
      style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Bill of Materials</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formBOM">
          <input type="hidden" name="id" id="bom-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product ID</label><input class="erp-form-control"
                name="product_id" type="text" placeholder="Product ID" /></div>
            <div class="col-md-3"><label class="erp-form-label">BOM Name</label><input class="erp-form-control"
                name="name" type="text" placeholder="BOM name" /></div>
            <div class="col-md-3"><label class="erp-form-label">Version</label><input class="erp-form-control"
                name="version" type="text" placeholder="v1.0" /></div>
            <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status">
                <option>Active</option>
                <option>Draft</option>
                <option>Archived</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Components
                <div class="erp-table-wrap mt-1">
                  <table class="erp-table">
                    <thead>
                      <tr>
                        <th>Component</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input class="erp-form-control" name="components[0][name]" placeholder="Component name" /></td>
                        <td><input class="erp-form-control" name="components[0][qty]" type="number" style="width:70px" /></td>
                        <td><select class="erp-form-control" name="components[0][unit]">
                            <option>pcs</option>
                            <option>kg</option>
                            <option>m</option>
                          </select></td>
                        <td><input class="erp-form-control" name="components[0][cost]" type="number" style="width:90px" placeholder="$0.00" /></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <button class="btn-erp btn-outline btn-sm mt-2" type="button"><i class="bi bi-plus"></i> Add Component</button>
              </label></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-bom">
          <i class="bi bi-check2"></i> Save BOM
        </button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  var badgeMap = {'Active':'badge-active','Draft':'badge-info','Archived':'badge-inactive'};

  function loadTableData(){
    ErpApi.loadTable('#tbl-main', '/production/bom', function(item){
      var bc = badgeMap[item.status] || 'badge-pending';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.bom_number || 'BOM-'+item.id)+'</td>'
        +'<td>'+(item.name||'')+'</td>'
        +'<td>'+(item.version||'')+'</td>'
        +'<td><span class="badge-status '+bc+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalBOM" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/production/bom/'+item.id+'" data-delete-label="BOM" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-bom').on('click', function(){
    ErpApi.clearForm('#formBOM');
    $('#modalBOM .modal-title').text('New Bill of Materials');
  });

  $(document).on('click', '.btn-edit', function(){
    var id = $(this).data('id');
    ErpApi.get('/production/bom/'+id, function(res){
      if(res.success){
        ErpApi.populateForm('#formBOM', res.data);
        $('#modalBOM .modal-title').text('Edit Bill of Materials');
      }
    });
  });

  $('#btn-save-bom').on('click', function(){
    var data = ErpApi.collectForm('#formBOM');
    var id = data.id;
    delete data.id;
    if(id){
      ErpApi.put('/production/bom/'+id, data, function(res){
        if(res.success){
          showToast(res.message || 'BOM updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalBOM')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/production/bom', data, function(res){
        if(res.success){
          showToast(res.message || 'BOM created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalBOM')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/production/bom/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'BOM deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
