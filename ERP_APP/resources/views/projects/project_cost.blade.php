@extends('layouts.erp')

@section('title', 'Project Cost Tracking')
@section('breadcrumb', 'Projects / Project Cost Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Project Cost Tracking</div>
      <div class="page-subtitle">Monitor budgets, expenses and cost variance per project</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalProjectCost"><i
          class="bi bi-plus-lg"></i> Log Cost</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search project cost tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>On Budget</option>
        <option>Over Budget</option>
        <option>Under Budget</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Project</th>
            <th>Budget</th>
            <th>Spent</th>
            <th>Remaining</th>
            <th>% Used</th>
            <th>Variance</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $cost)
            <tr>
              <td>{{ $cost->project_name ?? 'N/A' }}</td>
              <td>$0</td>
              <td>${{ number_format($cost->amount ?? 0, 2) }}</td>
              <td>$0</td>
              <td>0%</td>
              <td>$0</td>
              <td>
                @if ($cost->status == 'Approved')
                  <span class="badge-status badge-pending">On Budget</span>
                @else
                  <span class="badge-status badge-info">{{ $cost->status }}</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalProjectCost" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Cost" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalProjectCost" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">Log Project Cost</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Project</label><input class="erp-form-control"
                type="text" placeholder="Project name" /></div>
            <div class="col-md-6"><label class="erp-form-label">Cost Category</label><select class="erp-form-control">
                <option>Labor</option>
                <option>Material</option>
                <option>Overhead</option>
                <option>Software License</option>
              </select></div>
            <div class="col-md-4"><label class="erp-form-label">Amount ($)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Date Incurred</label><input class="erp-form-control"
                type="date" placeholder="" /></div>
            <div class="col-md-4"><label class="erp-form-label">Approved By</label><select class="erp-form-control">
                <option>Adam K.</option>
                <option>Sara L.</option>
              </select></div>
            <div class="col-md-12"><label class="erp-form-label">Description</label><textarea class="erp-form-control"
                rows="2" placeholder=""></textarea></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Log Cost
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