var Utils = {
  init_spapp: function () {
    var app = $.spapp({
      templateDir: "./pages/",
    });
    app.run();
  },
  set_to_localstorage: function(key, value) {
    window.localStorage.setItem(key, JSON.stringify(value));
  },
  get_from_localstorage: function(key) {
    return JSON.parse(window.localStorage.getItem(key));
  },
  logout: function() {
    window.localStorage.clear();
    window.location = "login";
  },
  block_ui: function (element) {
    $(element).block({
      message: '<div class="spinner-border text-primary" role="status"></div>',
      css: {
        backgroundColor: "transparent",
        border: "0",
      },
      overlayCSS: {
        backgroundColor: "#000",
        opacity: 0.25,
      },
    });
  },
  unblock_ui: function (element) {
    $(element).unblock({});
  },
  get_datatable: function (
    table_id,
    url,
    columns,
    disable_sort,
    callback,
    details_callback = null,
    sort_column = null,
    sort_order = null,
    draw_callback = null,
    page_length = 10
  ) {
    if ($.fn.dataTable.isDataTable("#" + table_id)) {
      details_callback = false;
      $("#" + table_id)
        .DataTable()
        .destroy();
    }
    var table = $("#" + table_id).DataTable({
      order: [
        sort_column == null ? 1 : sort_column,
        sort_order == null ? "desc" : sort_order,
      ],
      orderClasses: false,
      columns: columns,
      columnDefs: [{ orderable: false, targets: disable_sort }],
      processing: true,
      serverSide: true,
      ajax: {
        url: url,
        type: "GET",
        headers: {
          "Authentication": Utils.get_from_localstorage("user").token
        }
      },
      lengthMenu: [
        [5, 10, 15, 50, 100, 200, 500, 5000],
        [5, 10, 15, 50, 100, 200, 500, "ALL"],
      ],
      pageLength: page_length,
      initComplete: function () {
        if (callback) callback();
      },
      drawCallback: function (settings) {
        if (draw_callback) draw_callback();
      },
    });
  },
};
