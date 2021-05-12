<div class="card">
    <div class="card-body">
        <table border="1" width="100%">
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 18px; height: 40px">
                <th colspan="2">Phiếu lương tháng {{ formatDate($data->month, 'm-Y') }}</th>
            </tr>
            <tr style="height: 30px">
                <td>Nhân Viên</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->employee->name }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Mã Nhân Viên</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->employee->code }} </th>
            </tr>
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <th colspan="2">Thông tin cơ bản</th>
            </tr>
            <tr style="height: 30px">
                <td>Ngày công của tháng</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->workdays }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Ngày công thực tế </td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->days }} </th>
            </tr>
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <th colspan="2">Tính lương</th>
            </tr>
            <tr style="height: 30px">
                <td>Lương cơ bản </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>Phụ cấp </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->allowance) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>Lương 1 ngày công </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format(((int)$data->salary + (int)$data->allowance) / (int)$data->days) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>Tổng mức lương theo ngày công </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->sub_salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>Giơ làm thêm </td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->ot_hours }} tiếng</th>
            </tr>
            <tr style="height: 30px">
                <td>Lương làm thêm x {{ $data->ot_ratio }} </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->ot_salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>Lương còn nợ </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->owed_salary) }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Bảo hiểm xã hội </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhxh) }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Bảo hiểm y tế </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhyt) }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Bảo hiểm thất nghiệp </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhtn) }} </th>
            </tr>
            <tr style="height: 30px">
                <td>Thuế thu nhập cả nhân </td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->tax }} </th>
            </tr>
            <tr style="color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <th>Tổng</th>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->total_salary) }} đ</th>
            </tr>
        </table>
    </div>
</div>
