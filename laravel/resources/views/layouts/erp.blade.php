<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'NEXUS ERP') — NEXUS ERP</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset("erp-styles.css") }}"/>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  @stack('head')
</head>
<body>

<nav id="sidebar">
  <div class="sidebar-logo">
    <div class="logo-icon">⬡</div>
    <div class="logo-text">NEX<span>US</span> ERP</div>
  </div>
  <div class="sidebar-nav">

    <div class="nav-section-label">Core</div>
    <div class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}" data-page="dashboard"><span class="nav-icon"><i class="bi bi-grid-1x2"></i></span><span>Dashboard</span></a></div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-people"></i></span><span>Users &amp; Roles</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('user') }}" data-page="users"><span>Users</span></a>
        <a class="nav-submenu-link" href="{{ route('roles') }}" data-page="roles"><span>Roles &amp; Permissions</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-box-seam"></i></span><span>Inventory</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('product_catalog') }}" data-page="products"><span>Product Catalog</span></a>
        <a class="nav-submenu-link" href="{{ route('stock_movements') }}" data-page="stock-movements"><span>Stock In/Out</span></a>
        <a class="nav-submenu-link" href="{{ route('batch_tracking') }}" data-page="batch-tracking"><span>Batch / Expiry</span></a>
        <a class="nav-submenu-link" href="{{ route('stock_valuation') }}" data-page="stock-valuation"><span>Stock Valuation</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-cart3"></i></span><span>Purchase</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('suppliers') }}" data-page="suppliers"><span>Suppliers</span></a>
        <a class="nav-submenu-link" href="{{ route('purchase_orders') }}" data-page="purchase-orders"><span>Purchase Orders</span></a>
        <a class="nav-submenu-link" href="{{ route('grn') }}" data-page="grn"><span>GRN</span></a>
        <a class="nav-submenu-link" href="{{ route('supplier_payments') }}" data-page="supplier-payments"><span>Payments</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-bag-check"></i></span><span>Sales</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('customers') }}" data-page="customers"><span>Customers</span></a>
        <a class="nav-submenu-link" href="{{ route('sales_orders') }}" data-page="sales-orders"><span>Sales Orders</span></a>
        <a class="nav-submenu-link" href="{{ route('invoices') }}" data-page="invoices"><span>Invoices</span></a>
        <a class="nav-submenu-link" href="{{ route('promotions') }}" data-page="promotions"><span>Discounts &amp; Promos</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-journal-text"></i></span><span>Accounting</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('gl') }}" data-page="gl"><span>General Ledger</span></a>
        <a class="nav-submenu-link" href="{{ route('ap_ar') }}" data-page="ap-ar"><span>AP / AR</span></a>
        <a class="nav-submenu-link" href="{{ route('tax') }}" data-page="tax"><span>Tax &amp; Compliance</span></a>
        <a class="nav-submenu-link" href="{{ route('fin_reports') }}" data-page="fin-reports"><span>Financial Reports</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-person-badge"></i></span><span>Human Resources</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('employees') }}" data-page="employees"><span>Employees</span></a>
        <a class="nav-submenu-link" href="{{ route('attendance') }}" data-page="attendance"><span>Attendance &amp; Leave</span></a>
        <a class="nav-submenu-link" href="{{ route('payroll') }}" data-page="payroll"><span>Payroll</span></a>
        <a class="nav-submenu-link" href="{{ route('performance') }}" data-page="performance"><span>Performance</span></a>
      </div>
    </div>

    <div class="nav-section-label">Enterprise</div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-gear"></i></span><span>Production</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('bom') }}" data-page="bom"><span>Bill of Materials</span></a>
        <a class="nav-submenu-link" href="{{ route('work_orders') }}" data-page="work-orders"><span>Work Orders</span></a>
        <a class="nav-submenu-link" href="{{ route('machine_labor') }}" data-page="machine-labor"><span>Machine &amp; Labor</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-handshake"></i></span><span>CRM</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('leads') }}" data-page="leads"><span>Leads &amp; Opportunities</span></a>
        <a class="nav-submenu-link" href="{{ route('support') }}" data-page="support"><span>Customer Support</span></a>
        <a class="nav-submenu-link" href="{{ route('interactions') }}" data-page="interactions"><span>Interactions</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-kanban"></i></span><span>Projects</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('tasks') }}" data-page="tasks"><span>Tasks &amp; Milestones</span></a>
        <a class="nav-submenu-link" href="{{ route('resources') }}" data-page="resources"><span>Resource Allocation</span></a>
        <a class="nav-submenu-link" href="{{ route('project_cost') }}" data-page="project-cost"><span>Cost Tracking</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-truck"></i></span><span>Warehouse &amp; Logistics</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('warehouses') }}" data-page="warehouses"><span>Multi-Warehouse</span></a>
        <a class="nav-submenu-link" href="{{ route('shipments') }}" data-page="shipments"><span>Shipments</span></a>
        <a class="nav-submenu-link" href="{{ route('routes') }}" data-page="routes"><span>Routes &amp; Delivery</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-shield-check"></i></span><span>Quality Control</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('qc_checklists') }}" data-page="qc-checklists"><span>QC Checklists</span></a>
        <a class="nav-submenu-link" href="{{ route('defects') }}" data-page="defects"><span>Defect Tracking</span></a>
        <a class="nav-submenu-link" href="{{ route('compliance') }}" data-page="compliance"><span>Compliance Reports</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-shop"></i></span><span>E-Commerce / POS</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('online_channels') }}" data-page="online-channels"><span>Sales Channels</span></a>
        <a class="nav-submenu-link" href="{{ route('pos') }}" data-page="pos"><span>POS Terminals</span></a>
        <a class="nav-submenu-link" href="{{ route('inv_sync') }}" data-page="inv-sync"><span>Inventory Sync</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span><span>Reports &amp; BI</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('custom_reports') }}" data-page="custom-reports"><span>Custom Reports</span></a>
        <a class="nav-submenu-link" href="{{ route('forecasting') }}" data-page="forecasting"><span>Forecasting</span></a>
        <a class="nav-submenu-link" href="{{ route('bi_dashboards') }}" data-page="bi-dashboards"><span>BI Dashboards</span></a>
      </div>
    </div>

    <div class="nav-item">
      <button class="nav-link nav-toggle">
        <span class="nav-icon"><i class="bi bi-folder2-open"></i></span><span>Documents</span>
        <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
      </button>
      <div class="nav-submenu">
        <a class="nav-submenu-link" href="{{ route('doc_library') }}" data-page="doc-library"><span>Document Library</span></a>
        <a class="nav-submenu-link" href="{{ route('doc_versions') }}" data-page="doc-versions"><span>Version Control</span></a>
      </div>
    </div>

    <div class="nav-item">
      <a class="nav-link" href="{{ route('settings') }}" data-page="settings">
        <span class="nav-icon"><i class="bi bi-sliders"></i></span><span>Settings</span>
      </a>
    </div>

  </div>
