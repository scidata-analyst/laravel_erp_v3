@extends('layouts.erp')

@section('title', 'Leads & Opportunities')
@section('breadcrumb', 'Leads & Opportunities')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Leads & Opportunities</div>
      <div class="page-subtitle">Track sales pipeline and conversion</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalLead"
        data-route="{{ route('leads.store') }}" data-mode="create"><i
          class="bi bi-plus-lg"></i> New Lead</button>
    </div>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-3">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-funnel"></i></div>
        <div class="kpi-value">{{ $data->total() }}</div>
        <div class="kpi-label">Total Leads</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile yellow">
        <div class="kpi-icon yellow"><i class="bi bi-trophy"></i></div>
        <div class="kpi-value">26</div>
        <div class="kpi-label">Opportunities</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile green">
        <div class="kpi-icon green"><i class="bi bi-check2-all"></i></div>
        <div class="kpi-value">18</div>
        <div class="kpi-label">Won</div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="kpi-tile red">
        <div class="kpi-icon red"><i class="bi bi-x-circle"></i></div>
        <div class="kpi-value">9</div>
        <div class="kpi-label">Lost</div>
      </div>
    </div>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search leads & opportunities…" />
      </div>
      <select class="erp-form-control" style="width:140px" id="filter-stage">
        <option value="">All Status</option>
        <option>New</option>
        <option>Qualified</option>
        <option>Proposal</option>
        <option>Won</option>
        <option>Lost</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Lead</th>
            <th>Company</th>
            <th>Value</th>
            <th>Stage</th>
            <th>Assigned To</th>
            <th>Next Action</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $lead)
            <tr data-id="{{ $lead->id }}">
              <td>{{ $lead->lead_name }}</td>
              <td>{{ $lead->company }}</td>
              <td>${{ number_format($lead->deal_value ?? 0, 2) }}</td>
              <td>
                @if ($lead->stage == 'Won')
                  <span class="badge-status badge-active">Won</span>
                @elseif ($lead->stage == 'Lost')
                  <span class="badge-status badge-inactive">Lost</span>
                @elseif ($lead->stage == 'Proposal')
                  <span class="badge-status badge-info">Proposal</span>
                @elseif ($lead->stage == 'Qualified')
                  <span class="badge-status badge-pending">Qualified</span>
                @else
                  <span class="badge-status badge-info">{{ $lead->stage ?? 'New' }}</span>
                @endif
              </td>
              <td>{{ $lead->assigned_user_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalLead" title="Edit"
                    data-route="{{ route('leads.update', $lead->id) }}"
                    data-mode="edit"
                    data-lead='@json($lead)'><i class="bi bi-pencil"></i></button>
                  <button class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalDelete" title="Delete"
                    data-route="{{ route('leads.destroy', $lead->id) }}"
                    data-label="Lead"><i class="bi bi-trash"></i></button>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-between align-items-center mt-5">
      <div>
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }}
      </div>
      <div>
        {{ $data->links('pagination::bootstrap-5') }}
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalLead" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Add Lead / Opportunity</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-lead">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Lead Name</label>
                <input class="erp-form-control" type="text" name="lead_name" placeholder="" required />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Company</label>
                <input class="erp-form-control" type="text" name="company" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Email</label>
                <input class="erp-form-control" type="email" name="email" placeholder="" />
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Phone</label>
                <input class="erp-form-control" type="text" name="phone" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Deal Value ($)</label>
                <input class="erp-form-control" type="number" name="deal_value" placeholder="" />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Stage</label>
                <select class="erp-form-control" name="stage">
                  <option value="New">New</option>
                  <option value="Qualified">Qualified</option>
                  <option value="Proposal">Proposal</option>
                  <option value="Won">Won</option>
                  <option value="Lost">Lost</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Assigned To</label>
                <select class="erp-form-control" name="assigned_user_id">
                  <option value="">Select</option>
                  <option value="Sara L.">Sara L.</option>
                  <option value="James R.">James R.</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Notes</label>
                <textarea class="erp-form-control" name="notes" rows="2" placeholder=""></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Lead
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
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
@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modalLead = document.getElementById('modalLead');
    const modalDelete = document.getElementById('modalDelete');
    const formLead = document.getElementById('form-lead');
    let deleteUrl = null;

    modalLead.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      const mode = btn?.dataset.mode || 'create';
      const route = btn?.dataset.route || '{{ route("leads.store") }}';
      
      formLead.action = route;
      formLead.method = mode === 'create' ? 'POST' : 'PUT';
      
      const title = modalLead.querySelector('.modal-title');
      const submitBtn = modalLead.querySelector('.btn-modal-save');
      
      if (mode === 'edit') {
        title.textContent = 'Edit Lead / Opportunity';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Update Lead';
        
        const lead = JSON.parse(btn.dataset.lead);
        formLead.querySelector('[name="lead_name"]').value = lead.lead_name || '';
        formLead.querySelector('[name="company"]').value = lead.company || '';
        formLead.querySelector('[name="email"]').value = lead.email || '';
        formLead.querySelector('[name="phone"]').value = lead.phone || '';
        formLead.querySelector('[name="deal_value"]').value = lead.deal_value || '';
        formLead.querySelector('[name="stage"]').value = lead.stage || 'New';
        formLead.querySelector('[name="assigned_user_id"]').value = lead.assigned_user_id || '';
        formLead.querySelector('[name="notes"]').value = lead.notes || '';
      } else {
        title.textContent = 'Add Lead / Opportunity';
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Lead';
        formLead.reset();
      }
    });

    formLead.addEventListener('submit', async function(e) {
      e.preventDefault();
      const submitBtn = formLead.querySelector('button[type="submit"]');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Saving...';

      try {
        const formData = new FormData(formLead);
        const method = formLead.method;
        const url = formLead.action;

        const response = await fetch(url, {
          method: method,
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          },
          body: method === 'PUT' ? new URLSearchParams(formData) : formData
        });

        const result = await response.json();

        if (result.success) {
          bootstrap.Modal.getInstance(modalLead)?.hide();
          showToast(result.message || 'Lead saved successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to save lead', 'error');
        }
      } catch (error) {
        showToast('An error occurred while saving', 'error');
      } finally {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="bi bi-check2"></i> Save Lead';
      }
    });

    modalDelete.addEventListener('show.bs.modal', function(e) {
      const btn = e.relatedTarget;
      deleteUrl = btn?.dataset.route;
      const label = btn?.dataset.label || 'record';
      document.getElementById('delete-target').textContent = label;
    });

    document.getElementById('btn-confirm-delete').addEventListener('click', async function() {
      if (!deleteUrl) return;
      
      this.disabled = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Deleting...';

      try {
        const response = await fetch(deleteUrl, {
          method: 'DELETE',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
          }
        });

        const result = await response.json();

        if (result.success) {
          bootstrap.Modal.getInstance(modalDelete)?.hide();
          showToast(result.message || 'Deleted successfully', 'success');
          setTimeout(() => window.location.reload(), 1000);
        } else {
          showToast(result.message || 'Failed to delete', 'error');
        }
      } catch (error) {
        showToast('An error occurred while deleting', 'error');
      } finally {
        this.disabled = false;
        this.innerHTML = '<i class="bi bi-trash"></i> Delete';
      }
    });

    function showToast(message, type = 'success') {
      const toast = document.createElement('div');
      toast.className = `toast-notification toast-${type}`;
      toast.innerHTML = `
        <div class="toast-content">
          <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i>
          <span>${message}</span>
        </div>
      `;
      document.body.appendChild(toast);
      setTimeout(() => toast.remove(), 3000);
    }
  });
</script>
<style>
  .toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
    padding: 12px 20px;
    border-radius: 6px;
    color: white;
    animation: slideIn 0.3s ease;
  }
  .toast-success { background: #28a745; }
  .toast-error { background: #dc3545; }
  .toast-content { display: flex; align-items: center; gap: 10px; }
  @keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
  }
</style>
@endpush