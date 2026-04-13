<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Roles & Permissions — NEXUS ERP</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset("erp-styles.css") }}" />
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
      <div class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}" data-page="dashboard"><span
            class="nav-icon"><i class="bi bi-grid-1x2"></i></span><span>Dashboard</span></a></div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-people"></i></span><span>Users &amp; Roles</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('user.index') }}" data-page="users"><span>Users</span></a>
          <a class="nav-submenu-link" href="{{ route('roles.index') }}" data-page="roles"><span>Roles &amp;
              Permissions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-box-seam"></i></span><span>Inventory</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('product_catalog.index') }}" data-page="products"><span>Product
              Catalog</span></a>
          <a class="nav-submenu-link" href="{{ route('stock_movements.index') }}"
            data-page="stock-movements"><span>Stock In/Out</span></a>
          <a class="nav-submenu-link" href="{{ route('batch_tracking.index') }}" data-page="batch-tracking"><span>Batch
              / Expiry</span></a>
          <a class="nav-submenu-link" href="{{ route('stock_valuation.index') }}"
            data-page="stock-valuation"><span>Stock Valuation</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-cart3"></i></span><span>Purchase</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('suppliers.index') }}"
            data-page="suppliers"><span>Suppliers</span></a>
          <a class="nav-submenu-link" href="{{ route('purchase_orders.index') }}"
            data-page="purchase-orders"><span>Purchase Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('grn.index') }}" data-page="grn"><span>GRN</span></a>
          <a class="nav-submenu-link" href="{{ route('supplier_payments.index') }}"
            data-page="supplier-payments"><span>Payments</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bag-check"></i></span><span>Sales</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('customers.index') }}"
            data-page="customers"><span>Customers</span></a>
          <a class="nav-submenu-link" href="{{ route('sales_orders.index') }}" data-page="sales-orders"><span>Sales
              Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('invoices.index') }}"
            data-page="invoices"><span>Invoices</span></a>
          <a class="nav-submenu-link" href="{{ route('promotions.index') }}" data-page="promotions"><span>Discounts
              &amp; Promos</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-journal-text"></i></span><span>Accounting</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('gl.index') }}" data-page="gl"><span>General Ledger</span></a>
          <a class="nav-submenu-link" href="{{ route('ap_ar.index') }}" data-page="ap-ar"><span>AP / AR</span></a>
          <a class="nav-submenu-link" href="{{ route('tax.index') }}" data-page="tax"><span>Tax &amp;
              Compliance</span></a>
          <a class="nav-submenu-link" href="{{ route('fin_reports.index') }}" data-page="fin-reports"><span>Financial
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-person-badge"></i></span><span>Human Resources</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('employees.index') }}"
            data-page="employees"><span>Employees</span></a>
          <a class="nav-submenu-link" href="{{ route('attendance.index') }}" data-page="attendance"><span>Attendance
              &amp; Leave</span></a>
          <a class="nav-submenu-link" href="{{ route('payroll.index') }}" data-page="payroll"><span>Payroll</span></a>
          <a class="nav-submenu-link" href="{{ route('performance.index') }}"
            data-page="performance"><span>Performance</span></a>
        </div>
      </div>

      <div class="nav-section-label">Enterprise</div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-gear"></i></span><span>Production</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('bom.index') }}" data-page="bom"><span>Bill of Materials</span></a>
          <a class="nav-submenu-link" href="{{ route('work_orders.index') }}" data-page="work-orders"><span>Work
              Orders</span></a>
          <a class="nav-submenu-link" href="{{ route('machine_labor.index') }}" data-page="machine-labor"><span>Machine
              &amp; Labor</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-handshake"></i></span><span>CRM</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('leads.index') }}" data-page="leads"><span>Leads &amp;
              Opportunities</span></a>
          <a class="nav-submenu-link" href="{{ route('support.index') }}" data-page="support"><span>Customer
              Support</span></a>
          <a class="nav-submenu-link" href="{{ route('interactions.index') }}"
            data-page="interactions"><span>Interactions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-kanban"></i></span><span>Projects</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('tasks.index') }}" data-page="tasks"><span>Tasks &amp;
              Milestones</span></a>
          <a class="nav-submenu-link" href="{{ route('resources.index') }}" data-page="resources"><span>Resource
              Allocation</span></a>
          <a class="nav-submenu-link" href="{{ route('project_cost.index') }}" data-page="project-cost"><span>Cost
              Tracking</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-truck"></i></span><span>Warehouse &amp; Logistics</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('warehouses.index') }}"
            data-page="warehouses"><span>Multi-Warehouse</span></a>
          <a class="nav-submenu-link" href="{{ route('shipments.index') }}"
            data-page="shipments"><span>Shipments</span></a>
          <a class="nav-submenu-link" href="{{ route('routes.index') }}" data-page="routes"><span>Routes &amp;
              Delivery</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shield-check"></i></span><span>Quality Control</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('qc_checklists.index') }}" data-page="qc-checklists"><span>QC
              Checklists</span></a>
          <a class="nav-submenu-link" href="{{ route('defects.index') }}" data-page="defects"><span>Defect
              Tracking</span></a>
          <a class="nav-submenu-link" href="{{ route('compliance.index') }}" data-page="compliance"><span>Compliance
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shop"></i></span><span>E-Commerce / POS</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('online_channels.index') }}"
            data-page="online-channels"><span>Sales Channels</span></a>
          <a class="nav-submenu-link" href="{{ route('pos.index') }}" data-page="pos"><span>POS Terminals</span></a>
          <a class="nav-submenu-link" href="{{ route('inv_sync.index') }}" data-page="inv-sync"><span>Inventory
              Sync</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span><span>Reports &amp; BI</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('custom_reports.index') }}" data-page="custom-reports"><span>Custom
              Reports</span></a>
          <a class="nav-submenu-link" href="{{ route('forecasting.index') }}"
            data-page="forecasting"><span>Forecasting</span></a>
          <a class="nav-submenu-link" href="{{ route('bi_dashboards.index') }}" data-page="bi-dashboards"><span>BI
              Dashboards</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-folder2-open"></i></span><span>Documents</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="{{ route('doc_library.index') }}" data-page="doc-library"><span>Document
              Library</span></a>
          <a class="nav-submenu-link" href="{{ route('doc_versions.index') }}" data-page="doc-versions"><span>Version
              Control</span></a>
        </div>
      </div>

      <div class="nav-item">
        <a class="nav-link" href="{{ route('settings.index') }}" data-page="settings">
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
      <span id="breadcrumb-current">Roles & Permissions</span>
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
      <a class="header-btn" href="../pages/settings.html" title="Settings">
        <i class="bi bi-sliders"></i>
      </a>
      <div class="user-avatar" title="Admin User">AD</div>
    </div>
  </header>

  <main id="main">

    <div class="page-header">
      <div>
        <div class="page-title">Roles &amp; Permissions</div>
        <div class="page-subtitle">Assign granular access control per role</div>
      </div>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalRole"><i
          class="bi bi-plus-lg"></i> Add Role</button>
    </div>
    <div class="row g-3">
      <div class="col-md-4">
        <div class="erp-card">
          <div class="card-header-bar">
            <div class="card-title">Roles</div>
          </div>
          <div class="stat-row" style="cursor:pointer;padding:10px 8px">
            <div class="stat-row-label"><i class="bi bi-shield-fill-check text-accent me-2"></i>Admin</div><span
              class="badge-status badge-purple">3 users</span>
          </div>
          <div class="stat-row" style="cursor:pointer;padding:10px 8px">
            <div class="stat-row-label"><i class="bi bi-person-badge me-2"></i>Manager</div><span
              class="badge-status badge-info">8 users</span>
          </div>
          <div class="stat-row" style="cursor:pointer;padding:10px 8px">
            <div class="stat-row-label"><i class="bi bi-person me-2"></i>Staff</div><span
              class="badge-status badge-pending">24 users</span>
          </div>
          <div class="stat-row" style="cursor:pointer;padding:10px 8px">
            <div class="stat-row-label"><i class="bi bi-eye me-2"></i>Viewer</div><span
              class="badge-status badge-active">12 users</span>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="erp-card">
          <div class="card-header-bar">
            <div class="card-title">Permissions — Admin</div>
            <button class="btn-erp btn-primary btn-sm btn-save-perms"><i class="bi bi-check2"></i> Save</button>
          </div>
          <div class="perm-grid">
            <div class="pg-header">Module</div>
            <div class="pg-header">View</div>
            <div class="pg-header">Create</div>
            <div class="pg-header">Edit</div>
            <div class="pg-header">Delete</div>
            <div class="perm-row">
              <div>Inventory</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
            </div>
            <div class="perm-row">
              <div>Purchase</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
            </div>
            <div class="perm-row">
              <div>Sales</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
            </div>
            <div class="perm-row">
              <div>Accounting</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
              <div>
                <div class="perm-check"></div>
              </div>
            </div>
            <div class="perm-row">
              <div>HR</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
            </div>
            <div class="perm-row">
              <div>Reports</div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
              <div>
                <div class="perm-check on"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>


  <div class="modal fade" id="modalRole" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Role</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12"><label class="erp-form-label">Role Name</label><input class="erp-form-control"
                type="text" placeholder="e.g. Procurement Officer" /></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="3" placeholder="Describe the role responsibilities…"></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Create Role
          </button>
        </div>
      </div>
    </div>
  </div>
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
        var q = $(this).val().toLowerCase();
        var $tbl = $($(this).data('table'));
        $tbl.find('tbody tr').each(function () {
          $(this).toggle($(this).text().toLowerCase().includes(q));
        });
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
        $(this).closest('.erp-pagination').find('.pg-btn').removeClass('active');
        $(this).addClass('active');
      });

      /* ── Save button inside any BS5 modal ── */
      $(document).on('click', '.btn-modal-save', function () {
        var $modal = $(this).closest('.modal');
        bootstrap.Modal.getInstance($modal[0]).hide();
        showToast('Record saved successfully', 'success');
      });

      /* ── Delete confirm modal: set target label ── */
      $('#modalDelete').on('show.bs.modal', function (e) {
        var label = $(e.relatedTarget).data('delete-label') || 'record';
        $(this).find('#delete-target').text(label);
      });

      /* ── Confirm delete button ── */
      $('#btn-confirm-delete').on('click', function () {
        var $modal = $('#modalDelete');
        var label = $modal.find('#delete-target').text();
        bootstrap.Modal.getInstance($modal[0]).hide();
        showToast(label.charAt(0).toUpperCase() + label.slice(1) + ' deleted', 'success');
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

</body>

</html>