</nav>

<header id="header">
  <button class="btn-erp btn-outline btn-icon" id="btn-sidebar-toggle" style="margin-right:4px;">
    <i class="bi bi-list"></i>
  </button>
  <div class="breadcrumb-trail">
    <i class="bi bi-grid-1x2" style="color:var(--accent)"></i>
    <span class="sep">/</span>
    <span id="breadcrumb-current">@yield('breadcrumb', 'Dashboard')</span>
  </div>
  <div class="header-search">
    <span class="search-icon"><i class="bi bi-search"></i></span>
    <input type="text" placeholder="Search modules, records…"/>
  </div>
  <div class="header-actions">
    <button class="header-btn" title="Notifications">
      <i class="bi bi-bell"></i>
      <span class="notif-badge">5</span>
    </button>
    <a class="header-btn" href="{{ route('settings') }}" title="Settings">
      <i class="bi bi-sliders"></i>
    </a>
    <div class="user-avatar" title="Admin User">AD</div>
  </div>
</header>

<main id="main">
  @yield('content')
</main>

<div class="toast-container" id="toast-container"></div>
<script>
$(function () {
  $('#btn-sidebar-toggle').on('click', function () {
    $('#sidebar').toggleClass('collapsed');
  });

  $(document).on('click', '.nav-toggle', function () {
    var $sub = $(this).next('.nav-submenu');
    var isOpen = $sub.hasClass('open');
    $('.nav-submenu.open').removeClass('open').prev().removeClass('open');
    if (!isOpen) { $sub.addClass('open'); $(this).addClass('open'); }
  });

  $(document).on('input', '.tbl-search', function () {
    var q = $(this).val().toLowerCase();
    var $tbl = $($(this).data('table'));
    $tbl.find('tbody tr').each(function () {
      $(this).toggle($(this).text().toLowerCase().includes(q));
    });
  });

  $(document).on('click', '.pg-btn', function () {
    $(this).closest('.erp-pagination').find('.pg-btn').removeClass('active');
    $(this).addClass('active');
  });

  $(document).on('click', '.btn-modal-save', function () {
    var $modal = $(this).closest('.modal');
    bootstrap.Modal.getInstance($modal[0]).hide();
    showToast('Record saved successfully', 'success');
  });

  $('#modalDelete').on('show.bs.modal', function (e) {
    var label = $(e.relatedTarget).data('delete-label') || 'record';
    $(this).find('#delete-target').text(label);
  });

  $('#btn-confirm-delete').on('click', function () {
    var $modal = $('#modalDelete');
    var label  = $modal.find('#delete-target').text();
    bootstrap.Modal.getInstance($modal[0]).hide();
    showToast(label.charAt(0).toUpperCase() + label.slice(1) + ' deleted', 'success');
  });

  $(document).on('click', '.btn-export', function () {
    showToast('Preparing export…', 'info');
  });

  var cur = window.location.pathname.split('/').pop().replace('.html','');
  $('[data-page="' + cur + '"]').addClass('active');
  $('[data-page="' + cur + '"]').closest('.nav-submenu').addClass('open')
    .prev('.nav-toggle').addClass('open');
});

function showToast(msg, type) {
  type = type || 'info';
  var icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
  var color = type === 'success' ? 'var(--accent-2)' : type === 'error' ? 'var(--accent-3)' : 'var(--accent)';
  var $t = $('<div class="erp-toast ' + type + '"></div>')
    .html('<span style="font-weight:700;color:' + color + '">' + icon + '</span> ' + msg);
  $('#toast-container').append($t);
  setTimeout(function () { $t.css('opacity', 0); }, 2500);
  setTimeout(function () { $t.remove(); }, 2800);
}
</script>
@stack('scripts')
</body>
</html>