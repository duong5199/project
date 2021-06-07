<div class="card">
    <div class="card-body">
        <table border="1" width="100%">
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 18px; height: 40px">
                <th colspan="3">Phiếu lương tháng {{ formatDate($data->month, 'm-Y') }}</th>
            </tr>
            <tr style="height: 30px">
                <td>1</td>
                <td>Mã Nhân Viên</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->employee->code }} </th>
            </tr>
            <tr style="height: 30px">
                <td>2</td>
                <td>Nhân Viên</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->employee->name }} </th>
            </tr>
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <th colspan="3">Thông tin cơ bản</th>
            </tr>
            <tr style="height: 30px">
                <td>3</td>
                <td>Ngày công của tháng</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->days }} </th>
            </tr>
            <tr style="height: 30px">
                <td>4</td>
                <td>Ngày công thực tế</td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->workdays }} </th>
            </tr>
            <tr style="text-align: center; color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <th colspan="3">Tính lương</th>
            </tr>
            <tr style="height: 30px">
                <td>5</td>
                <td>Lương cơ bản</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>6</td>
                <td>Phụ cấp</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->allowance) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>7</td>
                <td>Lương 1 ngày công</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format(((int)$data->salary + (int)$data->allowance) / (int)$data->days) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>8</td>
                <td>Tổng mức lương theo ngày công (8 = 4*7)</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->sub_salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>9</td>
                <td>Thêm giờ x 2 [9 = (7/8)*2*{{ $data->ot_hours }}h]</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->ot_salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>10</td>
                <td>Thêm giờ ngày lễ x 3 [10 = (7/8)*3*{{ $data->ot_ratio }}h]</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->ot_salary_holiday) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>11</td>
                <td>Tạm ứng </td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->owed_salary) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>12</td>
                <td>Bảo hiểm xã hội (12 = 5*8%)</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhxh) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>13</td>
                <td>Bảo hiểm y tế (13 = 5*1.5%)</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhyt) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>14</td>
                <td>Bảo hiểm thất nghiệp (14 = 5*1%)</td>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->bhtn) }} đ</th>
            </tr>
            <tr style="height: 30px">
                <td>15</td>
                <td>Thuế thu nhập cá nhân </td>
                <th style="text-align: right; padding-right: 30px"> {{ $data->tax }} đ</th>
            </tr>
            <tr style="color: #fff; background: #ffb000; font-size: 16px; height: 30px">
                <td>16</td>
                <th>Tổng (16 = 8+9+10-11-12-13-14-15)</th>
                <th style="text-align: right; padding-right: 30px"> {{ number_format($data->total_salary) }} đ</th>
            </tr>
        </table>
    </div>
</div>
