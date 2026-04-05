/**
 * NEXUS ERP - API Helper
 * Centralized AJAX utilities for all CRUD operations
 * Supports 3 calling conventions:
 *   ErpApi.get(url, {success: fn, error: fn})
 *   ErpApi.get(url, callbackFn)
 *   ErpApi.get(url).then(fn)
 */
var ErpApi = {
  _tableStates: {},

  csrf: function () {
    return $('meta[name="csrf-token"]').attr('content') || '';
  },

  /** Normalize callbacks - supports object {success,error}, function, or undefined */
  _cb: function (callbacks) {
    if (typeof callbacks === 'function') return { success: callbacks, error: null };
    if (!callbacks) return { success: null, error: null };
    return callbacks;
  },

  /** Core request returning a jQuery Deferred */
  request: function (url, method, data, callbacks) {
    var cb = ErpApi._cb(callbacks);
    var opts = {
      url: url,
      method: method,
      headers: { 'X-CSRF-TOKEN': ErpApi.csrf(), 'Accept': 'application/json' },
    };
    if (data && method !== 'GET') {
      opts.contentType = 'application/json';
      opts.data = JSON.stringify(data);
    }
    if (data && method === 'GET' && typeof data === 'object') {
      opts.data = data;
    }
    return $.ajax(opts)
      .done(function (res) {
        if (cb.success) cb.success(res);
        var msg = (res && res.message) ? res.message : 'Operation successful';
        if (method !== 'GET') showToast(msg, 'success');
      })
      .fail(function (xhr) {
        var msg = 'An error occurred';
        try {
          var r = JSON.parse(xhr.responseText);
          msg = r.message || msg;
          if (r.errors) { var errs = Object.values(r.errors).flat().join('\n'); if (errs) msg = errs; }
        } catch (e) { msg = xhr.statusText || msg; }
        if (cb.error) cb.error(xhr, msg);
        showToast(msg, 'error');
      });
  },

  get: function (url, data, callbacks) {
    if (typeof data === 'function' || data === undefined) {
      return ErpApi.request(url, 'GET', null, data);
    }
    return ErpApi.request(url, 'GET', data, callbacks);
  },
  post: function (url, data, callbacks) { return ErpApi.request(url, 'POST', data, callbacks); },
  put: function (url, data, callbacks) { return ErpApi.request(url, 'PUT', data, callbacks); },
  del: function (url, callbacks) { return ErpApi.request(url, 'DELETE', null, callbacks); },

  _escapeHtml: function (value) {
    return String(value)
      .replace(/&/g, '&amp;')
      .replace(/</g, '&lt;')
      .replace(/>/g, '&gt;')
      .replace(/"/g, '&quot;')
      .replace(/'/g, '&#39;');
  },

  _getTableElements: function (selector) {
    var $el = $(selector);
    var $table = $el.is('table') ? $el : $el.closest('table');
    var $tbody = $el.is('tbody') ? $el : ($el.is('table') ? $el.find('tbody') : $el);
    var $card = $table.closest('.erp-card');
    var $toolbar = $card.find('.table-toolbar').first();
    var $pagination = $card.find('.erp-pagination').first();

    if ($tbody.length === 0 && $table.length) {
      $tbody = $table.find('tbody');
    }

    return {
      table: $table,
      tbody: $tbody,
      toolbar: $toolbar,
      pagination: $pagination
    };
  },

  _getTableKey: function ($table, $tbody, url) {
    return ($table.attr('id') ? ('#' + $table.attr('id')) : ($tbody.selector || url));
  },

  _ensurePerPageControl: function (state) {
    if (!state.toolbar.length) return;
    if (state.toolbar.find('.erp-per-page').length) return;

    var html = ''
      + '<select class="erp-form-control erp-per-page" style="width:90px">'
      + '<option value="10">10</option>'
      + '<option value="20" selected>20</option>'
      + '<option value="50">50</option>'
      + '<option value="100">100</option>'
      + '</select>';

    state.toolbar.append(html);
  },

  _collectFilterValues: function (state) {
    var filters = [];
    if (!state.toolbar.length) return filters;

    state.toolbar.find('select[name]').not('.erp-per-page').each(function () {
      var name = $(this).attr('name');
      var value = $.trim($(this).val() || '');
      var firstOption = $(this).find('option').first().text().toLowerCase();
      if (value && value !== firstOption) {
        filters.push({ field: name, value: value });
      }
    });

    return filters;
  },

  _itemMatches: function (item, search, filters) {
    var haystack = JSON.stringify(item || {}).toLowerCase();
    if (search && haystack.indexOf(search) === -1) return false;

    for (var i = 0; i < filters.length; i++) {
      var f = filters[i];
      if (f.value && haystack.indexOf(f.value) !== -1) continue;
      if (f.text && haystack.indexOf(f.text) !== -1) continue;
      return false;
    }

    return true;
  },

  _renderPagination: function (state, totalPages) {
    if (!state.pagination.length) return;
    if (totalPages <= 1) {
      state.pagination.empty();
      return;
    }

    var html = '';
    if (state.page > 1) {
      html += '<button class="pg-btn" data-page="' + (state.page - 1) + '"><i class="bi bi-chevron-left"></i></button>';
    }

    for (var i = 1; i <= totalPages; i++) {
      html += '<button class="pg-btn' + (i === state.page ? ' active' : '') + '" data-page="' + i + '">' + i + '</button>';
    }

    if (state.page < totalPages) {
      html += '<button class="pg-btn" data-page="' + (state.page + 1) + '"><i class="bi bi-chevron-right"></i></button>';
    }

    state.pagination.html(html);
  },

  renderTableState: function (key) {
    var state = ErpApi._tableStates[key];
    if (!state) return;

    var pageItems = state.items || [];
    state.tbody.empty();
    if (!pageItems.length) {
      var cols = state.table.find('thead th').length || 1;
      state.tbody.append('<tr><td colspan="' + cols + '" style="text-align:center;color:var(--text-secondary);padding:24px">' + state.emptyMsg + '</td></tr>');
    } else {
      pageItems.forEach(function (item) {
        state.tbody.append(state.rowRenderer(item));
      });
    }

    ErpApi._renderPagination(state, state.totalPages);
    state.table.trigger('erp:tableRendered', [pageItems, state.totalItems, state]);
  },

  refreshTableForElement: function (element) {
    var $el = $(element);
    var tableSelector = $el.data('table');
    var key = tableSelector || ('#' + $el.closest('.erp-card').find('table').first().attr('id'));
    if (ErpApi._tableStates[key]) {
      ErpApi._tableStates[key].page = 1;
      ErpApi.renderTableState(key);
    }
  },

  _loadTableData: function (state, callback) {
    var params = { per_page: state.perPage };
    if (state.page > 1) params.page = state.page;
    if (state.search) params.search = state.search;
    if (state.filters && state.filters.length) {
      params.filters = JSON.stringify(state.filters);
    }
    return ErpApi.get(state.url, params, {
      success: function (res) {
        state.items = res.data.data || [];
        state.totalPages = res.data.last_page || 1;
        state.totalItems = res.data.total || state.items.length;
        if (callback) callback();
        ErpApi.renderTableState(state.key);
      }
    });
  },

  _bindTableEvents: function (state) {
    if (!state.pagination.length) return;
    state.pagination.off('click', '.pg-btn').on('click', '.pg-btn', function() {
      var page = $(this).data('page');
      state.page = page;
      ErpApi._loadTableData(state);
    });
    if (state.toolbar.length) {
      state.toolbar.off('change', '.erp-per-page').on('change', '.erp-per-page', function() {
        state.perPage = parseInt($(this).val());
        state.page = 1;
        ErpApi._loadTableData(state);
      });
      state.toolbar.off('input', '.tbl-search').on('input', '.tbl-search', function() {
        state.search = $(this).val().trim();
        state.page = 1;
        ErpApi._loadTableData(state);
      });
      state.toolbar.off('change', 'select').on('change', 'select', function() {
        state.filters = ErpApi._collectFilterValues(state);
        state.page = 1;
        ErpApi._loadTableData(state);
      });
    }
  },

  /** Load data from API and populate a table tbody
   *  Supports 2 argument orders:
   *    ErpApi.loadTable(url, '#tbl tbody', renderRow, emptyMsg)
   *    ErpApi.loadTable('#tbl-main', '/url', function(item){...})
   */
  loadTable: function (a, b, c, d) {
    var url, tbodySel, rowRenderer, emptyMsg;
    if (typeof a === 'string' && (a.charAt(0) === '#' || a.charAt(0) === '.')) {
      tbodySel = a; url = b; rowRenderer = c; emptyMsg = d;
    } else {
      url = a; tbodySel = b; rowRenderer = c; emptyMsg = d;
    }
    emptyMsg = emptyMsg || 'No records found';
    var parts = ErpApi._getTableElements(tbodySel);
    var key = ErpApi._getTableKey(parts.table, parts.tbody, url);
    var state = ErpApi._tableStates[key] || {
      key: key,
      page: 1,
      perPage: 20
    };

    state.url = url;
    state.table = parts.table;
    state.tbody = parts.tbody;
    state.toolbar = parts.toolbar;
    state.pagination = parts.pagination;
    state.rowRenderer = rowRenderer;
    state.emptyMsg = emptyMsg;
    state.search = '';
    state.filters = [];
    ErpApi._tableStates[key] = state;
    ErpApi._ensurePerPageControl(state);
    ErpApi._bindTableEvents(state);

    return ErpApi._loadTableData(state);
  },

  setTableData: function (selector, items, rowRenderer, emptyMsg) {
    var parts = ErpApi._getTableElements(selector);
    var key = ErpApi._getTableKey(parts.table, parts.tbody, selector);
    var state = ErpApi._tableStates[key] || {
      key: key,
      page: 1,
      perPage: 20
    };

    state.url = null;
    state.table = parts.table;
    state.tbody = parts.tbody;
    state.toolbar = parts.toolbar;
    state.pagination = parts.pagination;
    state.rowRenderer = rowRenderer;
    state.emptyMsg = emptyMsg || 'No records found';
    state.items = Array.isArray(items) ? items : [];
    ErpApi._tableStates[key] = state;
    ErpApi._ensurePerPageControl(state);
    ErpApi.renderTableState(key);
  },

  /** Collect form data from modal inputs/selects with name attr */
  collectForm: function (selector) {
    var data = {};
    $(selector).find('input[name], select[name], textarea[name]').each(function () {
      var name = $(this).attr('name');
      if (name) data[name] = $(this).val();
    });
    return data;
  },

  /** Populate modal form from item data object */
  populateForm: function (selector, item) {
    $(selector).find('input[name], select[name], textarea[name]').each(function () {
      var name = $(this).attr('name');
      if (name && item[name] !== undefined && item[name] !== null) $(this).val(item[name]);
    });
  },

  /** Clear modal form */
  clearForm: function (selector) {
    $(selector).find('input[name], select[name], textarea[name]').each(function () {
      if ($(this).is('select')) $(this).prop('selectedIndex', 0);
      else $(this).val('');
    });
  },

  /** Show edit modal and populate */
  editItem: function (url, modalSel, modalId) {
    return ErpApi.get(url, {
      success: function (res) {
        var item = res.data || res;
        ErpApi.populateForm(modalSel, item);
        $(modalSel).data('edit-id', item.id);
        $(modalSel).find('.modal-title').text('Edit Record');
        new bootstrap.Modal(document.getElementById(modalId)).show();
      }
    });
  },

  /** Generic delete with confirmation */
  deleteItem: function (url, callback) {
    return ErpApi.del(url, {
      success: function (res) {
        if (callback) callback(res);
      }
    });
  }
};
