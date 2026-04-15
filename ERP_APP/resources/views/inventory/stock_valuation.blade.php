@extends('layouts.erp')

@section('title', 'Stock Valuation')
@section('breadcrumb', 'Stock Valuation')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Stock Valuation</div>
    <div class="page-subtitle">FIFO / LIFO / Average Cost methods</div>
  </div>
  <div class="d-flex gap-2">
    <select class="erp-form-control" style="width:150px">
      <option>FIFO</option>
      <option>LIFO</option>
      <option>Average Cost</option>
    </select>
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-valuation" data-bs-toggle="modal" data-bs-target="#modalStockValuation"><i class="bi bi-plus-lg"></i> Add Valuation</button>
  </div>
</div>
<div class="row g-3 mb-3">
  <div class="col-md-4">
    <div class="kpi-tile blue">
      <div class="kpi-icon blue"><i class="bi bi-currency-dollar"></i></div>
      <div class="kpi-value">$1.24M</div>
      <div class="kpi-label">Total Stock Value (FIFO)</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile yellow">
      <div class="kpi-icon yellow"><i class="bi bi-stack"></i></div>
      <div class="kpi-value">14,230</div>
      <div class="kpi-label">Total Units</div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="kpi-tile green">
      <div class="kpi-icon green"><i class="bi bi-graph-up"></i></div>
      <div class="kpi-value">$87.24</div>
      <div class="kpi-label">Avg Unit Value</div>
    </div>
  </div>
</div>
<div class="erp-card">
  <div class="erp-table-wrap">
    <table class="erp-table">
      <thead>
        <tr>
          <th>Product</th>
          <th>SKU</th>
          <th>Qty on Hand</th>
          <th>Cost Method</th>
          <th>Unit Cost</th>
          <th>Total Value</th>
          <th>Last Updated</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($data as $valuation)
        <tr>
          <td>{{ $valuation->product_id ?? 'N/A' }}</td>
          <td>—</td>
          <td>{{ $valuation->quantity_on_hand ?? 0 }}</td>
          <td>{{ $valuation->valuation_method ?? 'FIFO' }}</td>
          <td>${{ number_format($valuation->unit_cost ?? 0, 2) }}</td>
          <td>${{ number_format($valuation->total_value ?? 0, 2) }}</td>
          <td>{{ $valuation->updated_at ? \Carbon\Carbon::parse($valuation->updated_at)->format('Y-m-d') : 'N/A' }}</td>
          <td>
            <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
              data-id="{{ $valuation->id }}"
              data-product_id="{{ $valuation->product_id }}"
              data-quantity_on_hand="{{ $valuation->quantity_on_hand }}"
              data-valuation_method="{{ $valuation->valuation_method ?? 'FIFO' }}"
              data-unit_cost="{{ $valuation->unit_cost }}"
              data-total_value="{{ $valuation->total_value }}"
              data-bs-toggle="modal" data-bs-target="#modalStockValuation" title="Edit"><i class="bi bi-pencil"></i></button><button
              class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $valuation->id }}" data-product_id="{{ $valuation->product_id }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
              data-delete-label="Valuation" title="Delete"><i class="bi bi-trash"></i></button></div>
          </td>
        </tr>
        @empty
        <tr><td colspan="8" class="text-center text-muted">No stock valuations found.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalStockValuation" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add Stock Valuation</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="form-stock-valuation">
          @csrf
          <input type="hidden" name="id" id="valuation-id">
          <div class="row g-3">
            <div class="col-md-6"><label class="erp-form-label">Product</label><select class="erp-form-control" name="product_id" id="product_id">
              <option value="">Select Product</option>
            </select></div>
            <div class="col-md-6"><label class="erp-form-label">Valuation Method</label><select class="erp-form-control" name="valuation_method" id="valuation_method">
              <option value="FIFO">FIFO</option>
              <option value="LIFO">LIFO</option>
              <option value="Average Cost">Average Cost</option>
            </select></div>
            <div class="col-md-6"><label class="erp-form-label">Quantity on Hand</label><input class="erp-form-control" name="quantity_on_hand" id="quantity_on_hand" type="number" placeholder="" /></div>
            <div class="col-md-6"><label class="erp-form-label">Unit Cost ($)</label><input class="erp-form-control" name="unit_cost" id="unit_cost" type="number" placeholder="0.00" step="0.01" /></div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary" id="btn-save">
          <i class="bi bi-check2"></i> Save Valuation
        </button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:400px">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--accent-3)"><i class="bi bi-exclamation-triangle me-2"></i>Confirm Delete</h5>
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

@push('scripts')
  <script>
    $(function () {
      var routes = {
        store: '{{ route("stock_valuation.store") }}',
        update: '{{ route("stock_valuation.update", ":id") }}',
        destroy: '{{ route("stock_valuation.destroy", ":id") }}'
      };

      var $modal = $('#modalStockValuation');
      var $form = $('#form-stock-valuation');
      var $btnSave = $('#btn-save');
      var valuationId = null;
      var isEdit = false;

      $('#btn-add-valuation').on('click', function () {
        resetForm();
        isEdit = false;
        $('#modal-title').text('Add Stock Valuation');
      });

      $modal.on('shown.bs.modal', function () {
        if (!isEdit) {
          resetForm();
          $('#modal-title').text('Add Stock Valuation');
        }
      });

      $(document).on('click', '.btn-edit', function () {
        resetForm();
        isEdit = true;
        valuationId = $(this).data('id');
        $('#modal-title').text('Edit Stock Valuation');

        $('#valuation-id').val(valuationId);
        $('#product_id').val($(this).data('product_id'));
        $('#quantity_on_hand').val($(this).data('quantity_on_hand'));
        $('#valuation_method').val($(this).data('valuation_method'));
        $('#unit_cost').val($(this).data('unit_cost'));
      });

      $(document).on('click', '.btn-delete', function () {
        valuationId = $(this).data('id');
        var product_id = $(this).data('product_id');
        $('#delete-target').text(product_id || 'this valuation');
      });

      $('#btn-confirm-delete').on('click', function () {
        $.ajax({
          url: routes.destroy.replace(':id', valuationId),
          method: 'DELETE',
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          success: function (res) {
            if (res.success) {
              showToast(res.message || 'Valuation deleted', 'success');
              $('#modalDelete').modal('hide');
              setTimeout(() => location.reload(), 1000);
            }
          },
          error: function (xhr) {
            showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
          }
        });
      });

      $btnSave.on('click', function () {
        $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

        var url = isEdit ? routes.update.replace(':id', valuationId) : routes.store;
        var method = isEdit ? 'PUT' : 'POST';

        $.ajax({
          url: url,
          method: method,
          data: $form.serialize(),
          headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          success: function (res) {
            if (res.success) {
              showToast(res.message || (isEdit ? 'Valuation updated' : 'Valuation created'), 'success');
              $modal.modal('hide');
              setTimeout(() => location.reload(), 1000);
            }
          },
          error: function (xhr) {
            var res = xhr.responseJSON;
            if (res && res.errors) {
              $.each(res.errors, function (field, messages) {
                var $input = $form.find('[name="' + field + '"]');
                $input.addClass('is-invalid');
              });
              showToast('Please check the form for errors', 'error');
            } else if (res && res.message) {
              showToast(res.message, 'error');
            } else {
              showToast('An error occurred', 'error');
            }
          },
          complete: function () {
            $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Valuation');
          }
        });
      });

      function resetForm() {
        valuationId = null;
        isEdit = false;
        $form[0].reset();
        $form.find('.is-invalid').removeClass('is-invalid');
      }

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
    });
  </script>
@endpush
@endsection