@extends('layouts.erp')

@section('title', 'Goods Receipt Notes')
@section('breadcrumb', 'Goods Receipt Notes')

@section('content')
<div class="page-header">
  <div>
    <div class="page-title">Goods Receipt Notes</div>
    <div class="page-subtitle">Record goods received from suppliers against purchase orders</div>
  </div>
  <div class="d-flex gap-2">
    <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
    <button class="btn-erp btn-primary" id="btn-add-grn"><i class="bi bi-plus-lg"></i> New GRN</button>
  </div>
</div>

<div class="erp-card">
  <div class="table-toolbar">
    <div class="search-input">
      <span class="si"><i class="bi bi-search"></i></span>
      <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search goods receipt notes…"/>
    </div>
    <select class="erp-form-control" style="width:140px"><option>All Status</option><option>Draft</option><option>Received</option><option>Partial</option></select>
  </div>
  <div class="erp-table-wrap">
    <table class="erp-table" id="tbl-main">
      <thead><tr><th>GRN #</th><th>PO Reference</th><th>Supplier</th><th>Received Date</th><th>Items</th><th>Total Value</th><th>Status</th><th>Actions</th></tr></thead>
      <tbody>
        @forelse ($data as $grn)
          <tr>
            <td>{{ $grn->grn_number }}</td>
             <td>{{ $grn->purchaseOrder->po_number ?? 'N/A' }}</td>
             <td>{{ $grn->supplier_name ?? 'N/A' }}</td>
            <td>{{ $grn->receipt_date ? \Carbon\Carbon::parse($grn->receipt_date)->format('Y-m-d') : 'N/A' }}</td>
            <td>1 items</td>
            <td>$0</td>
            <td>
              @if ($grn->status == 'Received')
                <span class="badge-status badge-active">Received</span>
              @elseif ($grn->status == 'Partial')
                <span class="badge-status badge-pending">Partial</span>
              @else
                <span class="badge-status badge-info">Draft</span>
              @endif
            </td>
            <td><div class="d-flex gap-1">
              <button class="btn-erp btn-outline btn-xs btn-icon btn-edit"
                data-id="{{ $grn->id }}"
                data-grn_number="{{ $grn->grn_number }}"
                data-purchase_order_id="{{ $grn->purchase_order_id }}"
                data-supplier_name="{{ $grn->supplier_name }}"
                data-receipt_date="{{ $grn->receipt_date }}"
                 data-warehouse_id="{{ $grn->warehouse_id }}"
                data-notes="{{ $grn->notes }}"
                data-status="{{ $grn->status }}"
                title="Edit">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn-erp btn-danger btn-xs btn-icon btn-delete"
                data-id="{{ $grn->id }}"
                data-grn_number="{{ $grn->grn_number }}"
                title="Delete">
                <i class="bi bi-trash"></i>
              </button>
            </div></td>
          </tr>
        @empty
          <tr>
            <td colspan="8" class="text-center text-muted">No GRN records found.</td>
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

