@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Tax & Compliance</div>
    <div class="page-subtitle">Configure tax rules, filing periods and compliance tracking</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-outline" id="btnCalcTax"><i class="bi bi-calculator"></i> Calculate Tax</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalTax" id="btnAddTax"><i class="bi bi-plus-lg"></i> New Tax Rule</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search tax & compliance…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>VAT</option><option>Sales Tax</option><option>Withholding</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Tax Name</th><th>Type</th><th>Rate</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody id="tbl-tax-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalTax" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Tax Rule</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Tax Name</label><input class="erp-form-control" type="text" name="name" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Tax Type</label><select class="erp-form-control" name="type"><option>VAT</option><option>Sales Tax</option><option>Withholding</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Rate (%)</label><input class="erp-form-control" type="number" name="rate" placeholder="" step="0.01"/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Active</option><option>Inactive</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Save Tax Rule
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTaxCalc" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Tax Calculator</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" type="number" id="calcAmount" placeholder="" step="0.01"/></div>
          <div class="col-md-6"><label class="erp-form-label">Tax Rate (%)</label><input class="erp-form-control" type="number" id="calcRate" placeholder="" step="0.01"/></div>
          <div class="col-md-12 d-flex align-items-end"><button class="btn-erp btn-primary" id="btnDoCalc"><i class="bi bi-calculator"></i> Calculate</button></div>
        </div>
        <div id="calcResult" class="mt-3" style="display:none">
          <div class="stat-card">
            <div class="stat-label">Tax Amount</div>
            <div class="stat-value" id="calcTaxAmount">$0</div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  function statusBadge(status) {
    return '<span class="badge-status '+(status==='Active'?'badge-active':'badge-inactive')+'">'+status+'</span>';
  }

  function renderRow(item) {
    return '<tr data-id="'+item.id+'">'
      +'<td>'+item.name+'</td>'
      +'<td>'+item.type+'</td>'
      +'<td>'+Number(item.rate||0).toFixed(2)+'%</td>'
      +'<td>'+(item.description||'—')+'</td>'
      +'<td>'+statusBadge(item.status)+'</td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-tax" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/accounting/tax/'+item.id+'" data-delete-label="Tax Rule" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/accounting/tax', '#tbl-tax-body', renderRow, 'No tax rules found');
  }

  loadTableData();

  $('#btnAddTax').on('click', function(){
    ErpApi.clearForm('#modalTax');
    $('#modalTax .modal-title').text('New Tax Rule');
  });

  $(document).on('click', '.btn-edit-tax', function(){
    var id = $(this).data('id');
    ErpApi.get('/accounting/tax/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalTax', res.data);
        $('#modalTax [name="id"]').val(id);
        $('#modalTax .modal-title').text('Edit Tax Rule');
        new bootstrap.Modal(document.getElementById('modalTax')).show();
      }
    });
  });

  $('#modalTax .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalTax');
    var id = data.id;
    delete data.id;
    if (id) {
      ErpApi.put('/accounting/tax/' + id, data, {
        success: function(res){ showToast(res.message || 'Tax rule updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalTax')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to update tax rule','danger'); }
      });
    } else {
      ErpApi.post('/accounting/tax', data, {
        success: function(res){ showToast(res.message || 'Tax rule saved','success'); bootstrap.Modal.getInstance(document.getElementById('modalTax')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to save tax rule','danger'); }
      });
    }
  });

  $('#btnCalcTax').on('click', function(){
    $('#calcAmount').val('');
    $('#calcRate').val('');
    $('#calcResult').hide();
    new bootstrap.Modal(document.getElementById('modalTaxCalc')).show();
  });

  $('#btnDoCalc').on('click', function(){
    var amount = parseFloat($('#calcAmount').val()) || 0;
    var rate = parseFloat($('#calcRate').val()) || 0;
    ErpApi.post('/accounting/tax/calculate', {amount: amount, rate: rate}, {
      success: function(res){
        $('#calcTaxAmount').text('$'+Number(res.data.tax_amount||0).toLocaleString());
        $('#calcResult').show();
      },
      error: function(){ showToast('Failed to calculate tax','danger'); }
    });
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
