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
    LIB.init();
    DATATABLE.init();
});

const LIB = {

    init: function () {
        this.date();
        this.select2();
        this.switch();
        this.dropzone();
    },

    switch: function () {
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })
    },

    select2: function (data) {
        data = typeof data === 'object' ? data : [];
        $.each(options_select2, function (key, option) {
            let dataSelected = typeof data[key] !== 'undefined' ? data[key] : '';
            COMMON.load_select2(option, dataSelected);
        });
    },

    date: function () {

        $('.datepicker').datepicker({
            format: "dd/mm/yyyy",
            autoclose: true,
            todayHighlight: true,
        });

        $('.monthpicker').datepicker( {
            format: "mm-yyyy",
            viewMode: "months",
            minViewMode: "months",
            autoclose: true,
            todayHighlight: true,
        });

        $('.datetimepicker').datetimepicker({
            format: "yyyy-mm-dd HH:ii:ss",
            autoclose: true,
        });

    },

    dropzone: function () {
        // DropzoneJS Demo Code Start
        Dropzone.autoDiscover = false

        // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
        var previewNode = document.querySelector("#template");

        if (previewNode === null) return;

        previewNode.id = " ";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
            url: url_ajax_upload_files || '', // Set the url
            headers: {
                'X-CSRF-TOKEN': csrfValue
            },
            thumbnailWidth: 80,
            thumbnailHeight: 80,
            parallelUploads: 20,
            previewTemplate: previewTemplate,
            autoQueue: false, // Make sure the files aren't queued until manually added
            previewsContainer: "#previews", // Define the container to display the previews
            clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
        })

        myDropzone.on("addedfile", function (file) {
            // Hookup the start button
            file.previewElement.querySelector(".start").onclick = function () {
                myDropzone.enqueueFile(file)
            }

            $(file.previewElement).find('.btn-group .view').attr('href', file.url);

        })

        myDropzone.on("removedfile", function (file) {
            var fileName = file.name;

            $.ajax({
                type: 'POST',
                url: url_ajax_delete_files || '',
                data: {
                    name: fileName,
                    employees_id: $('#form-upload-files input[name="employees_id"]').val() || 0,
                    request: 'delete'
                },
                sucess: function (data) {
                    toastr['success']('Thành công');
                }
            });
        })

        $(document).on("click", '.open-modal-form-upload-file', function () {

            $(document).find('#previews .row').remove();

            id = $(this).data('id');
            $('#base-form [name="id"]').val(id);
            let url = url_ajax_get_files.replace('-id-', id || '0')
            $('#modal-upload-files').modal('show');

            $.ajax({
                url: url,
                type: "GET",
                dataType: "JSON",
                success: function (data) {
                    $.each(data.image, function (key, value) {

                        myDropzone.emit("addedfile", value);
                        if (value.is_image) {
                            myDropzone.emit("thumbnail", value, value.url);
                        }
                        myDropzone.emit("complete", value);
                        myDropzone.emit("info", value, value.url);

                    });

                    $('#modal-upload-files .modal-title').html('Thêm tài liệu cho : ' + data.employee.name);
                    $('#form-upload-files input[name="employees_id"]').val(data.employee.id || 0);
                    $(document).find('#previews .btn-group .start').attr('disabled', 'disabled')
                    $(document).find('#previews .progress-bar-success').css('width', '100%')
                }
            });

            // myDropzone.init(
            //
            // );

        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function (progress) {
            document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        })

        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("employees_id", $('#form-upload-files input[name="employees_id"]').val() || 0)
            // Show the total progress bar when upload starts
            document.querySelector("#total-progress").style.opacity = "1"
            // And disable the start button
            file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
        })

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function (progress) {
            document.querySelector("#total-progress").style.opacity = "0"
        })

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function () {
            myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
        }
        // document.querySelector("#actions .cancel").onclick = function () {
        //     myDropzone.removeAllFiles(true)
        // }
        // DropzoneJS Demo Code End
    }

}

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

    },

    load_select2: function (options, dataSelected) {
        let params_ajax = {
            url: options.url.trim().toString(),
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        };

        console.log(params_ajax)
        if (typeof options.ajax === 'object') {
            params_ajax = Object.assign(params_ajax, options.ajax)
        }
        options.selector.select2({
            theme: 'bootstrap4',
            allowClear: true,
            placeholder: options.placeholder,
            multiple: options.multiple,
            minimumResultsForSearch: options['hide_search'] ? -1 : 1,
            data: dataSelected,
            ajax: params_ajax
        });
        if (typeof dataSelected !== 'undefined') options.selector.find('> option').prop("selected", "selected").trigger("change");
    }
}

const FORM = {

    init: function () {
        this.send();
    },

    addCallback: function (data) {

    },

    afterAdd: function (func) {
        this.addCallback = func
    },

    updateCallback: function (data) {

    },

    afterUpdate: function (func) {
        this.updateCallback = func
    },

    afterSend: function (func) {
        this.addCallback = func
        this.updateCallback = func
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
                LIB.select2(data);
                Object.keys(data).map(function (key, index) {
                    switch (key) {
                        case 'status':
                            $(document).find(`[name="${key}"]`).bootstrapSwitch('state', data[key] === 1);
                            break;
                        default:
                            $(document).find(`[name="${key}"]`).val(data[key])
                    }

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

            let url = url_ajax_create;
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

                    if (action !== 'add') {
                        _this.updateCallback(data)
                    } else {
                        _this.addCallback(data)
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

        this.filter();
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
            "fnDrawCallback": function (data) {
                $('#view-table #data-table_wrapper').show();
                $('#view-table').find('#empty-view').remove();
                $('#view-table').find('#data-table').css('width', '100%');
                if (!data.json.recordsTotal) {
                    if (typeof data.json.html !== "undefined") {
                        $('#view-table #data-table_wrapper').hide();
                        $('#view-table').append(data.json.html);
                    }
                }
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

    filter: function () {
        if ($('#form_filter').length === 0) return;

        $('#form_filter .item').on('change keyup', function () {
            $('#form_filter').trigger('submit');
        })

        $('#form_filter').submit(function (e) {
            e.preventDefault();
            let form_data = $(this).serializeArray();
            let filter = {};
            $.each(form_data, function (index, val) {
                if (val.value !== '') {
                    filter[val.name] = val.value;
                }
            });

            dataFilter = filter;
            DATATABLE.reload();
        });
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
