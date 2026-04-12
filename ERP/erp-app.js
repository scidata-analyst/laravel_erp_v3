/* ============================================================
   ERP Nexus — Application Script
   ============================================================ */

// ── Navigation ────────────────────────────────────────────────
const pageMap = {
  dashboard:  { title: 'Dashboard',         crumb: 'Overview' },
  users:      { title: 'Users & Roles',      crumb: 'User Management' },
  inventory:  { title: 'Inventory',          crumb: 'Stock Management' },
  purchase:   { title: 'Purchase',           crumb: 'Supplier Management' },
  sales:      { title: 'Sales',              crumb: 'Customer Management' },
  accounting: { title: 'Accounting',         crumb: 'Finance & GL' },
  hr:         { title: 'Human Resources',    crumb: 'HR Management' },
  production: { title: 'Production',         crumb: 'Manufacturing' },
  crm:        { title: 'CRM',                crumb: 'Customer Relations' },
  projects:   { title: 'Projects',           crumb: 'Project Management' },
  warehouse:  { title: 'Warehouse',          crumb: 'Logistics' },
  quality:    { title: 'Quality Control',    crumb: 'QC & Assurance' },
  pos:        { title: 'POS / E-Commerce',   crumb: 'Sales Channels' },
  reports:    { title: 'Reports & BI',       crumb: 'Business Intelligence' },
  documents:  { title: 'Documents',          crumb: 'File Management' },
};

function showPage(pageId) {
  // Hide all pages
  document.querySelectorAll('.page-section').forEach(p => p.classList.remove('active'));
  // Show target
  const target = document.getElementById('page-' + pageId);
  if (target) target.classList.add('active');

   nav highlights
  document.querySelectorAll('.sidebar-nav-item').forEach(item => {
    item.classList.remove('active');
    if (item.getAttribute('onclick') && item.getAttribute('onclick').includes("'" + pageId + "'")) {
      item.classList.add('active');
    }
  });

   topbar
  const info = pageMap[pageId] || { title: pageId, crumb: pageId };
  document.getElementById('topbarTitle').textContent = info.title;
  document.getElementById('topbarBreadcrumb').textContent = info.crumb;

  // Mobile: close sidebar
  if (window.innerWidth < 992) {
    document.getElementById('erpSidebar').classList.remove('open');
    document.getElementById('sidebarOverlay').classList.remove('open');
  }

  // Scroll to top
  document.querySelector('.erp-content').scrollTop = 0;
}

// ── Sidebar Toggle ────────────────────────────────────────────
function toggleSidebar() {
  const sidebar  = document.getElementById('erpSidebar');
  const overlay  = document.getElementById('sidebarOverlay');
  sidebar.classList.toggle('open');
  overlay.classList.toggle('open');
}

// ── Fullscreen ────────────────────────────────────────────────
function toggleFS() {
  if (!document.fullscreenElement) {
    document.documentElement.requestFullscreen().catch(() => {});
  } else {
    document.exitFullscreen();
  }
}

// ── Modals ────────────────────────────────────────────────────
function openModal(modalId, titleId, titleText) {
  if (titleId && titleText) {
    const el = document.getElementById(titleId);
    if (el) el.textContent = titleText;
  }
  document.getElementById(modalId).classList.add('open');
}

function closeModal(modalId) {
  document.getElementById(modalId).classList.remove('open');
}

// Close modal on overlay click
document.querySelectorAll('.erp-modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
  });
});

// ── Delete Modal ──────────────────────────────────────────────
let deleteTarget = null;

function openDeleteModal(name) {
  deleteTarget = name;
  document.getElementById('deleteItemName').textContent = name;
  document.getElementById('modalDelete').classList.add('open');
}

function confirmDelete() {
  closeModal('modalDelete');
  showToast(`"${deleteTarget}" deleted successfully`, 'success');
  deleteTarget = null;
}

