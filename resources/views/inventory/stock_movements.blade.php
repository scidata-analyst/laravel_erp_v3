@extends('layouts.erp')

@section('title', 'Stock In / Out')
@section('breadcrumb', 'Inventory / Stock In / Out')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Stock In / Out</div>
      <div class="page-subtitle">Warehouse-wise stock movement log</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-movement" data-bs-toggle="modal" data-bs-target="#modalStockMove"><i
          class="bi bi-plus-lg"></i> New Movement</button>
    </div>
  </div>
  <div class="row g-3 mb-3">
    <div class="col-md-4">
      <div class="kpi-tile green">
        <div class="kpi-icon green"><i class="bi bi-box-arrow-in-down"></i></div>
        <div class="kpi-value">+4,820</div>
        <div class="kpi-label">Stock In (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile red">
        <div class="kpi-icon red"><i class="bi bi-box-arrow-up-right"></i></div>
        <div class="kpi-value">-3,142</div>
        <div class="kpi-label">Stock Out (This Month)</div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="kpi-tile blue">
        <div class="kpi-icon blue"><i class="bi bi-boxes"></i></div>
        <div class="kpi-value">14,230</div>
        <div class="kpi-label">Net Current Stock</div>
      </div>
    </div>
  </div>
  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search stock in / out…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Stock In</option>
        <option>Stock Out</option>
        <option>Transfer</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>Ref #</th>
            <th>Date</th>
            <th>Product</th>
            <th>Type</th>
            <th>Qty</th>
            <th>Warehouse</th>
            <th>Reason</th>
            <th>User</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $movement)
            <tr>
              <td>MV-{{ $movement->id }}</td>
              <td>{{ $movement->created_at ? \Carbon\Carbon::parse($movement->created_at)->format('Y-m-d') : 'N/A' }}</td>
               <td>{{ $movement->product->product_name ?? 'N/A' }}</td>
              <td>
                @if ($movement->movement_type == 'Stock In')
                  <span class="badge-status badge-info">Stock In</span>
                @elseif ($movement->movement_type == 'Stock Out')
                  <span class="badge-status badge-info">Stock Out</span>
                @else
                  <span class="badge-status badge-info">{{ $movement->movement_type }}</span>
                @endif
              </td>
              <td>{{ $movement->quantity }}</td>
               <td>{{ $movement->fromWarehouse->warehouse_name ?? 'N/A' }} → {{ $movement->toWarehouse->warehouse_name ?? 'N/A' }}</td>
              <td>{{ $movement->reason ?? 'N/A' }}</td>
              <td>—</td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $movement->id }}"
                    data-product_id="{{ $movement->product_id }}"
                    data-movement_type="{{ $movement->movement_type }}"
                    data-quantity="{{ $movement->quantity }}"
                    data-from_warehouse_id="{{ $movement->from_warehouse_id ?? '' }}"
                    data-to_warehouse_id="{{ $movement->to_warehouse_id ?? '' }}"
                    data-reason="{{ $movement->reason ?? '' }}"
                    data-bs-toggle="modal" data-bs-target="#modalStockMove" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $movement->id }}" data-movement_type="{{ $movement->movement_type }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Movement" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalStockMove" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">New Stock Movement</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-stock-movement">
            @csrf
            <input type="hidden" name="id" id="movement-id">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="erp-form-label">Product</label>
                <select class="erp-form-control" name="product_id" id="product_id" required>
                  <option value="">Select Product</option>
                </select>
                <div class="invalid-feedback" id="error-product_id"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Movement Type</label>
                <select class="erp-form-control" name="movement_type" id="movement_type" required>
                  <option value="Stock In">Stock In</option>
                  <option value="Stock Out">Stock Out</option>
                  <option value="Transfer">Transfer</option>
                </select>
                <div class="invalid-feedback" id="error-movement_type"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Quantity</label>
                <input class="erp-form-control" name="quantity" id="quantity" type="number" placeholder="" required min="1" />
                <div class="invalid-feedback" id="error-quantity"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">From Warehouse</label>
                <select class="erp-form-control" name="from_warehouse_id" id="from_warehouse_id">
                  <option value="">Select</option>
                </select>
                <div class="invalid-feedback" id="error-from_warehouse_id"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">To Warehouse</label>
                <select class="erp-form-control" name="to_warehouse_id" id="to_warehouse_id">
                  <option value="">Select</option>
                </select>
                <div class="invalid-feedback" id="error-to_warehouse_id"></div>
              </div>
              <div class="col-md-12">
                <label class="erp-form-label">Reason / Notes</label>
                <textarea class="erp-form-control" name="reason" id="reason" rows="2" placeholder=""></textarea>
                <div class="invalid-feedback" id="error-reason"></div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save">
            <i class="bi bi-check2"></i> Record Movement
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

   @push('scripts')
     <script>
       $(function () {
         var routes = {
           store: '{{ route("stock_movements.store") }}',
           update: '{{ route("stock_movements.update", ":id") }}',
           destroy: '{{ route("stock_movements.destroy", ":id") }}',
           productsAll: '{{ route("product_catalog.all") }}',
           warehousesAll: '{{ route("warehouses.all") }}'
         };

         var $modal = $('#modalStockMove');
         var $form = $('#form-stock-movement');
         var $btnSave = $('#btn-save');
         var movementId = null;
         var isEdit = false;

         // Load products dropdown via AJAX
         function loadProducts() {
           $.ajax({
             url: routes.productsAll,
             method: 'GET',
             success: function(res) {
               if (res.success && res.data) {
                 var $prod = $('#product_id');
                 $prod.empty().append('<option value="">Select Product</option>');
                 $.each(res.data, function(i, p) {
                   $prod.append('<option value="' + p.id + '">' + p.product_name + ' (' + p.sku + ')</option>');
                 });
               }
             },
             error: function(xhr) {
               console.warn('Failed to load products');
             }
           });
         }

         // Load warehouses dropdown via AJAX
         function loadWarehouses() {
           $.ajax({
             url: routes.warehousesAll,
             method: 'GET',
             success: function(res) {
               if (res.success && res.data) {
                 var $from = $('#from_warehouse_id');
                 var $to = $('#to_warehouse_id');
                 $from.empty().append('<option value="">Select</option>');
                 $to.empty().append('<option value="">Select</option>');
                 $.each(res.data, function(i, w) {
                   var opt = '<option value="' + w.id + '">' + w.warehouse_name + ' (' + w.warehouse_code + ')</option>';
                   $from.append(opt);
                   $to.append(opt);
                 });
               }
             },
             error: function(xhr) {
               console.warn('Failed to load warehouses');
             }
           });
         }

         // Toggle warehouse fields based on movement type
         function toggleWarehouseFields() {
           var type = $('#movement_type').val();
           if (type === 'Transfer') {
             $('#from_warehouse_id').closest('.col-md-4').show();
             $('#to_warehouse_id').closest('.col-md-4').show();
           } else if (type === 'Stock In') {
             $('#from_warehouse_id').closest('.col-md-4').hide();
             $('#to_warehouse_id').closest('.col-md-4').show();
             $('#from_warehouse_id').val('');
           } else if (type === 'Stock Out') {
             $('#from_warehouse_id').closest('.col-md-4').show();
             $('#to_warehouse_id').closest('.col-md-4').hide();
             $('#to_warehouse_id').val('');
           }
         }

         // Load data on page ready
         loadProducts();
         loadWarehouses();

         $('#btn-add-movement').on('click', function () {
           resetForm();
           isEdit = false;
           $('#modal-title').text('New Stock Movement');
         });

         $modal.on('shown.bs.modal', function () {
           if (!isEdit) {
             resetForm();
             $('#modal-title').text('New Stock Movement');
           }
         });

         $(document).on('click', '.btn-edit', function () {
           resetForm();
           isEdit = true;
           movementId = $(this).data('id');
           $('#modal-title').text('Edit Stock Movement');

           $('#movement-id').val(movementId);
           $('#product_id').val($(this).data('product_id'));
           $('#movement_type').val($(this).data('movement_type'));
           $('#quantity').val($(this).data('quantity'));
           $('#from_warehouse_id').val($(this).data('from_warehouse_id'));
           $('#to_warehouse_id').val($(this).data('to_warehouse_id'));
           $('#reason').val($(this).data('reason'));

           // Trigger toggle after setting values
           toggleWarehouseFields();
         });

         // Toggle warehouse fields when movement type changes
         $('#movement_type').on('change', toggleWarehouseFields);

         $(document).on('click', '.btn-delete', function () {
           movementId = $(this).data('id');
           var movement_type = $(this).data('movement_type');
           $('#delete-target').text(movement_type || 'this movement');
         });

         $('#btn-confirm-delete').on('click', function () {
           $.ajax({
             url: routes.destroy.replace(':id', movementId),
             method: 'DELETE',
             headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
             success: function (res) {
               if (res.success) {
                 showToast(res.message || 'Movement deleted', 'success');
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

           var url = isEdit ? routes.update.replace(':id', movementId) : routes.store;
           var method = isEdit ? 'PUT' : 'POST';

           $.ajax({
             url: url,
             method: method,
             data: $form.serialize(),
             headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
             success: function (res) {
               if (res.success) {
                 showToast(res.message || (isEdit ? 'Movement updated' : 'Movement recorded'), 'success');
                 $modal.modal('hide');
                 setTimeout(() => location.reload(), 1000);
               }
             },
             error: function (xhr) {
               var res = xhr.responseJSON;
               if (res && res.errors) {
                 // Clear previous errors
                 $form.find('.is-invalid').removeClass('is-invalid');
                 $form.find('.invalid-feedback').hide().text('');
                 
                 // Show each field error
                 var firstError = null;
                 $.each(res.errors, function (field, messages) {
                   var $input = $form.find('[name="' + field + '"]');
                   $input.addClass('is-invalid');
                   $('#error-' + field).text(messages[0]).show();
                   if (!firstError) firstError = messages[0];
                 });
                 
                 if (firstError) {
                   showToast(firstError, 'error');
                 } else {
                   showToast('Please correct the errors in the form', 'error');
                 }
               } else if (res && res.message) {
                 showToast(res.message, 'error');
               } else {
                 showToast('An error occurred', 'error');
               }
             },
             complete: function () {
               $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Record Movement');
             }
           });
         });

         function resetForm() {
           movementId = null;
           isEdit = false;
           $form[0].reset();
           $form.find('.is-invalid').removeClass('is-invalid');
           $form.find('.invalid-feedback').hide().text('');
           // Reset warehouse visibility
           $('#from_warehouse_id').closest('.col-md-4').show();
           $('#to_warehouse_id').closest('.col-md-4').show();
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