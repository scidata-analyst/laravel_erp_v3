@extends('layouts.app')

@section('content')
<div class="page-header">
      <div>
        <div class="page-title">Business Overview</div>
        <div class="page-subtitle" id="last-updated">Loading...</div>
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
          <div class="kpi-value" id="kpi-revenue">$0</div>
          <div class="kpi-label">Total Revenue</div>
          <div class="kpi-change up" id="kpi-revenue-change"><i class="bi bi-arrow-up-right"></i> +0%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile green">
          <div class="kpi-icon green"><i class="bi bi-bag-check"></i></div>
          <div class="kpi-value" id="kpi-sales">0</div>
          <div class="kpi-label">Sales Orders</div>
          <div class="kpi-change up" id="kpi-sales-change"><i class="bi bi-arrow-up-right"></i> +0%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile red">
          <div class="kpi-icon red"><i class="bi bi-cart3"></i></div>
          <div class="kpi-value" id="kpi-purchases">$0</div>
          <div class="kpi-label">Purchases</div>
          <div class="kpi-change down" id="kpi-purchases-change"><i class="bi bi-arrow-down-right"></i> -0%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile yellow">
          <div class="kpi-icon yellow"><i class="bi bi-box-seam"></i></div>
          <div class="kpi-value" id="kpi-stock">0</div>
          <div class="kpi-label">Stock Units</div>
          <div class="kpi-change up" id="kpi-stock-change"><i class="bi bi-arrow-up-right"></i> +0%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile purple">
          <div class="kpi-icon purple"><i class="bi bi-people"></i></div>
          <div class="kpi-value" id="kpi-customers">0</div>
          <div class="kpi-label">Active Customers</div>
          <div class="kpi-change up" id="kpi-customers-change"><i class="bi bi-arrow-up-right"></i> +0%</div>
        </div>
      </div>
      <div class="col-xl-2 col-lg-4 col-md-6 col-6">
        <div class="kpi-tile green">
          <div class="kpi-icon green"><i class="bi bi-graph-up-arrow"></i></div>
          <div class="kpi-value" id="kpi-margin">0%</div>
          <div class="kpi-label">Gross Margin</div>
          <div class="kpi-change up" id="kpi-margin-change"><i class="bi bi-arrow-up-right"></i> +0%</div>
        </div>
      </div>
    </div>

    <div class="row g-3 mb-3">
      <div class="col-lg-8">
        <div class="erp-card">
          <div class="card-header-bar">
            <div>
              <div class="card-title">Sales vs Purchase Trend</div>
              <div class="card-subtitle">Monthly comparison</div>
            </div>
            <div class="d-flex gap-2 align-items-center">
              <span class="tag" style="color:var(--accent)">■ Sales</span>
              <span class="tag" style="color:var(--accent-3)">■ Purchase</span>
            </div>
          </div>
          <div class="chart-container" id="chart-trend">
          </div>
          <div class="chart-labels" id="chart-labels">
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
            <div class="donut-legend" id="donut-legend">
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
          <div class="timeline" id="recent-activity">
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
          <div id="performance-kpis">
            <div class="stat-row">
              <div class="stat-row-label">Order Fulfillment Rate</div><span class="stat-row-val" id="kpi-fulfillment">0%</span>
            </div>
            <div style="padding:0 0 10px">
              <div class="erp-progress">
                <div class="erp-progress-bar" id="bar-fulfillment" style="width:0%;background:var(--accent-2)"></div>
              </div>
            </div>
            <div class="stat-row">
              <div class="stat-row-label">Inventory Turnover</div><span class="stat-row-val" id="kpi-turnover">0x</span>
            </div>
            <div style="padding:0 0 10px">
              <div class="erp-progress">
                <div class="erp-progress-bar" id="bar-turnover" style="width:0%;background:var(--accent)"></div>
              </div>
            </div>
            <div class="stat-row">
              <div class="stat-row-label">On-Time Delivery</div><span class="stat-row-val" id="kpi-delivery">0%</span>
            </div>
            <div style="padding:0 0 10px">
              <div class="erp-progress">
                <div class="erp-progress-bar" id="bar-delivery" style="width:0%;background:var(--accent-4)"></div>
              </div>
            </div>
            <div class="stat-row">
              <div class="stat-row-label">Customer Retention</div><span class="stat-row-val" id="kpi-retention">0%</span>
            </div>
            <div style="padding:0">
              <div class="erp-progress">
                <div class="erp-progress-bar" id="bar-retention" style="width:0%;background:var(--accent-5)"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
