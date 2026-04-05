@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Performance Tracking</div>
    <div class="page-subtitle">Employee KPI tracking and performance review cycles</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPerformance" id="btn-add-performance"><i class="bi bi-plus-lg"></i> New Review</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search performance tracking…"/>
    </div>
    <select class="erp-form-control" name="rating" style="width:140px"><option>All Status</option><option>Excellent</option><option>Good</option><option>Satisfactory</option><option>Poor</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Employee</th><th>Review Date</th><th>Reviewer</th><th>Rating</th><th>Comments</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalPerformance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Performance Review</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formPerformance">
          <input type="hidden" name="id" id="perf-id"/>
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Employee ID</label><input class="erp-form-control" name="employee_id" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Review Date</label><input class="erp-form-control" name="review_date" type="date" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Reviewer</label><input class="erp-form-control" name="reviewer" type="text" placeholder=""/></div>
            <div class="col-md-6"><label class="erp-form-label">Rating</label><select class="erp-form-control" name="rating"><option>Excellent</option><option>Good</option><option>Satisfactory</option><option>Poor</option></select></div>
            <div class="col-md-12"><label class="erp-form-label">Comments</label><textarea class="erp-form-control" name="comments" rows="3" placeholder=""></textarea></div>
            <div class="col-md-6"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Completed</option><option>In Review</option><option>Pending</option></select></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save-performance">
          <i class="bi bi-check2"></i> Save Review
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
    ErpApi.loadTable('#tbl-main', '/hr/performance', function(item){
      var badgeClass = item.status === 'Completed' ? 'badge-active' : 'badge-pending';
      return '<tr data-id="'+item.id+'">'
        +'<td>'+(item.employee_name || item.employee_id ||'')+'</td>'
        +'<td>'+(item.review_date||'')+'</td>'
        +'<td>'+(item.reviewer||'')+'</td>'
        +'<td>'+(item.rating||'')+'</td>'
        +'<td>'+(item.comments||'')+'</td>'
        +'<td><span class="badge-status '+badgeClass+'">'+(item.status||'')+'</span></td>'
        +'<td><div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" data-id="'+item.id+'" data-bs-toggle="modal" data-bs-target="#modalPerformance" title="Edit"><i class="bi bi-pencil"></i></button><button class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="'+item.id+'" data-delete-url="/hr/performance/'+item.id+'" data-delete-label="Review" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Delete"><i class="bi bi-trash"></i></button></div></td>'
        +'</tr>';
    });
  }

  loadTableData();

  $('#btn-add-performance').on('click', function(){
    editId = null;
    ErpApi.clearForm('#formPerformance');
    $('#modalPerformance .modal-title').text('New Performance Review');
  });

  $(document).on('click', '.btn-edit', function(){
    editId = $(this).data('id');
    ErpApi.get('/hr/performance/'+editId, function(res){
      if(res.success){
        ErpApi.populateForm('#formPerformance', res.data);
        $('#modalPerformance .modal-title').text('Edit Performance Review');
      }
    });
  });

  $('#btn-save-performance').on('click', function(){
    var data = ErpApi.collectForm('#formPerformance');
    if(editId){
      ErpApi.put('/hr/performance/'+editId, data, function(res){
        if(res.success){
          showToast(res.message || 'Review updated', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalPerformance')).hide();
          loadTableData();
        }
      });
    } else {
      ErpApi.post('/hr/performance', data, function(res){
        if(res.success){
          showToast(res.message || 'Review created', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalPerformance')).hide();
          loadTableData();
        }
      });
    }
  });

  $(document).on('click', '.btn-delete', function(){
    var id = $(this).data('id');
    $('#modalDelete').data('delete-url', '/hr/performance/'+id);
  });

  $(document).on('click', '#modalDelete .btn-danger, #modalDelete .btn-modal-delete', function(){
    var url = $('#modalDelete').data('delete-url');
    if(url){
      ErpApi.del(url, function(res){
        if(res.success){
          showToast(res.message || 'Review deleted', 'success');
          bootstrap.Modal.getInstance(document.getElementById('modalDelete')).hide();
          loadTableData();
        }
      });
    }
  });
});
</script>
@endpush
