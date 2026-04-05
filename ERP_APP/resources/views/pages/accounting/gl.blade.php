@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">General Ledger</div>
    <div class="page-subtitle">Chart of accounts and journal entries</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-outline" id="btnTrialBalance"><i class="bi bi-calculator"></i> Trial Balance</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalGL" id="btnAddGL"><i class="bi bi-plus-lg"></i> New Entry</button>
  </div>
</div>

<div class="erp-card mb-3" id="stats-cards" style="display:none">
  <div class="row g-3">
    <div class="col-md-3"><div class="stat-card"><div class="stat-label">Total Entries</div><div class="stat-value" id="stat-entries">0</div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-label">Total Debits</div><div class="stat-value" id="stat-debits">$0</div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-label">Total Credits</div><div class="stat-value" id="stat-credits">$0</div></div></div>
    <div class="col-md-3"><div class="stat-card"><div class="stat-label">Balance</div><div class="stat-value" id="stat-balance">$0</div></div></div>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search general ledger…"/>
    </div>
    <select class="erp-form-control" name="account_type" style="width:140px"><option>All Status</option><option>Assets</option><option>Liabilities</option><option>Equity</option><option>Revenue</option><option>Expense</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Account Name</th><th>Entry Date</th><th>Description</th><th>Debit</th><th>Credit</th><th>Reference</th><th>Actions</th></tr></thead>
      <tbody id="tbl-gl-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalGL" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Journal Entry</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Account Name</label><input class="erp-form-control" type="text" name="account_name" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Entry Date</label><input class="erp-form-control" type="date" name="entry_date" placeholder=""/></div>
          <div class="col-md-3"><label class="erp-form-label">Debit ($)</label><input class="erp-form-control" type="number" name="debit" placeholder="" step="0.01"/></div>
          <div class="col-md-3"><label class="erp-form-label">Credit ($)</label><input class="erp-form-control" type="number" name="credit" placeholder="" step="0.01"/></div>
          <div class="col-md-6"><label class="erp-form-label">Reference</label><input class="erp-form-control" type="text" name="reference" placeholder=""/></div>
          <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control" name="description" rows="2" placeholder=""></textarea></div>
        </div>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save">
          <i class="bi bi-check2"></i> Post Entry
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalTrialBalance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Trial Balance</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="erp-table-wrap">
          <table class="erp-table">
            <thead><tr><th>Account</th><th>Debit</th><th>Credit</th></tr></thead>
            <tbody id="tbl-trial-balance-body"></tbody>
          </table>
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
  function renderRow(item) {
    return '<tr data-id="'+item.id+'">'
      +'<td>'+item.account_name+'</td>'
      +'<td>'+item.entry_date+'</td>'
      +'<td>'+(item.description||'—')+'</td>'
      +'<td>$'+Number(item.debit||0).toLocaleString()+'</td>'
      +'<td>$'+Number(item.credit||0).toLocaleString()+'</td>'
      +'<td>'+(item.reference||'—')+'</td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-gl" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/accounting/gl/'+item.id+'" data-delete-label="Entry" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/accounting/gl', '#tbl-gl-body', renderRow, 'No entries found');
  }

  function loadStats() {
    ErpApi.get('/accounting/gl/stats', {
      success: function(res){
        if(res.data) {
          $('#stats-cards').show();
          $('#stat-entries').text(res.data.total_entries || 0);
          $('#stat-debits').text('$'+Number(res.data.total_debits||0).toLocaleString());
          $('#stat-credits').text('$'+Number(res.data.total_credits||0).toLocaleString());
          $('#stat-balance').text('$'+Number(res.data.balance||0).toLocaleString());
        }
      }
    });
  }

  loadTableData();
  loadStats();

  $('#btnAddGL').on('click', function(){
    ErpApi.clearForm('#modalGL');
    $('#modalGL .modal-title').text('New Journal Entry');
  });

  $(document).on('click', '.btn-edit-gl', function(){
    var id = $(this).data('id');
    ErpApi.get('/accounting/gl/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalGL', res.data);
        $('#modalGL [name="id"]').val(id);
        $('#modalGL .modal-title').text('Edit Journal Entry');
        new bootstrap.Modal(document.getElementById('modalGL')).show();
      }
    });
  });

  $('#modalGL .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalGL');
    var id = data.id;
    delete data.id;
    if (id) {
      ErpApi.put('/accounting/gl/' + id, data, {
        success: function(res){ showToast(res.message || 'Entry updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalGL')).hide(); loadTableData(); loadStats(); },
        error: function(){ showToast('Failed to update entry','danger'); }
      });
    } else {
      ErpApi.post('/accounting/gl', data, {
        success: function(res){ showToast(res.message || 'Entry posted','success'); bootstrap.Modal.getInstance(document.getElementById('modalGL')).hide(); loadTableData(); loadStats(); },
        error: function(){ showToast('Failed to post entry','danger'); }
      });
    }
  });

  $('#btnTrialBalance').on('click', function(){
    ErpApi.get('/accounting/gl/trial-balance', {
      success: function(res){
        var rows = res.data || [];
        var html = '';
        rows.forEach(function(r){
          html += '<tr><td>'+r.account_name+'</td><td>$'+Number(r.debit||0).toLocaleString()+'</td><td>$'+Number(r.credit||0).toLocaleString()+'</td></tr>';
        });
        if(!html) html = '<tr><td colspan="3" class="text-center">No data</td></tr>';
        $('#tbl-trial-balance-body').html(html);
        new bootstrap.Modal(document.getElementById('modalTrialBalance')).show();
      }
    });
  });

  $(document).on('click', '[data-delete-url]', function(){
    var url = $(this).data('delete-url');
    var label = $(this).data('delete-label') || 'Item';
    if(confirm('Are you sure you want to delete this '+label+'?')) {
      ErpApi.del(url, {
        success: function(res){ showToast(res.message || label+' deleted','success'); loadTableData(); loadStats(); },
        error: function(){ showToast('Failed to delete '+label,'danger'); }
      });
    }
  });
});
</script>
@endsection