(function(){

  function updateKpi(id, value, changeId, change) {
    $('#' + id).text(value);
    if (changeId && change !== undefined) {
      var isUp = parseFloat(change) >= 0;
      var icon = isUp ? 'bi-arrow-up-right' : 'bi-arrow-down-right';
      var sign = isUp ? '+' : '';
      $('#' + changeId).html('<i class="bi ' + icon + '"></i> ' + sign + change + '%')
        .removeClass('up down').addClass(isUp ? 'up' : 'down');
    }
  }

  function renderChart(salesData, purchaseData) {
    var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var maxVal = Math.max.apply(null, salesData.concat(purchaseData)) || 1;
    var container = $('#chart-trend');
    container.empty();

    for (var i = 0; i < 12; i++) {
      var sPct = Math.round((salesData[i] / maxVal) * 100);
      container.append(
        '<div class="chart-bar" style="height:' + sPct + '%;background:linear-gradient(to top,var(--accent),rgba(79,124,255,0.3))">' +
        '<div class="tooltip">' + months[i] + ': $' + (salesData[i] || 0) + 'K</div></div>'
      );
    }
  }

  function loadStats() {
    ErpApi.get('/dashboard/stats', function(res) {
      var data = res.data || res;

      var revenue = data.total_revenue || data.revenue || '2.4M';
      var sales = data.sales_orders || data.sales || '1,842';
      var purchases = data.purchases || '$890K';
      var stock = data.stock_units || data.stock || '14,230';
      var customers = data.active_customers || data.customers || '342';
      var margin = data.gross_margin || data.margin || '34.8%';

      updateKpi('kpi-revenue', '$' + revenue, 'kpi-revenue-change', data.revenue_change || '12.4');
      updateKpi('kpi-sales', sales, 'kpi-sales-change', data.sales_change || '8.1');
      updateKpi('kpi-purchases', '$' + purchases, 'kpi-purchases-change', data.purchases_change || '-3.2');
      updateKpi('kpi-stock', stock, 'kpi-stock-change', data.stock_change || '5.7');
      updateKpi('kpi-customers', customers, 'kpi-customers-change', data.customers_change || '2.9');
      updateKpi('kpi-margin', margin + '%', 'kpi-margin-change', data.margin_change || '1.2');

      if (data.performance) {
        var perf = data.performance;
        $('#kpi-fulfillment').text((perf.fulfillment || 94.2) + '%');
        $('#bar-fulfillment').css('width', (perf.fulfillment || 94.2) + '%');
        $('#kpi-turnover').text((perf.turnover || 6.8) + 'x');
        $('#bar-turnover').css('width', ((perf.turnover || 6.8) * 10) + '%');
        $('#kpi-delivery').text((perf.delivery || 87.5) + '%');
        $('#bar-delivery').css('width', (perf.delivery || 87.5) + '%');
        $('#kpi-retention').text((perf.retention || 79.1) + '%');
        $('#bar-retention').css('width', (perf.retention || 79.1) + '%');
      }

      if (data.chart_sales && data.chart_purchases) {
        renderChart(data.chart_sales, data.chart_purchases);
      }

      if (data.last_updated) {
        $('#last-updated').text('Last updated: ' + data.last_updated);
      } else {
        var now = new Date();
        $('#last-updated').text('Last updated: ' + now.toLocaleString());
      }
    });
  }

  window.loadTableData = function() {
    loadStats();
  };

  loadStats();
})();
</script>
@endsection
