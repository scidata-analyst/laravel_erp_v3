@extends('layouts.app')

@section('content')
<div class="page-header">
  <div><div class="page-title">System Settings</div><div class="page-subtitle">System configuration, preferences and integrations</div></div>
  <button class="btn-erp btn-primary btn-save-all"><i class="bi bi-check2"></i> Save All Settings</button>
</div>
<div class="row g-3">
  <div class="col-md-6">
    <div class="erp-card">
      <div class="card-header-bar"><div class="card-title">General</div></div>
      <div class="row g-3">
        <div class="col-12"><label class="erp-form-label">Company Name</label><input class="erp-form-control" name="company_name" value="NEXUS ERP Corp."/></div>
        <div class="col-md-6"><label class="erp-form-label">Base Currency</label><select class="erp-form-control" name="base_currency"><option>USD ($)</option><option>EUR (€)</option><option>BDT (৳)</option></select></div>
        <div class="col-md-6"><label class="erp-form-label">Fiscal Year Start</label><input class="erp-form-control" name="fiscal_year_start" type="month" value="2025-01"/></div>
        <div class="col-12"><label class="erp-form-label">Company Address</label><textarea class="erp-form-control" name="company_address" rows="2">123 Business Ave, Dhaka, Bangladesh</textarea></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="erp-card">
      <div class="card-header-bar"><div class="card-title">Security</div></div>
      <div class="row g-3">
        <div class="col-md-6"><label class="erp-form-label">Session Timeout</label><select class="erp-form-control" name="session_timeout"><option>30 minutes</option><option>1 hour</option><option>4 hours</option></select></div>
        <div class="col-md-6"><label class="erp-form-label">Two-Factor Auth</label><select class="erp-form-control" name="two_factor_auth"><option>Enabled</option><option>Disabled</option></select></div>
        <div class="col-12"><label class="erp-form-label">Password Policy</label><select class="erp-form-control" name="password_policy"><option>Strong (min 8, special chars)</option><option>Medium (min 6)</option></select></div>
        <div class="col-12"><label class="erp-form-label">IP Whitelist</label><input class="erp-form-control" name="ip_whitelist" placeholder="192.168.1.0/24, 10.0.0.0/8"/></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="erp-card">
      <div class="card-header-bar"><div class="card-title">Notifications</div></div>
      <div class="row g-3">
        <div class="col-12"><label class="erp-form-label">Email Notifications</label><select class="erp-form-control" name="email_notifications"><option>Enabled</option><option>Disabled</option></select></div>
        <div class="col-12"><label class="erp-form-label">Low Stock Threshold</label><input class="erp-form-control" name="low_stock_threshold" type="number" value="10"/></div>
        <div class="col-12"><label class="erp-form-label">Alert Recipients</label><input class="erp-form-control" name="alert_recipients" placeholder="admin@nexus.com, ops@nexus.com"/></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="erp-card">
      <div class="card-header-bar"><div class="card-title">Inventory</div></div>
      <div class="row g-3">
        <div class="col-md-6"><label class="erp-form-label">Default Valuation</label><select class="erp-form-control" name="default_valuation"><option>FIFO</option><option>LIFO</option><option>Average Cost</option></select></div>
        <div class="col-md-6"><label class="erp-form-label">Auto Reorder</label><select class="erp-form-control" name="auto_reorder"><option>Enabled</option><option>Disabled</option></select></div>
        <div class="col-12"><label class="erp-form-label">Default Warehouse</label><select class="erp-form-control" name="default_warehouse"><option>WH-A – Main Warehouse</option><option>WH-B – Secondary Depot</option></select></div>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
  window.loadTableData = function() {
    var keys = [
      'company_name','base_currency','fiscal_year_start','company_address',
      'session_timeout','two_factor_auth','password_policy','ip_whitelist',
      'email_notifications','low_stock_threshold','alert_recipients',
      'default_valuation','auto_reorder','default_warehouse'
    ];
    keys.forEach(function(key) {
      ErpApi.get('/settings/settings/' + key, function(res) {
        if (res.success && res.data) {
          var el = $('[name="'+key+'"]');
          if (el.is('select') || el.is('input') || el.is('textarea')) {
            el.val(res.data.value || '');
          }
        }
      });
    });
  };

  loadTableData();

  $('.btn-save-all').on('click', function() {
    var fields = {
      'company_name': $('[name="company_name"]').val(),
      'base_currency': $('[name="base_currency"]').val(),
      'fiscal_year_start': $('[name="fiscal_year_start"]').val(),
      'company_address': $('[name="company_address"]').val(),
      'session_timeout': $('[name="session_timeout"]').val(),
      'two_factor_auth': $('[name="two_factor_auth"]').val(),
      'password_policy': $('[name="password_policy"]').val(),
      'ip_whitelist': $('[name="ip_whitelist"]').val(),
      'email_notifications': $('[name="email_notifications"]').val(),
      'low_stock_threshold': $('[name="low_stock_threshold"]').val(),
      'alert_recipients': $('[name="alert_recipients"]').val(),
      'default_valuation': $('[name="default_valuation"]').val(),
      'auto_reorder': $('[name="auto_reorder"]').val(),
      'default_warehouse': $('[name="default_warehouse"]').val()
    };
    var total = Object.keys(fields).length;
    var saved = 0;
    var failed = false;
    Object.keys(fields).forEach(function(key) {
      ErpApi.post('/settings/settings', { key: key, value: fields[key] }, function(res) {
        saved++;
        if (!res.success) failed = true;
        if (saved === total) {
          if (failed) showToast('Some settings failed to save', 'error');
          else showToast('All settings saved', 'success');
        }
      });
    });
  });
});
</script>
@endsection
