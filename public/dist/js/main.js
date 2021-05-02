var csrfToken = $('meta[name="csrf-token"]');
var csrfName = csrfToken.attr('data-name');
var csrfValue = csrfToken.attr('content');

var save_method = '',
    slug_disable = false,
    table = '',
    limit = 10,
    i = 1,
    action = '',
    id = '',
    dataFilter = {};

$(document).ajaxSend(function (elm, xhr, s) {
    if (s.data !== 'undefined') {
        s.data += '&';
    }
    s.data += csrfName + '=' + csrfValue;
});

$(function () {
    'use strict';

    COMMON.init();
    MODAL.init();
    FORM.init();
    DATATABLE.init();
});

const COMMON = {
    init: function () {
        this.active_menu();
        this.reload_table();
        this.destroy();
        this.deletes();
    },

    active_menu: function () {

        $('#main-menu').find('a').removeClass('active');

        let href = window.location.href;
        if (href.slice(-1) === '/') {
            href = window.location.href.slice(0, -1)
        }

        $('#main-menu').find(`[href="${href}"]`).addClass('active');

    },

    reload_table: function () {

        $('.reload-table').on("click", function () {
            DATATABLE.reload();
        });

    },

    destroy: function () {

        $(document).on("click", ".destroy-field", function () {

            let url = url_ajax_destroy.replace('-id-', $(this).data('id') || '0')

            HELPER.swal_delete(() => {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        '_token': csrfValue,
                    },
                    dataType: "JSON",
                    success: function (data) {
                        toastr[data.type](data.message);
                        DATATABLE.reload();
                    },
                    error: function (e) {

                    }
                });
            })
        });

    },

    deletes: function () {

        $(document).on("click", ".remove-multi", function () {

            let url = url_ajax_deletes || '';

            let data = [];

            $('input[name="id[]"]:checked').map((e, i) => {
                data.push($(i).val());
            });

            HELPER.swal_delete(() => {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        '_token': csrfValue,
                        'ids': data,
                    },
                    dataType: "JSON",
                    success: function (data) {
                        toastr[data.type](data.message);
                        DATATABLE.reload();
                    },
                    error: function (e) {

                    }
                });
            })
        });

    }
}

const FORM = {

    init: function () {
        this.send();
    },

    reset: function (_this) {

        $('#base-form')[0].reset();

        $('#base-form').find('small.text-danger').remove()

        $('#base-form [name="id"]').val('');

        $('#modal-form').find('.modal-title').html(_this.data('label') || '')
    },

    fill: function (url) {

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                Object.keys(data).map(function (key, index) {
                    $(document).find(`[name="${key}"]`).val(data[key])
                });
            },
            error: function (e) {
                _this.validate(e.responseJSON.errors);
            }
        });

    },

    send: function () {
        let _this = this;
        $('#base-form').on("submit", function (e) {

            e.preventDefault();

            let form = $(this);

            let data_req = form.serializeArray();

            let url =  url_ajax_create;
            let method = "POST";

            if (action !== 'add') {
                url = url_ajax_update.replace('-id-', id || '0');
                method = "PUT";
            }

            $.ajax({
                url: url,
                type: method,
                data: data_req,
                dataType: "JSON",
                success: function (data) {
                    toastr[data.type](data.message);
                    DATATABLE.reload();
                    if (parseInt(data.code) === 200) {
                        $('#modal-form').modal('hide');
                    }
                },
                error: function (e) {
                    _this.validate(e.responseJSON.errors);
                }
            });

        });
    },

    validate: function (error) {
        $('#base-form').find('small.text-danger').remove()
        Object.keys(error).map(function (key, index) {
            $(document).find(`[name="${key}"]`).closest('.form-group').append(`<small class="text-danger">${error[key][0] || ''}</small>`);
        });
    }
}

const MODAL = {
    init: function () {
        this.open()
    },

    open: function () {

        $(document).on("click", ".open-modal-form", function () {

            action = $(this).data('action') || 'add';

            FORM.reset($(this));

            if (action === 'edit') {
                id = $(this).data('id');
                $('#base-form [name="id"]').val(id);
                let url = url_ajax_edit.replace('-id-', id || '0')
                FORM.fill(url);
            }

            $('#modal-form').modal('show');

        });

    }
}

const DATATABLE = {
    init: function (options) {

        this.checkbox();

        let element = $('#data-table');
        let default_options = {
            'ajax': {
                type: "POST",
                url: url_ajax_list,
                data: function (d) {
                    return $.extend({}, d, dataFilter);
                }
            },
            fixedHeader: true,
            'bProcessing': true,
            'serverSide': true,
            'buttons': [],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Vietnamese.json"
            },
            'columnDefs': [
                {
                    'targets': 'no-sort',
                    "orderable": false,
                    'className': 'text-center'
                },
                {
                    'targets': 0,
                    'visible': element.hasClass("no_check_all") ? false : true,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox" class="chk_id" name="id[]" value="' + $('<div/>').text(data).html() + '">';
                    }
                },
                {
                    'targets': -1,
                    'searchable': false,
                    'orderable': false
                }
            ],
            'order': [[1, 'desc']],
            'bLengthChange': true,
            "fnDrawCallback": function () {
                // $("a.fancybox").fancybox();
                $("#data-table-select-all").prop('checked', false);
            }
        };
        options = typeof options === 'object' ? Object.assign(default_options, options) : default_options;
        return table = element.DataTable(options);
    },

    reload: function () {
        table.ajax.reload(null, false);
    },

    checkbox: function () {
        // checkbox check all
        $('#data-table-select-all').on('click', function () {
            var rows = table.rows({'search': 'applied'}).nodes();
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

        $('#data-table tbody').on('change', 'input[type="checkbox"]', function () {
            if (!this.checked) {
                var el = $('#data-table-select-all').get(0);
                if (el && el.checked && ('indeterminate' in el)) {
                    el.indeterminate = true;
                }
            }
        });
    }
};

const HELPER = {

    swal_delete: function (callback) {

        Swal.fire({
            title: 'Bạn có chắc muốn xoá?',
            text: "Sau khi xoá không thế khôi phục lại!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Xoá!'
        }).then((result) => {
            if (result.isConfirmed) {
                callback();
            }
        })

    }

};
