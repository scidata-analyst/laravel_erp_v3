@extends('layouts.app')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Accounts Payable / Receivable</div>
    <div class="page-subtitle">Manage AP and AR balances</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalAPAR" id="btnAddAPAR"><i class="bi bi-plus-lg"></i> New Transaction</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search accounts payable / receivable…"/>
    </div>
    <select class="erp-form-control" name="type" style="width:140px"><option>All Status</option><option>Payable</option><option>Receivable</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>Party</th><th>Type</th><th>Amount</th><th>Due Date</th><th>Status</th><th>Reference</th><th>Actions</th></tr></thead>
      <tbody id="tbl-apar-body"></tbody>
    </table>
  </div>
  <div class="erp-pagination">
    <button class="pg-btn active">1</button>
    <button class="pg-btn">2</button>
    <button class="pg-btn"><i class="bi bi-chevron-right"></i></button>
  </div>
</div>

<div class="modal fade" id="modalAPAR" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New AP/AR Transaction</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="id" value=""/>
        <div class="row g-3">
          <div class="col-md-6"><label class="erp-form-label">Party Name</label><input class="erp-form-control" type="text" name="party_name" placeholder=""/></div>
          <div class="col-md-6"><label class="erp-form-label">Type</label><select class="erp-form-control" name="type"><option>Payable</option><option>Receivable</option></select></div>
          <div class="col-md-4"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control" type="number" name="amount" placeholder="" step="0.01"/></div>
          <div class="col-md-4"><label class="erp-form-label">Due Date</label><input class="erp-form-control" type="date" name="due_date" placeholder=""/></div>
          <div class="col-md-4"><label class="erp-form-label">Status</label><select class="erp-form-control" name="status"><option>Pending</option><option>Partial</option><option>Paid</option><option>Overdue</option></select></div>
          <div class="col-md-12"><label class="erp-form-label">Reference</label><input class="erp-form-control" type="text" name="reference" placeholder="Invoice/PO ref"/></div>
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

<div class="modal fade" id="modalBalance" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Party Balance</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-8"><label class="erp-form-label">Party Name</label><input class="erp-form-control" type="text" id="balancePartyName" placeholder="Enter party name"/></div>
          <div class="col-md-4 d-flex align-items-end"><button class="btn-erp btn-primary" id="btnLookupBalance"><i class="bi bi-search"></i> Lookup</button></div>
        </div>
        <div id="balanceResult" class="mt-3" style="display:none">
          <div class="stat-card">
            <div class="stat-label">Outstanding Balance</div>
            <div class="stat-value" id="balanceAmount">$0</div>
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
    var map = {'Pending':'badge-pending','Paid':'badge-active','Partial':'badge-pending','Overdue':'badge-inactive'};
    return '<span class="badge-status '+(map[status]||'badge-info')+'">'+status+'</span>';
  }

  function typeBadge(type) {
    return '<span class="badge-status '+(type==='Payable'?'badge-inactive':'badge-active')+'">'+type+'</span>';
  }

  function renderRow(item) {
    return '<tr data-id="'+item.id+'">'
      +'<td>'+item.party_name+'</td>'
      +'<td>'+typeBadge(item.type)+'</td>'
      +'<td>$'+Number(item.amount||0).toLocaleString()+'</td>'
      +'<td>'+item.due_date+'</td>'
      +'<td>'+statusBadge(item.status)+'</td>'
      +'<td>'+(item.reference||'—')+'</td>'
      +'<td><div class="d-flex gap-1">'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-balance-lookup" data-party="'+item.party_name+'" title="Balance"><i class="bi bi-currency-dollar"></i></button>'
      +'<button class="btn-erp btn-outline btn-xs btn-icon btn-edit-apar" data-id="'+item.id+'" title="Edit"><i class="bi bi-pencil"></i></button>'
      +'<button class="btn-erp btn-danger btn-xs btn-icon" data-delete-url="/accounting/ap-ar/'+item.id+'" data-delete-label="Transaction" title="Delete"><i class="bi bi-trash"></i></button>'
      +'</div></td></tr>';
  }

  function loadTableData() {
    ErpApi.loadTable('/accounting/ap-ar', '#tbl-apar-body', renderRow, 'No transactions found');
  }

  loadTableData();

  $('#btnAddAPAR').on('click', function(){
    ErpApi.clearForm('#modalAPAR');
    $('#modalAPAR .modal-title').text('New AP/AR Transaction');
  });

  $(document).on('click', '.btn-edit-apar', function(){
    var id = $(this).data('id');
    ErpApi.get('/accounting/ap-ar/'+id, {
      success: function(res){
        ErpApi.populateForm('#modalAPAR', res.data);
        $('#modalAPAR [name="id"]').val(id);
        $('#modalAPAR .modal-title').text('Edit Transaction');
        new bootstrap.Modal(document.getElementById('modalAPAR')).show();
      }
    });
  });

  $('#modalAPAR .btn-modal-save').on('click', function(){
    var data = ErpApi.collectForm('#modalAPAR');
    var id = data.id;
    delete data.id;
    if (id) {
      ErpApi.put('/accounting/ap-ar/' + id, data, {
        success: function(res){ showToast(res.message || 'Transaction updated','success'); bootstrap.Modal.getInstance(document.getElementById('modalAPAR')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to update transaction','danger'); }
      });
    } else {
      ErpApi.post('/accounting/ap-ar', data, {
        success: function(res){ showToast(res.message || 'Transaction saved','success'); bootstrap.Modal.getInstance(document.getElementById('modalAPAR')).hide(); loadTableData(); },
        error: function(){ showToast('Failed to save transaction','danger'); }
      });
    }
  });

  $(document).on('click', '.btn-balance-lookup', function(){
    var party = $(this).data('party');
    $('#balancePartyName').val(party);
    $('#balanceResult').hide();
    new bootstrap.Modal(document.getElementById('modalBalance')).show();
    if(party) $('#btnLookupBalance').trigger('click');
  });

  $('#btnLookupBalance').on('click', function(){
    var party = $('#balancePartyName').val();
    if(!party) return;
    ErpApi.get('/accounting/ap-ar/balance/'+encodeURIComponent(party), {
      success: function(res){
        $('#balanceAmount').text('$'+Number(res.data.balance||0).toLocaleString());
        $('#balanceResult').show();
      },
      error: function(){ showToast('Failed to lookup balance','danger'); }
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
