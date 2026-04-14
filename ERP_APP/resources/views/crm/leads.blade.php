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
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalLead"><i
          class="bi bi-plus-lg"></i> New Lead</button>
    </div>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-3">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-funnel"></i></div>
        <div class="kpi-value">84</div>
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
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
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
            <tr>
              <td>{{ $lead->lead_name }}</td>
              <td>{{ $lead->company }}</td>
              <td>${{ number_format($lead->deal_value, 2) }}</td>
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
                  <span class="badge-status badge-info">{{ $lead->stage }}</span>
                @endif
              </td>
              <td>{{ $lead->assigned_user_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalLead" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Lead" title="Delete"><i class="bi bi-trash"></i></button></div>
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
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Lead Name</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Company</label><input class="erp-form-control"
                type="text" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Email</label><input class="erp-form-control"
                type="email" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Phone</label><input class="erp-form-control" type="text"
                placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Deal Value ($)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Stage</label><select class="erp-form-control">
                <option>New</option>
                <option>Qualified</option>
                <option>Proposal</option>
                <option>Won</option>
                <option>Lost</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Assigned To</label><select class="erp-form-control">
                <option>Sara L.</option>
                <option>James R.</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Notes</label><textarea class="erp-form-control"
                rows="2" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save Lead
          </button>
        </div>
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