// ── Save Handlers ─────────────────────────────────────────────
function saveUser() {
  const fname  = document.getElementById('ufname').value.trim();
  const lname  = document.getElementById('ulname').value.trim();
  const email  = document.getElementById('uemail').value.trim();
  const role   = document.getElementById('urole').value;

  if (!fname || !lname || !email) {
    showToast('Please fill in all required fields', 'error');
    return;
  }

  // Append row to users table
  const tbody = document.getElementById('usersBody');
  const rowCount = tbody.querySelectorAll('tr').length + 1;
  const initials = (fname[0] + lname[0]).toUpperCase();
  const colors = ['var(--amber-glow)', 'var(--blue-bg)', 'var(--green-bg)', 'var(--purple-bg)', 'var(--red-bg)'];
  const textColors = ['var(--amber)', 'var(--blue)', 'var(--green)', 'var(--purple)', 'var(--red)'];
  const ci = rowCount % colors.length;

  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><input type="checkbox"/></td>
    <td class="font-mono text-muted" style="font-size:11px;">USR-${String(rowCount).padStart(3,'0')}</td>
    <td>
      <div class="d-flex align-items-center gap-2">
        <div class="avatar-sm" style="background:${colors[ci]};color:${textColors[ci]};">${initials}</div>
        <div><div style="font-weight:600;">${fname} ${lname}</div><div class="cell-sub">${role}</div></div>
      </div>
    </td>
    <td>${email}</td>
    <td><span class="erp-badge badge-muted">${role}</span></td>
    <td>${document.getElementById('udept').value}</td>
    <td class="cell-sub">Just now</td>
    <td><span class="erp-badge badge-success">${document.getElementById('ustatus').value}</span></td>
    <td>
      <div class="d-flex gap-1">
        <button class="btn-erp btn-erp-secondary btn-erp-sm btn-erp-icon" onclick="openModal('modalUser','modalUserTitle','Edit User')"><i class="fas fa-pen"></i></button>
        <button class="btn-erp btn-erp-danger btn-erp-sm btn-erp-icon" onclick="openDeleteModal('${fname} ${lname}')"><i class="fas fa-trash-alt"></i></button>
      </div>
    </td>`;
  tbody.appendChild(tr);

  closeModal('modalUser');
  showToast(`User ${fname} ${lname} created successfully`, 'success');

  // Clear inputs
  ['ufname','ulname','uemail'].forEach(id => document.getElementById(id).value = '');
}

function saveProduct() {
  const name = document.getElementById('pname').value.trim();
  const sku  = document.getElementById('psku').value.trim();

  if (!name || !sku) {
    showToast('Product name and SKU are required', 'error');
    return;
  }

  closeModal('modalProduct');
  showToast(`Product "${name}" added to inventory`, 'success');

  // Clear
  ['pname','psku','pcost','pprice','pstock','preorder','pdesc'].forEach(id => {
    const el = document.getElementById(id);
    if (el) el.value = '';
  });
}

// ── Purchase Order Rows ───────────────────────────────────────
function addPORow() {
  const tbody = document.getElementById('poItemsBody');
  const tr = document.createElement('tr');
  tr.innerHTML = `
    <td><input class="erp-input" type="text" placeholder="Item name" style="padding:5px 9px;font-size:12px;"/></td>
    <td><input class="erp-input" type="number" value="1" style="padding:5px 9px;font-size:12px;width:70px;"/></td>
    <td><input class="erp-input" type="number" value="0" style="padding:5px 9px;font-size:12px;width:100px;"/></td>
    <td class="font-mono text-amber">৳0</td>
    <td><button class="btn-erp btn-erp-danger btn-erp-sm btn-erp-icon" onclick="this.closest('tr').remove()"><i class="fas fa-trash-alt"></i></button></td>`;
  tbody.appendChild(tr);
}

// ── Toast Notifications ───────────────────────────────────────
function showToast(message, type = 'success') {
  const container = document.getElementById('toast-container');

  const iconMap = {
    success: '<i class="fas fa-check-circle" style="color:var(--green);"></i>',
    error:   '<i class="fas fa-times-circle" style="color:var(--red);"></i>',
    warning: '<i class="fas fa-exclamation-triangle" style="color:var(--amber);"></i>',
  };

  const toast = document.createElement('div');
  toast.className = `erp-toast ${type}`;
  toast.innerHTML = `${iconMap[type] || iconMap.success} <span>${message}</span>`;
  container.appendChild(toast);

  setTimeout(() => {
    toast.style.transition = 'opacity 0.3s, transform 0.3s';
    toast.style.opacity = '0';
    toast.style.transform = 'translateX(40px)';
    setTimeout(() => toast.remove(), 350);
  }, 3000);
}

// ── Tab Switching ─────────────────────────────────────────────
function switchTab(btn, tabId) {
  // Deactivate all sibling tabs
  btn.closest('.erp-tabs').querySelectorAll('.erp-tab').forEach(t => t.classList.remove('active'));
  btn.classList.add('active');

  // Hide / show tab panels (look for siblings by naming convention)
  const allTabIds = ['tab-users-list', 'tab-users-roles'];
  allTabIds.forEach(id => {
    const el = document.getElementById(id);
    if (el) el.style.display = (id === tabId) ? 'block' : 'none';
  });
}

// ── Keyboard shortcuts ────────────────────────────────────────
document.addEventListener('keydown', e => {
  if (e.key === 'Escape') {
    document.querySelectorAll('.erp-modal-overlay.open').forEach(m => m.classList.remove('open'));
  }
  // Ctrl+/ → focus search
  if ((e.ctrlKey || e.metaKey) && e.key === '/') {
    e.preventDefault();
    const si = document.querySelector('.topbar-search input');
    if (si) si.focus();
  }
});

// ── Init ──────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  showPage('dashboard');

  // Animate progress bars on load
  setTimeout(() => {
    document.querySelectorAll('.erp-progress-bar').forEach(bar => {
      const w = bar.style.width;
      bar.style.width = '0%';
      requestAnimationFrame(() => {
        setTimeout(() => bar.style.width = w, 100);
      });
    });
  }, 300);

  // Topbar search — quick navigation
  const searchInput = document.querySelector('.topbar-search input');
  if (searchInput) {
    searchInput.addEventListener('keydown', e => {
      if (e.key === 'Enter') {
        const val = e.target.value.toLowerCase().trim();
        const match = Object.keys(pageMap).find(k =>
          k.includes(val) || pageMap[k].title.toLowerCase().includes(val)
        );
        if (match) {
          showPage(match);
          showToast(`Navigated to ${pageMap[match].title}`, 'success');
          e.target.value = '';
          e.target.blur();
        }
      }
    });
  }
});
