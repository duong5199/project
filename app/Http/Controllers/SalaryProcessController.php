<?php

namespace App\Http\Controllers;
use App\Employees;
use App\DataType;
use App\FamilyRelationship;
use App\WorkProcess;
use App\SalaryProcess;
use App\Contract;
use App\Insurrance;
use App\Praise_discipline;
use App\Department;
use App\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
class SalaryProcessController extends Controller
{
    public function AddSalaryProcess(Request $req, $idAddSP){
        $username = $req->session()->get('username');
        $inforLogin = Employees::query()
			->select(
				'employees.employee_code', 
				'employees.fullname',
				'employees.img'
				)
			->JOIN ('user', 'user.employee_id','=','employees.employee_id')
			->WHERE ([
				['user.username', $username],
				['employees.status', 0]
			])
			->get();

        $errors = new MessageBag();
        $employeeInfor = Employees::query()
            ->select('employee_id', 'employee_code', 'fullname')
            ->where('employee_id', $idAddSP)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'DecisionNumber'        => 'required|',
                    'BasicSalary'            => 'required|',
                ]);
    
                if (!$validator->fails()) {
                    $newSP = new SalaryProcess();
                    $newSP->employee_id = $idAddSP;
                    $newSP->decision_number = $req->post('DecisionNumber');
                    $newSP->basic_salary = $req->post('BasicSalary');
                    $newSP->note = $req->post('Note');
                    $newSP->status = 0;
                    $newSP->created_at = Carbon::now(); 
                    $newSP->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddSP)->with('message', 'Thêm mới thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('salary_process/add_salary_process',[
            'errors'            => $errors,
            'employeeInfor'     => $employeeInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    
    public function EditSP(Request $req, $idEditSP){
        $username = $req->session()->get('username');
        $inforLogin = Employees::query()
			->select(
				'employees.employee_code', 
				'employees.fullname',
				'employees.img'
				)
			->JOIN ('user', 'user.employee_id','=','employees.employee_id')
			->WHERE ([
				['user.username', $username],
				['employees.status', 0]
			])
			->get();
        $errors = new MessageBag();
        $SPInfor = SalaryProcess::query()
            ->select('e.employee_id', 'e.employee_code', 'e.fullname', 
            'salary_process.decision_number', 'salary_process.basic_salary', 'salary_process.note')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','salary_process.employee_id')
            ->WHERE ('salary_process.salary_process_id',$idEditSP)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'DecisionNumber'        => 'required|',
                    'BasicSalary'            => 'required|',
                ]);
    
                if (!$validator->fails()) {
                    $editSP = SalaryProcess::find($idEditSP);
                    $editSP->decision_number = $req->post('DecisionNumber');
                    $editSP->basic_salary = $req->post('BasicSalary');
                    $editSP->note = $req->post('Note');
                    $editSP->status = 0;
                    $editSP->save();
                    // cập nhật quá trình lương xong trở về MH chi tiết nhân viên
                    // return \Redirect::route('detailEmployee', $idEditSP)->with('message', 'Cập nhật thành công!');
                }
    
                $errors = $validator->errors();
            }

        return view('salary_process/salary_process_edit',[
            'errors'            => $errors,
            'SPInfor'           => $SPInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

}
