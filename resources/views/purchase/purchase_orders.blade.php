@extends('layouts.erp')

@section('title', 'Purchase Orders')
@section('breadcrumb', 'Purchase Orders')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Purchase Orders</div>
    <div class="page-subtitle">Create, approve and track purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-po"><i class="bi bi-plus-lg"></i> New PO</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search purchase orders…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Pending</option><option>Approved</option><option>Received</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>PO #</th><th>Supplier</th><th>Date</th><th>Items</th><th>Total</th><th>Status</th><th>Approved By</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $po)
          <tr>
            <td>{{ $po->po_number }}</td>
             <td>{{ $po->supplier->company_name ?? 'N/A' }}</td>
            <td>{{ $po->order_date ? \Carbon\Carbon::parse($po->order_date)->format('Y-m-d') : 'N/A' }}</td>
             <td>{{ $po->warehouse->warehouse_name ?? 'N/A' }}</td>
            <td>${{ number_format($po->total_amount, 2) }}</td>
            <td>
              @if ($po->status == 'Approved')
                <span class="badge-status badge-info">Approved</span>
              @elseif ($po->status == 'Pending')
                <span class="badge-status badge-pending">Pending</span>
              @elseif ($po->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @else
                <span class="badge-status badge-inactive">{{ $po->status }}</span>
              @endif
            </td>
            <td>—</td>
            <td><div class="d-flex gap-1">
               <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                 data-id="{{ $po->id }}"
                 data-po_number="{{ $po->po_number }}"
                 data-supplier_id="{{ $po->supplier_id }}"
                 data-order_date="{{ $po->order_date }}"
                 data-expected_delivery_date="{{ $po->expected_delivery_date }}"
                 data-warehouse_id="{{ $po->warehouse_id }}"
                 data-payment_terms="{{ $po->payment_terms }}"
                 data-total_amount="{{ $po->total_amount }}"
                 data-status="{{ $po->status }}"
                 title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-id="{{ $po->id }}"
                data-po_number="{{ $po->po_number }}"
                title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No purchase orders found.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-between align-items-center mt-5">
    <div>
      Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() ?? 0 }}
    </div>
    <div>
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<div class="modal fade" id="modalPO" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">Create Purchase Order</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-po">
        <div class="modal-body">
          <input type="hidden" name="id" id="po-id" value="" />
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="erp-form-label">Supplier</label>
              <select class="erp-form-control" name="supplier_id" id="supplier-id" required>
                <option value="">Select Supplier</option>
              </select>
              <div class="invalid-feedback" id="error-supplier_id"></div>
            </div>
             <div class="col-md-3">
               <label class="erp-form-label">Order Date</label>
               <input class="erp-form-control" type="date" name="order_date" id="order-date" required />
               <div class="invalid-feedback" id="error-order_date"></div>
             </div>
             <div class="col-md-3">
               <label class="erp-form-label">Expected Delivery</label>
               <input class="erp-form-control" type="date" name="expected_delivery_date" id="expected-delivery" />
               <div class="invalid-feedback" id="error-expected_delivery_date"></div>
             </div>
            <div class="col-md-6">
              <label class="erp-form-label">Warehouse</label>
              <select class="erp-form-control" name="warehouse_id" id="warehouse-id" required>
                <option value="">Select Warehouse</option>
              </select>
              <div class="invalid-feedback" id="error-warehouse_id"></div>
            </div>
            <div class="col-md-6">
              <label class="erp-form-label">Payment Terms</label>
              <select class="erp-form-control" name="payment_terms" id="payment-terms">
                <option value="Net 30">Net 30</option>
                <option value="Net 60">Net 60</option>
                <option value="Prepaid">Prepaid</option>
              </select>
              <div class="invalid-feedback" id="error-payment_terms"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Status</label>
               <select class="erp-form-control" name="status" id="status">
                 <option value="Draft">Draft</option>
                 <option value="Pending">Pending</option>
                 <option value="Approved">Approved</option>
                 <option value="Received">Received</option>
               </select>
               <div class="invalid-feedback" id="error-status"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">PO Number</label>
               <input class="erp-form-control" type="text" name="po_number" id="po-number" placeholder="PO-XXX" required />
               <div class="invalid-feedback" id="error-po_number"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">Total Amount ($)</label>
               <input class="erp-form-control" type="number" name="total_amount" id="total-amount" step="0.01" required />
               <div class="invalid-feedback" id="error-total_amount"></div>
             </div>
          </div>
          <label class="erp-form-label">Order Items</label>
          <div class="erp-table-wrap"><table class="erp-table"><thead><tr><th>Product</th><th>Qty</th><th>Unit Cost</th><th>Total</th></tr></thead>
          <tbody><tr>
            <td><input class="erp-form-control" placeholder="Product name" style="min-width:160px"/></td>
            <td><input class="erp-form-control" type="number" style="width:80px" placeholder="1"/></td>
            <td><input class="erp-form-control" type="number" style="width:100px" placeholder="0.00"/></td>
            <td style="color:var(--accent);font-family:'IBM Plex Mono',monospace">$0.00</td>
          </tr></tbody></table></div>
          <button class="btn-erp btn-outline btn-sm mt-2"><i class="bi bi-plus"></i> Add Line</button>
          <div class="d-flex justify-content-end mt-3"><div class="text-end">
            <div class="stat-row-label">Subtotal: <span class="stat-row-val">$0.00</span></div>
            <div class="stat-row-label">Tax (10%): <span class="stat-row-val">$0.00</span></div>
            <div style="font-size:15px;font-weight:700;color:var(--text-primary);margin-top:6px">Total: $0.00</div>
          </div></div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Submit PO
          </button>
        </div>
      </form>
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
 $(function() {
   var routes = {
     store: '{{ route("purchase_orders.store") }}',
     update: '{{ route("purchase_orders.update", ":id") }}',
     destroy: '{{ route("purchase_orders.destroy", ":id") }}',
     suppliersAll: '{{ route("suppliers.all") }}',
     warehousesAll: '{{ route("warehouses.all") }}'
   };

   var $modal = $('#modalPO');
   var $form = $('#form-po');
   var $btnSave = $('#btn-save');
   var poId = null;
   var isEdit = false;

   // Load suppliers dropdown via AJAX
   function loadSuppliers() {
     $.ajax({
       url: routes.suppliersAll,
       method: 'GET',
       success: function(res) {
         if (res.success && res.data) {
           var $sup = $('#supplier-id');
           $sup.empty().append('<option value="">Select Supplier</option>');
           $.each(res.data, function(i, s) {
             $sup.append('<option value="' + s.id + '">' + s.company_name + '</option>');
           });
         }
       },
       error: function(xhr) {
         console.warn('Failed to load suppliers');
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
           var $wh = $('#warehouse-id');
           $wh.empty().append('<option value="">Select Warehouse</option>');
           $.each(res.data, function(i, w) {
             $wh.append('<option value="' + w.id + '">' + w.warehouse_name + ' (' + w.warehouse_code + ')</option>');
           });
         }
       },
       error: function(xhr) {
         console.warn('Failed to load warehouses');
       }
     });
   }

   // Load data on page ready
   loadSuppliers();
   loadWarehouses();

   $('#btn-add-po').on('click', function() {
     resetForm();
     isEdit = false;
     $('#modal-title').text('Create Purchase Order');
     $modal.modal('show');
   });

   $(document).on('click', '.btn-edit', function() {
     resetForm();
     isEdit = true;
     poId = $(this).data('id');
     $('#modal-title').text('Edit Purchase Order');

      $('#po-id').val(poId);
      $('#po-number').val($(this).data('po_number'));
      $('#supplier-id').val($(this).data('supplier_id'));
      $('#order-date').val($(this).data('order_date'));
      $('#expected-delivery').val($(this).data('expected_delivery_date'));
      $('#warehouse-id').val($(this).data('warehouse_id'));
      $('#payment-terms').val($(this).data('payment_terms') || 'Net 30');
      $('#total-amount').val($(this).data('total_amount'));
      $('#status').val($(this).data('status') || 'Draft');

     $modal.modal('show');
   });

   $(document).on('click', '.btn-delete', function() {
     poId = $(this).data('id');
     var po_number = $(this).data('po_number');
     $('#delete-target').text(po_number || 'this PO');
     $('#modalDelete').modal('show');
   });

   $('#btn-confirm-delete').on('click', function() {
     $.ajax({
       url: routes.destroy.replace(':id', poId),
       method: 'DELETE',
       headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
       success: function(res) {
         if (res.success) {
           showToast(res.message || 'Purchase order deleted', 'success');
           $('#modalDelete').modal('hide');
           setTimeout(() => location.reload(), 1000);
         }
       },
       error: function(xhr) {
         showToast(xhr.responseJSON?.message || 'Delete failed', 'error');
       }
     });
   });

   $form.on('submit', function(e) {
     e.preventDefault();
     $btnSave.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');

     var url = isEdit ? routes.update.replace(':id', poId) : routes.store;
     var method = isEdit ? 'PUT' : 'POST';

     $.ajax({
       url: url,
       method: method,
       data: $form.serialize(),
       headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
       success: function(res) {
         if (res.success) {
           showToast(res.message || (isEdit ? 'Purchase order updated' : 'Purchase order created'), 'success');
           $modal.modal('hide');
           setTimeout(() => location.reload(), 1000);
         }
       },
       error: function(xhr) {
         var res = xhr.responseJSON;
         if (res && res.errors) {
           // Clear previous errors
           $form.find('.is-invalid').removeClass('is-invalid');
           $form.find('.invalid-feedback').hide().text('');
           
           // Show each field error
           var firstError = null;
           $.each(res.errors, function(field, messages) {
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
       complete: function() {
         $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Submit PO');
       }
     });
   });

   function resetForm() {
     poId = null;
     isEdit = false;
     $form[0].reset();
     $form.find('.is-invalid').removeClass('is-invalid');
     $form.find('.invalid-feedback').hide().text('');
   }

   function showToast(msg, type) {
     type = type || 'info';
     var icon = type === 'success' ? '✓' : type === 'error' ? '✕' : 'ℹ';
     var color = type === 'success' ? 'var(--accent-2)' : type === 'error' ? 'var(--accent-3)' : 'var(--accent)';
     var $t = $('<div class="erp-toast ' + type + '"></div>')
       .html('<span style="font-weight:700;color:' + color + '">' + icon + '</span> ' + msg);
     $('#toast-container').append($t);
     setTimeout(function() { $t.css('opacity', 0); }, 2500);
     setTimeout(function() { $t.remove(); }, 2800);
   }
 });
 </script>
 @endpush
@endsection