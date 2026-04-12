<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Business Overview — NEXUS ERP</title>
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;600&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('erp-styles.css') }}" />
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
      <div class="nav-item"><a class="nav-link" href="index.html" data-page="dashboard"><span class="nav-icon"><i
              class="bi bi-grid-1x2"></i></span><span>Dashboard</span></a></div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-people"></i></span><span>Users &amp; Roles</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/users.html" data-page="users"><span>Users</span></a>
          <a class="nav-submenu-link" href="pages/roles.html" data-page="roles"><span>Roles &amp; Permissions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-box-seam"></i></span><span>Inventory</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/products.html" data-page="products"><span>Product Catalog</span></a>
          <a class="nav-submenu-link" href="pages/stock-movements.html" data-page="stock-movements"><span>Stock
              In/Out</span></a>
          <a class="nav-submenu-link" href="pages/batch-tracking.html" data-page="batch-tracking"><span>Batch /
              Expiry</span></a>
          <a class="nav-submenu-link" href="pages/stock-valuation.html" data-page="stock-valuation"><span>Stock
              Valuation</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-cart3"></i></span><span>Purchase</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/suppliers.html" data-page="suppliers"><span>Suppliers</span></a>
          <a class="nav-submenu-link" href="pages/purchase-orders.html" data-page="purchase-orders"><span>Purchase
              Orders</span></a>
          <a class="nav-submenu-link" href="pages/grn.html" data-page="grn"><span>GRN</span></a>
          <a class="nav-submenu-link" href="pages/supplier-payments.html"
            data-page="supplier-payments"><span>Payments</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bag-check"></i></span><span>Sales</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/customers.html" data-page="customers"><span>Customers</span></a>
          <a class="nav-submenu-link" href="pages/sales-orders.html" data-page="sales-orders"><span>Sales
              Orders</span></a>
          <a class="nav-submenu-link" href="pages/invoices.html" data-page="invoices"><span>Invoices</span></a>
          <a class="nav-submenu-link" href="pages/promotions.html" data-page="promotions"><span>Discounts &amp;
              Promos</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-journal-text"></i></span><span>Accounting</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/gl.html" data-page="gl"><span>General Ledger</span></a>
          <a class="nav-submenu-link" href="pages/ap-ar.html" data-page="ap-ar"><span>AP / AR</span></a>
          <a class="nav-submenu-link" href="pages/tax.html" data-page="tax"><span>Tax &amp; Compliance</span></a>
          <a class="nav-submenu-link" href="pages/fin-reports.html" data-page="fin-reports"><span>Financial
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-person-badge"></i></span><span>Human Resources</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/employees.html" data-page="employees"><span>Employees</span></a>
          <a class="nav-submenu-link" href="pages/attendance.html" data-page="attendance"><span>Attendance &amp;
              Leave</span></a>
          <a class="nav-submenu-link" href="pages/payroll.html" data-page="payroll"><span>Payroll</span></a>
          <a class="nav-submenu-link" href="pages/performance.html" data-page="performance"><span>Performance</span></a>
        </div>
      </div>

      <div class="nav-section-label">Enterprise</div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-gear"></i></span><span>Production</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/bom.html" data-page="bom"><span>Bill of Materials</span></a>
          <a class="nav-submenu-link" href="pages/work-orders.html" data-page="work-orders"><span>Work Orders</span></a>
          <a class="nav-submenu-link" href="pages/machine-labor.html" data-page="machine-labor"><span>Machine &amp;
              Labor</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-handshake"></i></span><span>CRM</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/leads.html" data-page="leads"><span>Leads &amp;
              Opportunities</span></a>
          <a class="nav-submenu-link" href="pages/support.html" data-page="support"><span>Customer Support</span></a>
          <a class="nav-submenu-link" href="pages/interactions.html"
            data-page="interactions"><span>Interactions</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-kanban"></i></span><span>Projects</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/tasks.html" data-page="tasks"><span>Tasks &amp; Milestones</span></a>
          <a class="nav-submenu-link" href="pages/resources.html" data-page="resources"><span>Resource
              Allocation</span></a>
          <a class="nav-submenu-link" href="pages/project-cost.html" data-page="project-cost"><span>Cost
              Tracking</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-truck"></i></span><span>Warehouse &amp; Logistics</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/warehouses.html"
            data-page="warehouses"><span>Multi-Warehouse</span></a>
          <a class="nav-submenu-link" href="pages/shipments.html" data-page="shipments"><span>Shipments</span></a>
          <a class="nav-submenu-link" href="pages/routes.html" data-page="routes"><span>Routes &amp; Delivery</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shield-check"></i></span><span>Quality Control</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/qc-checklists.html" data-page="qc-checklists"><span>QC
              Checklists</span></a>
          <a class="nav-submenu-link" href="pages/defects.html" data-page="defects"><span>Defect Tracking</span></a>
          <a class="nav-submenu-link" href="pages/compliance.html" data-page="compliance"><span>Compliance
              Reports</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-shop"></i></span><span>E-Commerce / POS</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/online-channels.html" data-page="online-channels"><span>Sales
              Channels</span></a>
          <a class="nav-submenu-link" href="pages/pos.html" data-page="pos"><span>POS Terminals</span></a>
          <a class="nav-submenu-link" href="pages/inv-sync.html" data-page="inv-sync"><span>Inventory Sync</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-bar-chart-line"></i></span><span>Reports &amp; BI</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/custom-reports.html" data-page="custom-reports"><span>Custom
              Reports</span></a>
          <a class="nav-submenu-link" href="pages/forecasting.html" data-page="forecasting"><span>Forecasting</span></a>
          <a class="nav-submenu-link" href="pages/bi-dashboards.html" data-page="bi-dashboards"><span>BI
              Dashboards</span></a>
        </div>
      </div>

      <div class="nav-item">
        <button class="nav-link nav-toggle">
          <span class="nav-icon"><i class="bi bi-folder2-open"></i></span><span>Documents</span>
          <span class="nav-arrow"><i class="bi bi-chevron-right"></i></span>
        </button>
        <div class="nav-submenu">
          <a class="nav-submenu-link" href="pages/doc-library.html" data-page="doc-library"><span>Document
              Library</span></a>
          <a class="nav-submenu-link" href="pages/doc-versions.html" data-page="doc-versions"><span>Version
              Control</span></a>
        </div>
      </div>

      <div class="nav-item">
        <a class="nav-link" href="pages/settings.html" data-page="settings">
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
      <a class="header-btn" href="pages/settings.html" title="Settings">
        <i class="bi bi-sliders"></i>
      </a>
      <div class="user-avatar" title="Admin User">AD</div>
    </div>
  </header>

  <main id="main">

    <div class="page-header">
      <div>
        <div class="page-title">Business Overview</div>
        <div class="page-subtitle">Last updated: Today, 11:45 AM — Fiscal Year 2025</div>
      </div>
      <div class="d-flex gap-2">
        <select class="erp-form-control" style="width:140px">
          <option>This Month</option>
          <option>This Quarter</option>
          <option>This Year</option>
        </select>
        <button class="btn-erp btn-primary btn-export"><i class="bi bi-download"></i> Export</button>
      </div>
    </div>

    <div class="row g-3 mb-4">
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile blue">
          <div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div>
          <div class="kpi-value">$2.4M</div>
          <div class="kpi-label">Total Revenue</div>
          <div class="kpi-change up"><i class="bi bi-arrow-up-right"></i> +12.4%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile green">
          <div class="kpi-icon green"><i class="bi bi-bag-check"></i></div>
          <div class="kpi-value">1,842</div>
          <div class="kpi-label">Sales Orders</div>
          <div class="kpi-change up"><i class="bi bi-arrow-up-right"></i> +8.1%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile red">
          <div class="kpi-icon red"><i class="bi bi-cart3"></i></div>
          <div class="kpi-value">$890K</div>
          <div class="kpi-label">Purchases</div>
          <div class="kpi-change down"><i class="bi bi-arrow-down-right"></i> -3.2%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile yellow">
          <div class="kpi-icon yellow"><i class="bi bi-box-seam"></i></div>
          <div class="kpi-value">14,230</div>
          <div class="kpi-label">Stock Units</div>
          <div class="kpi-change up"><i class="bi bi-arrow-up-right"></i> +5.7%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile purple">
          <div class="kpi-icon purple"><i class="bi bi-people"></i></div>
          <div class="kpi-value">342</div>
          <div class="kpi-label">Active Customers</div>
          <div class="kpi-change up"><i class="bi bi-arrow-up-right"></i> +2.9%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile green">
          <div class="kpi-icon green"><i class="bi bi-graph-up-arrow"></div>
          <div class="kpi-value">34.8%</div>
          <div class="kpi-label">Gross Margin</div>
          <div class="kpi-change up"><i class="bi bi-arrow-up-right"></i> +1.2%</div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-lg-8">
        <div class="erp-card">
          <div class="card-header-bar">
            <div>
              <div class="card-title">Sales vs Purchase Trend</div>
              <div class="card-subtitle">Monthly comparison — 2025</div>
            </div>
            <div class="d-flex gap-2 align-items-center">
              <span class="tag" style="color:var(--accent)">■ Sales</span>
              <span class="tag" style="color:var(--accent-3)">■ Purchase</span>
            </div>
          </div>
          <div class="chart-container">
            <div class="chart-bar"
              style="height:55%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Jan: $180K</div>
            </div>
            <div class="chart-bar"
              style="height:65%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Feb: $210K</div>
            </div>
            <div class="chart-bar"
              style="height:72%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Mar: $240K</div>
            </div>
            <div class="chart-bar"
              style="height:60%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Apr: $195K</div>
            </div>
            <div class="chart-bar"
              style="height:80%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">May: $265K</div>
            </div>
            <div class="chart-bar"
              style="height:90%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Jun: $298K</div>
            </div>
            <div class="chart-bar"
              style="height:78%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Jul: $258K</div>
            </div>
            <div class="chart-bar"
              style="height:68%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Aug: $222K</div>
            </div>
            <div class="chart-bar"
              style="height:75%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Sep: $248K</div>
            </div>
            <div class="chart-bar"
              style="height:85%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Oct: $280K</div>
            </div>
            <div class="chart-bar"
              style="height:92%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Nov: $305K</div>
            </div>
            <div class="chart-bar"
              style="height:100%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">
              <div class="tooltip">Dec: $330K</div>
            </div>
          </div>
          <div class="chart-labels">
            <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
            <span>Jul</span><span>Aug</span><span>Sep</span><span>Oct</span><span>Nov</span><span>Dec</span>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="erp-card h-100">
          <div class="card-header-bar">
            <div>
              <div class="card-title">Stock by Category</div>
              <div class="card-subtitle">Current distribution</div>
            </div>
          </div>
          <div class="donut-wrap mb-3">
            <svg class="donut-chart" viewBox="0 0 42 42">
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--bg-elevated)" stroke-width="5" />
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--accent)" stroke-width="5"
                stroke-dasharray="35 65" stroke-dashoffset="25" />
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--accent-2)" stroke-width="5"
                stroke-dasharray="25 75" stroke-dashoffset="-10" />
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--accent-4)" stroke-width="5"
                stroke-dasharray="20 80" stroke-dashoffset="-35" />
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--accent-5)" stroke-width="5"
                stroke-dasharray="15 85" stroke-dashoffset="-55" />
              <circle cx="21" cy="21" r="15.915" fill="transparent" stroke="var(--accent-3)" stroke-width="5"
                stroke-dasharray="5 95" stroke-dashoffset="-70" />
            </svg>
            <div class="donut-legend">
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--accent)"></div><span
                  class="legend-label">Electronics</span><span class="legend-val">35%</span>
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--accent-2)"></div><span
                  class="legend-label">Hardware</span><span class="legend-val">25%</span>
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--accent-4)"></div><span
                  class="legend-label">Apparel</span><span class="legend-val">20%</span>
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--accent-5)"></div><span
                  class="legend-label">Food</span><span class="legend-val">15%</span>
              </div>
              <div class="legend-item">
                <div class="legend-dot" style="background:var(--accent-3)"></div><span
                  class="legend-label">Other</span><span class="legend-val">5%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-3">
      <div class="col-lg-4">
        <div class="erp-card">
          <div class="card-header-bar">
            <div class="card-title">Recent Activity</div><a href="#" class="btn-erp btn-outline btn-sm">View All</a>
          </div>
          <div class="timeline">
            <div class="tl-item">
              <div class="tl-dot blue"><i class="bi bi-cart-plus"></i></div>
              <div class="tl-content">
                <div class="tl-text"><strong>PO-2024-0091</strong> approved</div>
                <div class="tl-time">2 min ago</div>
              </div>
            </div>
            <div class="tl-item">
              <div class="tl-dot green"><i class="bi bi-check2-circle"></i></div>
              <div class="tl-content">
                <div class="tl-text"><strong>INV-8823</strong> paid by Acme Corp</div>
                <div class="tl-time">18 min ago</div>
              </div>
            </div>
            <div class="tl-item">
              <div class="tl-dot yellow"><i class="bi bi-box-arrow-in-down"></i></div>
              <div class="tl-content">
                <div class="tl-text">GRN received — <strong>Warehouse A</strong></div>
                <div class="tl-time">1 hr ago</div>
              </div>
            </div>
            <div class="tl-item">
              <div class="tl-dot red"><i class="bi bi-exclamation-triangle"></i></div>
              <div class="tl-content">
                <div class="tl-text">Low stock alert: <strong>SKU-4421</strong></div>
                <div class="tl-time">2 hr ago</div>
              </div>
            </div>
            <div class="tl-item">
              <div class="tl-dot blue"><i class="bi bi-person-plus"></i></div>
              <div class="tl-content">
                <div class="tl-text">New employee: <strong>Sarah K.</strong></div>
                <div class="tl-time">3 hr ago</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="erp-card">
          <div class="card-header-bar">
            <div class="card-title">Quick Actions</div>
          </div>
          <div class="row g-2">
            <div class="col-4"><a class="quick-action" href="pages/purchase-orders.html">
                <div class="qa-icon">🛒</div>
                <div class="qa-label">New PO</div>
              </a></div>
            <div class="col-4"><a class="quick-action" href="pages/invoices.html">
                <div class="qa-icon">🧾</div>
                <div class="qa-label">Invoice</div>
              </a></div>
            <div class="col-4"><a class="quick-action" href="pages/employees.html">
                <div class="qa-icon">👤</div>
                <div class="qa-label">Add Employee</div>
              </a></div>
            <div class="col-4"><a class="quick-action" href="pages/grn.html">
                <div class="qa-icon">📦</div>
                <div class="qa-label">New GRN</div>
              </a></div>
            <div class="col-4"><a class="quick-action" href="pages/payroll.html">
                <div class="qa-icon">💵</div>
                <div class="qa-label">Run Payroll</div>
              </a></div>
            <div class="col-4"><a class="quick-action" href="pages/custom-reports.html">
                <div class="qa-icon">📊</div>
                <div class="qa-label">Report</div>
              </a></div>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="erp-card">
          <div class="card-header-bar">
            <div class="card-title">Performance KPIs</div>
          </div>
          <div class="stat-row">
            <div class="stat-row-label">Order Fulfillment Rate</div><span class="stat-row-val">94.2%</span>
          </div>
          <div style="padding:0 0 10px">
            <div class="erp-progress">
              <div class="erp-progress-bar" style="width:94%;background:var(--accent-2)"></div>
            </div>
          </div>
          <div class="stat-row">
            <div class="stat-row-label">Inventory Turnover</div><span class="stat-row-val">6.8x</span>
          </div>
          <div style="padding:0 0 10px">
            <div class="erp-progress">
              <div class="erp-progress-bar" style="width:68%;background:var(--accent)"></div>
            </div>
          </div>
          <div class="stat-row">
            <div class="stat-row-label">On-Time Delivery</div><span class="stat-row-val">87.5%</span>
          </div>
          <div style="padding:0 0 10px">
            <div class="erp-progress">
              <div class="erp-progress-bar" style="width:87%;background:var(--accent-4)"></div>
            </div>
          </div>
          <div class="stat-row">
            <div class="stat-row-label">Customer Retention</div><span class="stat-row-val">79.1%</span>
          </div>
          <div style="padding:0">
            <div class="erp-progress">
              <div class="erp-progress-bar" style="width:79%;background:var(--accent-5)"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
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