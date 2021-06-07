<?php


namespace App\Http\Controllers;

use App\Employee;
use App\Contract;
use App\Http\Helpers\Mail;
use App\Payroll as Model;
use App\Http\Requests\PayrollRequest as ThisRequest;
use App\Table\PayrollTable as ThisTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayrollController extends Controller
{
    protected $title_page = 'Bảng lương';

    protected $field_form = [
        'salary' => [
            'label' => 'Lương cơ bản (VNĐ)',
            'type' => 'text',
            'required' => true,
            'value' => ''
        ],
        'allowance' => [
            'label' => 'Phụ cấp (VNĐ)',
            'type' => 'text',
            'required' => true,
            'value' => ''
        ],
        'workdays' => [
            'label' => 'Số ngày công đã làm (Ngày) - Mặc định 22 ngày',
            'type' => 'text',
            'value' => 22
        ],
        'ot_hours' => [
            'label' => 'Giờ làm thêm (Giờ)',
            'type' => 'text',
            'value' => 0
        ],
        'ot_ratio' => [
            'label' => 'Giờ làm thêm ngày lễ (Giờ)',
            'type' => 'text',
            'value' => 0
        ],
        'owed_salary' => [
            'label' => 'Tạm ứng (VNĐ)',
            'type' => 'text',
            'value' => 0
        ],
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function render(Request $request)
    {

        DB::beginTransaction();
        try {

            foreach ($request->input('employee') as $item) {
                $employee = Employee::find($item['id']);
                
                $data = [
                    "month" => formatDateSave('01-' . $request->input('month')),
                    "days" => $request->input('days') ?? 22,
                    // "ot_ratio" => $request->input('ot_ratio') ?? 2,
                    "workdays" => $request->input('workdays') ?? 22,
                    "salary" => (int)$item['salary'] ?? (int)$employee->salary,
                    "allowance" => (int)$item['allowance'] ?? (int)$employee->allowance,
                    "ot_hours" => (int)$item['ot_hours'] ?? 0,
                    "ot_ratio" => (int)$item['ot_ratio'] ?? 0,
                    "owed_salary" => (int)$item['owed_salary'] ?? 0,
                    "other_fees" => 0,
                    "tax" => 0,
                    "employee_id" => $employee->id,
                ];
                // tổng lương 
                $sub_salary = $data['salary'] + $data['allowance'];

                $data['sub_salary'] = intval(($sub_salary / (int)$data['days']) * (int)$data['workdays']);
                // $data['ot_salary'] = intval(($data['sub_salary'] / 8) * $data['ot_hours']);
                // $data['ot_salary'] = intval((($sub_salary / (int)$data['days']) / 8) * $data['ot_hours'] * (int)$data['ot_ratio']);
                $data['ot_salary'] = intval((($sub_salary / (int)$data['days']) / 8) * $data['ot_hours'] * 2);
                $data['ot_salary_holiday'] = intval((($sub_salary / (int)$data['days']) / 8) * $data['ot_hours'] * 3);
                
                $contracts = Contract::find($data['employee_id']);
                if ($contracts->type == 1 || $contracts->type == 2) {
                    $data['bhxh'] = intval(($data['salary'] * 8) / 100);
                    $data['bhyt'] = intval(($data['salary'] * 1.5) / 100);
                    $data['bhtn'] = intval(($data['salary'] * 1) / 100);

                    $data['total_salary'] = ( $data['sub_salary'] + $data['ot_salary'] + $data['ot_salary_holiday'] ) - ($data['bhxh'] + $data['bhyt'] + $data['bhtn'] + $data['owed_salary'] + $data['other_fees'] );
                    
                } else {
                    $data['bhxh'] = 0;
                    $data['bhyt'] = 0;
                    $data['bhtn'] = 0;

                    $data['total_salary'] = $data['sub_salary'] + $data['ot_salary'] + $data['ot_salary_holiday'];
                
                }


                Model::create($data);
            }

            DB::commit();
            return redirect(route('payrolls.index'))->with('Oke');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect(route('payrolls.index'))->with($e->getMessage());
        }

    }

    public function index(ThisTable $table)
    {
        return view('payrolls/view', [
            'table' => $table->html()
        ]);
    }

    public function list(Request $request, ThisTable $table)
    {
        return $table->render();
    }

    public function store(ThisRequest $request)
    {

        return responseSuccess('Tạo mới thành công');
    }

    public function edit($id)
    {
        return Model::find($id);
    }

    public function update($id, ThisRequest $request)
    {
        $user = Model::find($id);
        $data = $request->input();

        $user->fill($data);

        $sub_salary = (int)$user->salary + (int)$user->allowance;

        $user->sub_salary = intval(($sub_salary / (int)$user->days) * (int)$user->workdays);
        // $user->ot_salary = intval(($user->sub_salary / 8) * $user->ot_hours);
        // $user->ot_salary = intval((($sub_salary / (int)$user->days) / 8) * $user->ot_hours * $user->ot_ratio );
        $user->ot_salary = intval((($sub_salary / (int)$user->days) / 8) * $user->ot_hours * 2 );
        $user->ot_salary_holiday = intval((($sub_salary / (int)$user->days) / 8) * $user->ot_hours * 3 );
       
        $contracts = Contract::find($user->employee_id);

        if ($contracts->type == 1 || $contracts->type == 2) {
            $user->bhxh = intval(($user->salary * 8) / 100);
            $user->bhyt = intval(($user->salary * 1.5) / 100);
            $user->bhtn = intval(($user->salary * 1) / 100);

            $user->total_salary = ($user->sub_salary + $user->ot_salary + $user->ot_salary_holiday) - ($user->bhxh + $user->bhyt + $user->bhtn + $user->owed_salary + $user->other_fees);
            
        } else {
            $user->bhxh = 0;
            $user->bhyt = 0;
            $user->bhtn = 0;

            $user->total_salary = ($user->sub_salary + $user->ot_salary + $user->ot_salary_holiday);
        
        }
        
        $user->save();

        return responseSuccess('Cập nhật thành công thành công');
    }

    public function destroy($id)
    {
        Model::destroy($id);
        return responseSuccess('Xoá thành công');
    }

    public function deletes(Request $request)
    {
        $ids = $request->input('ids') ?? [];

        DB::beginTransaction();
        try {

            foreach ($ids as $id) {
                Model::destroy($id);
            }
            DB::commit();

            return responseSuccess('Xoá thành công');
        } catch (Exception $e) {
            DB::rollback();
            return responseError($e->getMessage());
        }
    }

    public function detail($id)
    {
        $data = Model::find($id);
        return [
            'html' => view('payrolls/payroll', compact('data'))->render()
        ];
    }

    public function sendMailMulti(Request $request)
    {
        $ids = $request->input('ids') ?? [];
        try {

            foreach ($ids as $id) {
                $data = Model::find($id);
                \Mail::to($data->employee->email)->send(new Mail('payrolls/payroll', $data, 'Phiếu lương tháng ' . formatDate($data->month, 'm-Y')));
            }

            return responseSuccess('Gửi thành công');
        } catch (Exception $e) {
            return responseError($e->getMessage());
        }
    }

    public function sendMail($id)
    {
        $data = Model::find($id);
        try {
            \Mail::to($data->employee->email)->send(new Mail('payrolls/payroll', $data, 'Phiếu lương tháng ' . formatDate($data->month, 'm-Y')));
            return responseSuccess('Gửi thành công');
        } catch (Exception $e) {
            return responseError($e->getMessage());
        }
    }
}
