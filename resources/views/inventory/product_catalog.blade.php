@extends('layouts.erp')

@section('title', 'Product Catalog')
@section('breadcrumb', 'Inventory / Product Catalog')

@section('content')
  <div class="page-header">
    <div>
      <div class="page-title">Product Catalog</div>
      <div class="page-subtitle">Manage products, categories and pricing</div>
    </div>
    <div class="d-flex gap-2">
      <button class="btn-erp btn-outline btn-export"><i class="bi bi-download"></i> Export</button>
      <button class="btn-erp btn-primary" id="btn-add-product" data-bs-toggle="modal" data-bs-target="#modalProduct"><i
          class="bi bi-plus-lg"></i> Add Product</button>
    </div>
  </div>

  <div class="erp-card">
    <div class="table-toolbar">
      <div class="search-input">
        <span class="si"><i class="bi bi-search"></i></span>
        <input type="text" class="tbl-search" data-table="#tbl-main" placeholder="Search product catalog…" />
      </div>
      <select class="erp-form-control" style="width:140px">
        <option>All Status</option>
        <option>Electronics</option>
        <option>Hardware</option>
        <option>Apparel</option>
        <option>Furniture</option>
      </select>
    </div>
    <div class="erp-table-wrap">
      <table class="erp-table" id="tbl-main">
        <thead>
          <tr>
            <th>SKU</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Unit Price</th>
            <th>Stock Qty</th>
            <th>Warehouse</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $product)
            <tr>
              <td>{{ $product->sku }}</td>
              <td>{{ $product->product_name }}</td>
              <td>{{ $product->category }}</td>
              <td>${{ number_format($product->unit_price, 2) }}</td>
              <td>0</td>
              <td>{{ $product->warehouse_id ?? 'N/A' }}</td>
              <td>
                @if ($product->status == 'Active')
                  <span class="badge-status badge-active">Active</span>
                @else
                  <span class="badge-status badge-inactive">Inactive</span>
                @endif
              </td>
              <td>
                <div class="d-flex gap-1"><button class="btn-erp btn-outline btn-xs btn-icon btn-edit" 
                    data-id="{{ $product->id }}"
                    data-product_name="{{ $product->product_name }}"
                    data-sku="{{ $product->sku }}"
                    data-category="{{ $product->category }}"
                    data-unit_price="{{ $product->unit_price }}"
                    data-cost_price="{{ $product->cost_price ?? '' }}"
                    data-warehouse_id="{{ $product->warehouse_id ?? '' }}"
                    data-reorder_level="{{ $product->reorder_level ?? '' }}"
                    data-valuation_method="{{ $product->valuation_method ?? 'FIFO' }}"
                    data-description="{{ $product->description ?? '' }}"
                    data-status="{{ $product->status }}"
                    data-bs-toggle="modal" data-bs-target="#modalProduct" title="Edit"><i class="bi bi-pencil"></i></button><button
                    class="btn-erp btn-danger btn-xs btn-icon btn-delete" data-id="{{ $product->id }}" data-product_name="{{ $product->product_name }}" data-bs-toggle="modal" data-bs-target="#modalDelete"
                    data-delete-label="Product" title="Delete"><i class="bi bi-trash"></i></button></div>
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

  <div class="modal fade" id="modalProduct" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content"
        style="background:var(--bg-card);border:1px solid var(--border-active);border-radius:var(--radius)">
        <div class="modal-header" style="border-color:var(--border)">
          <h5 class="modal-title" id="modal-title" style="color:var(--text-primary);font-weight:600">Add / Edit Product</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="form-product">
            @csrf
            <input type="hidden" name="id" id="product-id">
            <div class="row g-3">
              <div class="col-md-8">
                <label class="erp-form-label">Product Name</label>
                <input class="erp-form-control" type="text" name="product_name" id="product_name" placeholder="Product name" required />
                <div class="invalid-feedback" id="error-product_name"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">SKU</label>
                <input class="erp-form-control" type="text" name="sku" id="sku" placeholder="SKU-XXXX" required />
                <div class="invalid-feedback" id="error-sku"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Category</label>
                <select class="erp-form-control" name="category" id="category" required>
                  <option value="">Select Category</option>
                  <option value="Electronics">Electronics</option>
                  <option value="Hardware">Hardware</option>
                  <option value="Apparel">Apparel</option>
                  <option value="Furniture">Furniture</option>
                </select>
                <div class="invalid-feedback" id="error-category"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Unit Price ($)</label>
                <input class="erp-form-control" type="number" name="unit_price" id="unit_price" placeholder="0.00" step="0.01" required />
                <div class="invalid-feedback" id="error-unit_price"></div>
              </div>
              <div class="col-md-3">
                <label class="erp-form-label">Cost Price ($)</label>
                <input class="erp-form-control" type="number" name="cost_price" id="cost_price" placeholder="0.00" step="0.01" required />
                <div class="invalid-feedback" id="error-cost_price"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Warehouse</label>
                <select class="erp-form-control" name="warehouse_id" id="warehouse_id" required>
                  <option value="">Select Warehouse</option>
                  <option value="WH-A">WH-A</option>
                  <option value="WH-B">WH-B</option>
                  <option value="WH-C">WH-C</option>
                </select>
                <div class="invalid-feedback" id="error-warehouse_id"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Reorder Level</label>
                <input class="erp-form-control" type="number" name="reorder_level" id="reorder_level" placeholder="10" />
                <div class="invalid-feedback" id="error-reorder_level"></div>
              </div>
              <div class="col-md-4">
                <label class="erp-form-label">Valuation Method</label>
                <select class="erp-form-control" name="valuation_method" id="valuation_method">
                  <option value="FIFO">FIFO</option>
                  <option value="LIFO">LIFO</option>
                  <option value="Average Cost">Average Cost</option>
                </select>
                <div class="invalid-feedback" id="error-valuation_method"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Status</label>
                <select class="erp-form-control" name="status" id="status">
                  <option value="Active">Active</option>
                  <option value="Inactive">Inactive</option>
                </select>
                <div class="invalid-feedback" id="error-status"></div>
              </div>
              <div class="col-md-6">
                <label class="erp-form-label">Description</label>
                <textarea class="erp-form-control" name="description" id="description" rows="2" placeholder="Product description…"></textarea>
                <div class="invalid-feedback" id="error-description"></div>
              </div>
            </div>
          </form>
      </div>
      <div class="modal-footer" style="border-color:var(--border)">
        <button type="button" class="btn-erp btn-outline" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn-erp btn-primary btn-modal-save" id="btn-save">
          <i class="bi bi-check2"></i> Save Product
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
          store: '{{ route("product_catalog.store") }}',
          update: '{{ route("product_catalog.update", ":id") }}',
          destroy: '{{ route("product_catalog.destroy", ":id") }}',
          warehousesAll: '{{ route("warehouses.all") }}'
        };

        var $modal = $('#modalProduct');
        var $form = $('#form-product');
        var $btnSave = $('#btn-save');
        var productId = null;
        var isEdit = false;

        // Load warehouses dropdown via AJAX
        function loadWarehouses() {
          $.ajax({
            url: routes.warehousesAll,
            method: 'GET',
            success: function(res) {
              if (res.success && res.data) {
                var $wh = $('#warehouse_id');
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

        // Load warehouses on page ready
        loadWarehouses();

        $('#btn-add-product').on('click', function () {
          resetForm();
          isEdit = false;
          $('#modal-title').text('Add Product');
        });

        $modal.on('shown.bs.modal', function () {
          if (!isEdit) {
            resetForm();
            $('#modal-title').text('Add Product');
          }
        });

        $(document).on('click', '.btn-edit', function () {
          resetForm();
          isEdit = true;
          productId = $(this).data('id');
          $('#modal-title').text('Edit Product');

          $('#product-id').val(productId);
          $('#product_name').val($(this).data('product_name'));
          $('#sku').val($(this).data('sku'));
          $('#category').val($(this).data('category'));
          $('#unit_price').val($(this).data('unit_price'));
          $('#cost_price').val($(this).data('cost_price'));
          $('#warehouse_id').val($(this).data('warehouse_id'));
          $('#reorder_level').val($(this).data('reorder_level'));
          $('#valuation_method').val($(this).data('valuation_method'));
          $('#description').val($(this).data('description'));
          $('#status').val($(this).data('status'));
        });

        $(document).on('click', '.btn-delete', function () {
          productId = $(this).data('id');
          var product_name = $(this).data('product_name');
          $('#delete-target').text(product_name || 'this product');
        });

        $('#btn-confirm-delete').on('click', function () {
          $.ajax({
            url: routes.destroy.replace(':id', productId),
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (res) {
              if (res.success) {
                showToast(res.message || 'Product deleted', 'success');
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

           var url = isEdit ? routes.update.replace(':id', productId) : routes.store;
           var method = isEdit ? 'PUT' : 'POST';

           $.ajax({
             url: url,
             method: method,
             data: $form.serialize(),
             headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
             success: function (res) {
               if (res.success) {
                 showToast(res.message || (isEdit ? 'Product updated' : 'Product created'), 'success');
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
                 
                 // Show toast with first error
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
               $btnSave.prop('disabled', false).html('<i class="bi bi-check2"></i> Save Product');
             }
           });
         });

        function resetForm() {
          productId = null;
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
          setTimeout(function () { $t.css('opacity', 0); }, 2500);
          setTimeout(function () { $t.remove(); }, 2800);
        }
      });
    </script>
  @endpush
@endsection