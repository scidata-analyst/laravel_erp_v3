@extends('layouts.erp')

@section('title', 'Performance Tracking')
@section('breadcrumb', 'Human Resources / Performance Tracking')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Performance Tracking</div>
      <div class="page-subtitle">Employee KPI tracking and performance review cycles</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" data-bs-toggle="modal" data-bs-target="#modalPerformance"><i
          class="bi bi-plus-lg"></i> New Review</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search performance tracking…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Excellent</option>
        <option>Good</option>
        <option>Satisfactory</option>
        <option>Poor</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Employee</th>
            <th>Department</th>
            <th>Review Period</th>
            <th>KPI Score</th>
            <th>Goal Achievement</th>
            <th>Rating</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $perf)
            <tr data-id="{{ $perf->id }}">
              <td>{{ $perf->employee_id ?? 'N/A' }}</td>
              <td>—</td>
              <td>{{ $perf->review_period ?? 'N/A' }}</td>
              <td>{{ $perf->kpi_score }}/100</td>
              <td>{{ $perf->goal_achievement }}%</td>
              <td>{{ $perf->overall_rating }}</td>
              <td>
                @if ($perf->status == 'Completed')
                  <span class="badge-status badge-active">Completed</span>
                @else
                  <span class="badge-status badge-pending">In Review</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1">
                  <button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $perf->id }}"
                    data-url="{{ route('performance.show', $perf->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalPerformance"
                    title="Edit">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn-erp btn-danger btn-xs btn-icon btn-delete" 
                    data-id="{{ $perf->id }}"
                    data-url="{{ route('performance.destroy', $perf->id) }}"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDelete"
                    data-delete-label="Review"
                    title="Delete">
                    <i class="bi bi-trash"></i>
                  </button>
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

  <div class="modal fade" id="modalPerformance" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" style="color:var(--text-primary);font-weight:600">New Performance Review</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form id="form-performance" method="POST">
          @csrf
          <input type="hidden" name="_method" value="POST" id="form-method">
          <input type="hidden" name="id" id="performance_id">
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Employee</label>
                <select class="erp-form-control" name="employee_id" required>
                  <option value="">Select Employee</option>
                  <option>Adam Khan</option>
                  <option>Sara Lee</option>
                  <option>James R.</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Review Period</label>
                <select class="erp-form-control" name="review_period" required>
                  <option value="Q1 2025">Q1 2025</option>
                  <option value="Q4 2024">Q4 2024</option>
                  <option value="Annual 2024">Annual 2024</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">KPI Score (/ 100)</label>
                <input class="erp-form-control" type="number" name="kpi_score" placeholder="" min="0" max="100" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Goal Achievement (%)</label>
                <input class="erp-form-control" type="number" name="goal_achievement" placeholder="" min="0" max="100" required />
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Overall Rating</label>
                <select class="erp-form-control" name="overall_rating" required>
                  <option value="Excellent">Excellent</option>
                  <option value="Good">Good</option>
                  <option value="Satisfactory">Satisfactory</option>
                  <option value="Poor">Poor</option>
                </select>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Reviewer Comments</label>
                <textarea class="erp-form-control" name="comments" rows="3" placeholder=""></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer" style="border-color:var(--border)">
            <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn-erp btn-primary btn-modal-save">
              <i class="bi bi-check2"></i> Save Review
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
(function() {
  const ROUTE_STORE = '{{ route("performance.store") }}';
  const ROUTE_UPDATE = '{{ route("performance.update", ["id" => "__ID__"]) }}';
  const ROUTE_DESTROY = '{{ route("performance.destroy", ["id" => "__ID__"]) }}';
  let deleteUrl = null;

  function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle' : 'x-circle'}"></i> ${message}`;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
  }

  function resetForm() {
    $('#form-performance')[0].reset();
    $('#form-method').val('POST');
    $('#performance_id').val('');
    $('#modalPerformance .modal-title').text('New Performance Review');
  }

  $('#modalPerformance').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (btn.classList.contains('btn-edit')) {
      const id = btn.dataset.id;
      $.ajax({
        url: btn.dataset.url,
        method: 'GET',
        success: function(data) {
          $('#form-method').val('PUT');
          $('#performance_id').val(data.id);
          $('#modalPerformance .modal-title').text('Edit Performance Review');
          $('#form-performance select[name="employee_id"]').val(data.employee_id);
          $('#form-performance select[name="review_period"]').val(data.review_period);
          $('#form-performance input[name="kpi_score"]').val(data.kpi_score);
          $('#form-performance input[name="goal_achievement"]').val(data.goal_achievement);
          $('#form-performance select[name="overall_rating"]').val(data.overall_rating);
          $('#form-performance textarea[name="comments"]').val(data.comments);
        }
      });
    } else {
      resetForm();
    }
  });

  $('#form-performance').on('submit', function(e) {
    e.preventDefault();
    const id = $('#performance_id').val();
    const url = id ? ROUTE_UPDATE.replace('__ID__', id) : ROUTE_STORE;
    const method = id ? 'PUT' : 'POST';

    $.ajax({
      url: url,
      method: method,
      data: $(this).serialize(),
      success: function() {
        $('#modalPerformance').modal('hide');
        showToast(id ? 'Review updated successfully' : 'Review created successfully');
        setTimeout(() => location.reload(), 500);
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Operation failed', 'error');
      }
    });
  });

  $('#modalDelete').on('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    deleteUrl = btn.dataset.url;
    $('#delete-target').text(btn.dataset.deleteLabel || 'record');
  });

  $('#btn-confirm-delete').on('click', function() {
    $.ajax({
      url: deleteUrl,
      method: 'DELETE',
      data: { _token: '{{ csrf_token() }}' },
      success: function() {
        $('#modalDelete').modal('hide');
        showToast('Record deleted successfully');
        setTimeout(() => location.reload(), 500);
      },
      error: function(xhr) {
        showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
      }
    });
  });
})();
</script>
@endpush