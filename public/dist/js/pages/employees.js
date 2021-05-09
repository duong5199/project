
// options_select2 = {
//     position_id: {
//         selector: $('select[name="position_id"]'),
//         placeholder: 'Chọn chức vụ',
//         multiple: false,
//         hide_search: false,
//         url: $('select[name="position_id"]').data('url')
//     }
// }

$(document).ready(function () {


    'use strict';

});

FORM.afterAdd((data) => {
    $('#modal-upload-files .modal-title').html('Thêm tài liệu cho : ' + data.data.name);
    $('#form-upload-files input[name="employees_id"]').val(data.data.id || 0);
    $('#modal-upload-files').modal('show');
});
