<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Business Overview — NEXUS ERP</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/erp-styles.css') }}" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>


  <nav id="sidebar">
    <div class="sidebar-logo">
      <div class="logo-icon">⬡</div>
      <div class="logo-text">NEX<span>US</span> ERP</div>
    </div>
    <div class="sidebar-nav">

      <div class="nav-section-label">Core</div>
      <div class="nav-item"><a class="nav-link" href="{{ route('dashboard.index') }}" data-page="dashboard"><span class="nav-icon"><i
              class="bi bi-grid-1x2"></i></span><span>Dashboard</span></a></div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-people"></i></span><span>Users &amp; Roles</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('users.users.index') }}" data-page="users"><span>Users</span></a>
          <a class="nav-submenu-link" href="{{ route('users.roles.index') }}" data-page="roles"><span>Roles &amp; Permissions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-box-seam"></i></span><span>Inventory</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('inventory.products.index') }}" data-page="products"><span>Product Catalog</span></a>
          <a class="nav-submenu-link" href="{{ route('inventory.stock-movements.index') }}" data-page="stock-movements"><span>Stock
              In/Out</span></a>
          <a class="nav-submenu-link" href="{{ route('inventory.batch-tracking.index') }}" data-page="batch-tracking"><span>Batch /
              Expiry</span></a>
          <a class="nav-submenu-link" href="{{ route('inventory.stock-valuation.index') }}" data-page="stock-valuation"><span>Stock
              Valuation</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-cart3"></i></span><span>Purchase</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('purchase.suppliers.index') }}" data-page="suppliers"><span>Suppliers</span></a>
          <a class="nav-submenu-link" href="{{ route('purchase.purchase-orders.index') }}" data-page="purchase-orders"><span>Purchase
              Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('purchase.grn.index') }}" data-page="grn"><span>GRN</span></a>
          <a class="nav-submenu-link" href="{{ route('purchase.supplier-payments.index') }}"
            data-page="supplier-payments"><span>Payments</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bag-check"></i></span><span>Sales</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('sales.customers.index') }}" data-page="customers"><span>Customers</span></a>
          <a class="nav-submenu-link" href="{{ route('sales.sales-orders.index') }}" data-page="sales-orders"><span>Sales
              Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('sales.invoices.index') }}" data-page="invoices"><span>Invoices</span></a>
          <a class="nav-submenu-link" href="{{ route('sales.promotions.index') }}" data-page="promotions"><span>Discounts &amp;
              Promos</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-journal-text"></i></span><span>Accounting</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('accounting.gl.index') }}" data-page="gl"><span>General Ledger</span></a>
          <a class="nav-submenu-link" href="{{ route('accounting.ap-ar.index') }}" data-page="ap-ar"><span>AP / AR</span></a>
          <a class="nav-submenu-link" href="{{ route('accounting.tax.index') }}" data-page="tax"><span>Tax &amp; Compliance</span></a>
          <a class="nav-submenu-link" href="{{ route('accounting.fin-reports.index') }}" data-page="fin-reports"><span>Financial
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-person-badge"></i></span><span>Human Resources</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('hr.employees.index') }}" data-page="employees"><span>Employees</span></a>
          <a class="nav-submenu-link" href="{{ route('hr.attendance.index') }}" data-page="attendance"><span>Attendance &amp;
              Leave</span></a>
          <a class="nav-submenu-link" href="{{ route('hr.payroll.index') }}" data-page="payroll"><span>Payroll</span></a>
          <a class="nav-submenu-link" href="{{ route('hr.performance.index') }}" data-page="performance"><span>Performance</span></a>
        </div>
      </div>

      <div class="nav-section-label">Enterprise</div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-gear"></i></span><span>Production</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('production.bom.index') }}" data-page="bom"><span>Bill of Materials</span></a>
          <a class="nav-submenu-link" href="{{ route('production.work-orders.index') }}" data-page="work-orders"><span>Work Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('production.machine-labor.index') }}" data-page="machine-labor"><span>Machine &amp;
              Labor</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-handshake"></i></span><span>CRM</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('crm.leads.index') }}" data-page="leads"><span>Leads &amp;
              Opportunities</span></a>
          <a class="nav-submenu-link" href="{{ route('crm.support.index') }}" data-page="support"><span>Customer Support</span></a>
          <a class="nav-submenu-link" href="{{ route('crm.interactions.index') }}"
            data-page="interactions"><span>Interactions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-kanban"></i></span><span>Projects</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('project.tasks.index') }}" data-page="tasks"><span>Tasks &amp; Milestones</span></a>
          <a class="nav-submenu-link" href="{{ route('project.resources.index') }}" data-page="resources"><span>Resource
              Allocation</span></a>
          <a class="nav-submenu-link" href="{{ route('project.project-cost.index') }}" data-page="project-cost"><span>Cost
              Tracking</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-truck"></i></span><span>Warehouse &amp; Logistics</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('warehouse.warehouses.index') }}"
            data-page="warehouses"><span>Multi-Warehouse</span></a>
          <a class="nav-submenu-link" href="{{ route('warehouse.shipments.index') }}" data-page="shipments"><span>Shipments</span></a>
          <a class="nav-submenu-link" href="{{ route('warehouse.routes.index') }}" data-page="routes"><span>Routes &amp; Delivery</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shield-check"></i></span><span>Quality Control</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('qc.qc-checklists.index') }}" data-page="qc-checklists"><span>QC
              Checklists</span></a>
          <a class="nav-submenu-link" href="{{ route('qc.defects.index') }}" data-page="defects"><span>Defect Tracking</span></a>
          <a class="nav-submenu-link" href="{{ route('qc.compliance.index') }}" data-page="compliance"><span>Compliance
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shop"></i></span><span>E-Commerce / POS</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('pos.online-channels.index') }}" data-page="online-channels"><span>Sales
              Channels</span></a>
          <a class="nav-submenu-link" href="{{ route('pos.pos.index') }}" data-page="pos"><span>POS Terminals</span></a>
          <a class="nav-submenu-link" href="{{ route('pos.inv-sync.index') }}" data-page="inv-sync"><span>Inventory Sync</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span><span>Reports &amp; BI</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('report.custom-reports.index') }}" data-page="custom-reports"><span>Custom
              Reports</span></a>
          <a class="nav-submenu-link" href="{{ route('report.forecasting.index') }}" data-page="forecasting"><span>Forecasting</span></a>
          <a class="nav-submenu-link" href="{{ route('report.bi-dashboards.index') }}" data-page="bi-dashboards"><span>BI
              Dashboards</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-folder2-open"></i></span><span>Documents</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('document.doc-library.index') }}" data-page="doc-library"><span>Document
              Library</span></a>
          <a class="nav-submenu-link" href="{{ route('document.doc-versions.index') }}" data-page="doc-versions"><span>Version
              Control</span></a>
        </div>
      </div>

      <div class="nav-item">
        <a class="nav-link" href="{{ route('settings.settings.index') }}" data-page="settings">
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
      <span id="breadcrumb-current">Business Overview</span>
    </div>
    <div class="header-search">
      <span class="search-icon"><i class="bi bi-search"></i></span>
      <input type="text" placeholder="Search modules, records…" />
    </div>
    <div class="header-actions">
      <button class="header-btn" title="Notifications">
        <i class="bi bi-bell"></i>
        <span class="notif-badge">5</span>
      </button>
      <a class="header-btn" href="{{ route('settings.settings.index') }}" title="Settings">
        <i class="bi bi-sliders"></i>
      </a>
      <div class="user-avatar" title="Admin User">AD</div>
    </div>
  </header>

  <main id="main">
  @yield('content')

