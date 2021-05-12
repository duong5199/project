$(document).ready(function () {

    $(document).on("click", "#open-model-render-payroll", function () {

        let month = $('#form_filter [name="month"]').val();

        $(document).find('#form-render-payroll [name="month"]').val(month);

        $(document).find('#modal-render-payroll .modal-title').html('Xuất phiểu lương tháng ' + month);

    });

    $(document).on("click", ".open-modal-view-detail", function () {

        $('#modal-view').modal('show');

        id = $(this).data('id');
        let url = url_ajax_detail.replace('-id-', id || '0')

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('#modal-view .modal-body').html(data.html)
            }
        });

    });

    $(document).on("click", ".send-multi", function () {

        let url = url_ajax_send_mail_multi || '';

        let data = [];

        $('input[name="id[]"]:checked').map((e, i) => {
            data.push($(i).val());
        });

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
        });

    });

    $(document).on("click", ".send-mail", function () {

        id = $(this).data('id');
        let url = url_ajax_send_mail.replace('-id-', id || '0')

        $.ajax({
            url: url,
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                toastr[data.type](data.message);
            }
        });

    });

});