<div class="modal fade" id="modalGRN" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content" style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
      <div class="modal-header" style="border-color:var(--border)">
        <h5 class="modal-title" style="color:var(--text-primary);font-weight:600" id="modal-title">New Goods Receipt Note</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form id="form-grn">
        <div class="modal-body">
          <input type="hidden" name="id" id="grn-id" value="" />
          <div class="row g-3">
            <div class="col-md-6">
              <label class="erp-form-label">Purchase Order</label>
              <select class="erp-form-control" name="purchase_order_id" id="purchase-order-id" required>
                <option value="">Select PO</option>
              </select>
              <div class="invalid-feedback" id="error-purchase_order_id"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Supplier</label>
               <input class="erp-form-control" type="text" name="supplier_name" id="supplier-name" placeholder="TechSource Ltd." required />
               <div class="invalid-feedback" id="error-supplier_name"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">GRN Number</label>
               <input class="erp-form-control" type="text" name="grn_number" id="grn-number" placeholder="GRN-XXX" required />
               <div class="invalid-feedback" id="error-grn_number"></div>
             </div>
             <div class="col-md-6">
               <label class="erp-form-label">Receipt Date</label>
               <input class="erp-form-control" type="date" name="receipt_date" id="receipt-date" required />
               <div class="invalid-feedback" id="error-receipt_date"></div>
             </div>
            <div class="col-md-6">
              <label class="erp-form-label">Warehouse</label>
              <select class="erp-form-control" name="warehouse_id" id="warehouse-id" required>
                <option value="">Select Warehouse</option>
              </select>
              <div class="invalid-feedback" id="error-warehouse_id"></div>
            </div>
            <div class="col-md-12">
              <label class="erp-form-label">Notes</label>
              <textarea class="erp-form-control" name="notes" id="notes" rows="2" placeholder=""></textarea>
              <div class="invalid-feedback" id="error-notes"></div>
            </div>
             <div class="col-md-6">
               <label class="erp-form-label">Status</label>
               <select class="erp-form-control" name="status" id="status">
                 <option value="Draft">Draft</option>
                 <option value="Partial">Partial</option>
                 <option value="Received">Received</option>
               </select>
               <div class="invalid-feedback" id="error-status"></div>
             </div>
          </div>
        </div>
        <div class="modal-footer" style="border-color:var(--border)">
          <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-erp btn-primary" id="btn-save">
            <i class="bi bi-check2"></i> Save GRN
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
     store: '{{ route("grn.store") }}',
     update: '{{ route("grn.update", ":id") }}',
     destroy: '{{ route("grn.destroy", ":id") }}',
     purchaseOrdersAll: '{{ route("purchase_orders.all") }}',
     warehousesAll: '{{ route("warehouses.all") }}'
   };

   var $modal = $('#modalGRN');
   var $form = $('#form-grn');
   var $btnSave = $('#btn-save');
   var grnId = null;
   var isEdit = false;

   // Load purchase orders dropdown via AJAX
   function loadPurchaseOrders() {
     $.ajax({
       url: routes.purchaseOrdersAll,
       method: 'GET',
       success: function(res) {
         if (res.success && res.data) {
           var $po = $('#purchase-order-id');
           $po.empty().append('<option value="">Select PO</option>');
           $.each(res.data, function(i, po) {
             $po.append('<option value="' + po.id + '">' + po.po_number + '</option>');
           });
         }
       },
       error: function(xhr) {
         console.warn('Failed to load purchase orders');
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
   loadPurchaseOrders();
   loadWarehouses();

   $('#btn-add-grn').on('click', function() {
     resetForm();
     isEdit = false;
     $('#modal-title').text('New Goods Receipt Note');
     $modal.modal('show');
   });

   $(document).on('click', '.btn-edit', function() {
     resetForm();
     isEdit = true;
     grnId = $(this).data('id');
     $('#modal-title').text('Edit Goods Receipt Note');

      $('#grn-id').val(grnId);
      $('#grn-number').val($(this).data('grn_number'));
      $('#purchase-order-id').val($(this).data('purchase_order_id'));
      $('#supplier-name').val($(this).data('supplier_name'));
      $('#receipt-date').val($(this).data('receipt_date'));
      $('#warehouse-id').val($(this).data('warehouse_id'));
      $('#notes').val($(this).data('notes'));
      $('#status').val($(this).data('status') || 'Draft');

     $modal.modal('show');
   });

   $(document).on('click', '.btn-delete', function() {
     grnId = $(this).data('id');
     var grn_number = $(this).data('grn_number');
     $('#delete-target').text(grn_number || 'this GRN');
     $('#modalDelete').modal('show');
   });

   $('#btn-confirm-delete').on('click', function() {
     $.ajax({
       url: routes.destroy.replace(':id', grnId),
       method: 'DELETE',
       headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
       success: function(res) {
         if (res.success) {
           showToast(res.message || 'GRN deleted', 'success');
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

     var url = isEdit ? routes.update.replace(':id', grnId) : routes.store;
     var method = isEdit ? 'PUT' : 'POST';

     $.ajax({
       url: url,
       method: method,
       data: $form.serialize(),
       headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
       success: function(res) {
         if (res.success) {
           showToast(res.message || (isEdit ? 'GRN updated' : 'GRN created'), 'success');
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
         $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save GRN');
       }
     });
   });

   function resetForm() {
     grnId = null;
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