</main>

  <!-- Delete Confirm Modal -->
  
  <div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm
            Delete</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="color:var(--text-secondary);font-size:14px">
            Are you sure you want to delete this
            <strong id="delete-target" style="color:var(--text-primary)">record</strong>?
            This action cannot be undone.
          </p>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-danger" id="btn-confirm-delete">
            <i class="bi bi-trash"></i> Delete
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Toast Container -->
  <div class="toast-container" id="toast-container"></div>
  <script src="{{ asset('js/erp-api.js') }}"></script>
  <script>
    $(function () {

      /* ── Sidebar toggle (mobile & collapse) ── */
      $('#btn-sidebar-toggle').on('click', function () {
        $('#sidebar').toggleClass('collapsed');
      });

      /* ── Submenu accordion ── */
      $(document).on('click', '.nav-toggle', function () {
        var $sub = $(this).next('.nav-submenu');
        var isOpen = $sub.hasClass('open');
        $('.nav-submenu.open').removeClass('open').prev().removeClass('open');
        if (!isOpen) { $sub.addClass('open'); $(this).addClass('open'); }
      });

      /* ── Permission-check toggle ── */
      $(document).on('click', '.perm-check', function () {
        $(this).toggleClass('on');
      });

      /* ── Table search filter ── */
      $(document).on('input', '.tbl-search', function () {
        ErpApi.refreshTableForElement(this);
      });

      $(document).on('change', '.table-toolbar select', function () {
        ErpApi.refreshTableForElement(this);
      });

      /* ── Tab switcher ── */
      $(document).on('click', '.erp-tab', function () {
        var target = $(this).data('tab');
        var $card = $(this).closest('.erp-card');
        $card.find('.erp-tab').removeClass('active');
        $card.find('.tab-panel').removeClass('active');
        $(this).addClass('active');
        $('#' + target).addClass('active');
      });

      /* ── Pagination (visual only) ── */
      $(document).on('click', '.pg-btn', function () {
        var $table = $(this).closest('.erp-card').find('table').first();
        var key = '#' + $table.attr('id');
        var state = ErpApi._tableStates[key];
        var page = parseInt($(this).data('page'), 10);
        if (!state || !page) return;
        state.page = page;
        ErpApi.renderTableState(key);
      });

      /* ── Save button inside any BS5 modal ── */
      $(document).on('click', '.btn-modal-save', function () {
        var $modal = $(this).closest('.modal');
        if ($modal.data('api-save')) return; // handled by page-specific JS
        bootstrap.Modal.getInstance($modal[0]).hide();
        showToast('Record saved successfully', 'success');
      });

      /* ── Delete confirm modal: set target label ── */
      $('#modalDelete').on('show.bs.modal', function (e) {
        var label = $(e.relatedTarget).data('delete-label') || 'record';
        var deleteUrl = $(e.relatedTarget).data('delete-url') || '';
        $(this).find('#delete-target').text(label);
        $(this).data('delete-url', deleteUrl);
      });

      /* ── Confirm delete button ── */
      $('#btn-confirm-delete').on('click', function () {
        var $modal = $('#modalDelete');
        var label = $modal.find('#delete-target').text();
        var deleteUrl = $modal.data('delete-url');
        bootstrap.Modal.getInstance($modal[0]).hide();
        if (deleteUrl) {
          ErpApi.deleteItem(deleteUrl, function () {
            if (typeof loadTableData === 'function') loadTableData();
          });
        } else {
          showToast(label.charAt(0).toUpperCase() + label.slice(1) + ' deleted', 'success');
        }
      });

      /* ── Payroll run ── */
      $('#btn-run-payroll').on('click', function () {
        showToast('Payroll run initiated', 'info');
      });

      /* ── PO Approve buttons ── */
      $(document).on('click', '.btn-approve-po', function () {
        showToast('PO approved', 'success');
      });

      /* ── Process payment ── */
      $(document).on('click', '.btn-process-payment', function () {
        showToast('Payment processed', 'success');
      });

      /* ── Permission save ── */
      $(document).on('click', '.btn-save-perms', function () {
        showToast('Permissions saved', 'success');
      });

      /* ── Force sync ── */
      $(document).on('click', '.btn-force-sync', function () {
        showToast('Sync initiated…', 'info');
      });

      /* ── Export ── */
      $(document).on('click', '.btn-export', function () {
        showToast('Preparing export…', 'info');
      });

      /* ── Mark active nav link for current page ── */
      var cur = window.location.pathname.split('/').pop().replace('.html', '');
      $('[data-page="' + cur + '"]').addClass('active');
      $('[data-page="' + cur + '"]').closest('.nav-submenu').addClass('open')
        .prev('.nav-toggle').addClass('open');
    });

    /* ── Toast utility (jQuery) ── */
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
  @yield('scripts')
  @stack('scripts')

</body>

</html>
