@extends('layouts.erp')

@section('title', 'Bill of Materials')
@section('breadcrumb', 'Production / Bill of Materials')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Bill of Materials</div>
      <div class="page-subtitle">Define bill of materials for manufactured products</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalBOM"><i
          class="bi bi-plus-lg"></i> New BOM</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search bill of materials…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Active</option>
        <option>Draft</option>
        <option>Archived</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>BOM #</th>
            <th>Product</th>
            <th>Version</th>
            <th>Components</th>
            <th>Est. Cost</th>
            <th>Lead Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $bom)
            <tr>
              <td>BOM-{{ $bom->id }}</td>
              <td>{{ $bom->finished_product_name }}</td>
              <td>{{ $bom->version ?? 'v1.0' }}</td>
              <td>0 components</td>
              <td>$0.00</td>
              <td>{{ $bom->lead_time_days ?? 0 }} days</td>
              <td>
                @if ($bom->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @elseif ($bom->status == 'Draft')
                  <span class="badge-status badge-info">Draft</span>
                @else
                  <span class="badge-status badge-inactive">Archived</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon" data-bs-toggle="modal"
                    data-bs-target="#modalBOM" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="BOM" title="Delete"><i class="bi bi-trash"></i></button></div>
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


  <div class="modal fade" id="modalBOM" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Bill of Materials</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Finished Product</label><input class="erp-form-control"
                type="text" placeholder="Product name" /></div>
            <div class="col-md-3"><label class="erp-form-label">Version</label><input class="erp-form-control"
                type="text" placeholder="v1.0" /></div>
            <div class="col-md-3"><label class="erp-form-label">Lead Time (days)</label><input class="erp-form-control"
                type="number" placeholder="" /></div>
            <div class="col-md-12"><label class="erp-form-label">Components
                <div class="erp-table-wrap mt-1">
                  <table class="erp-table">
                    <thead>
                      <tr>
                        <th>Component</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Cost</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><input class="erp-form-control" placeholder="Component name" /></td>
                        <td><input class="erp-form-control" type="number" style="width:70px" /></td>
                        <td><select class="erp-form-control">
                            <option>pcs</option>
                            <option>kg</option>
                            <option>m</option>
                          </select></td>
                        <td><input class="erp-form-control" type="number" style="width:90px" placeholder="$0.00" /></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <button class="btn-erp btn-outline btn-sm mt-2"><i class="bi bi-plus"></i> Add Component</button>
              </label></div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save">
            <i class="bi bi-check2"></i> Save BOM
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
@endsection