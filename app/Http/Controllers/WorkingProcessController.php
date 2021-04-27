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
class WorkingProcessController extends Controller
{
    // http://localhost:8000/employee/add_working_process
    public function AddWorkingProcess(Request $req){
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
        $Position = Position::query()
            ->select('position_id', 'position_name')->get();
        $Department = Department::query()
            ->select('department_id', 'department_name')->get();
        // Lấy id bản ghi vừa tạo
        // SELECT employee_id FROM employees ORDER BY created_at DESC LIMIT 1
        $employeeId = Employees::query()
            ->select('employee_id')
            ->ORDERBY('created_at','DESC')
            ->LIMIT(1)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'Department'        => 'required|',
                    'Position'            => 'required|',
                ]);
    
                if (!$validator->fails()) {
                    $newWP = new WorkProcess();
                    $newWP->employee_id = $req->post('Id');
                    $newWP->department_id = $req->post('Department');
                    $newWP->position_id = $req->post('Position');
                    $newWP->start_date = $req->post('StartDate');
                    $newWP->end_date = $req->post('EndDate');
                    $newWP->company_name = $req->post('CompanyName');
                    $newWP->company_address = $req->post('CompanyAddress');
                    $newWP->note = $req->post('Note');
                    $newWP->status = 0;
                    $newWP->save();
                    // thêm mới quá trình công tác xong trở về MH danh sách
                    return redirect('/Employees');
                }
    
                $errors = $validator->errors();
            }
        return view('work_process/add_working_process',[
            'errors'            => $errors,
            'Position'          => $Position,
            'employeeId'        => $employeeId,
            'Department'        => $Department,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function AddWP(Request $req, $idAddWP){
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
        $Position = Position::query()
            ->select('position_id', 'position_name') ->where('status',0) ->get();
        $Department = Department::query()
            ->select('department_id', 'department_name') ->where('status',0) ->get();
        $employeeInfor = Employees::query()
            ->select('employee_id', 'employee_code', 'fullname')
            ->where('employee_id', $idAddWP)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'Department'        => 'required|',
                    'Position'            => 'required|',
                ]);
    
                if (!$validator->fails()) {
                    $newWP = new WorkProcess();
                    $newWP->employee_id = $idAddWP;
                    $newWP->department_id = $req->post('Department');
                    $newWP->position_id = $req->post('Position');
                    $newWP->start_date = $req->post('StartDate');
                    $newWP->end_date = $req->post('EndDate');
                    $newWP->company_name = $req->post('CompanyName');
                    $newWP->company_address = $req->post('CompanyAddress');
                    $newWP->note = $req->post('Note');
                    $newWP->status = 0;
                    $newWP->save();
                    // thêm mới quá trình công tác xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddWP)->with('message', 'Thêm mới thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('work_process/addNewRecords',[
            'errors'            => $errors,
            'Position'          => $Position,
            'Department'        => $Department,
            'employeeInfor'     => $employeeInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    
    public function EditWP(Request $req,$idWP){
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

        $Position = Position::query()
            ->select('position_id', 'position_name') ->where('status',0) ->get();
        $Department = Department::query()
            ->select('department_id', 'department_name') ->where('status',0) ->get();
        $WPInfor = WorkProcess::query()
            ->select(
                'work_process.employee_id',
                'e.employee_code',
                'e.fullname',
                'work_process.work_process_id',
                'work_process.position_id',
                'p.position_name',
                'work_process.department_id',
                'd.department_name',
                'work_process.start_date', 
                'work_process.end_date',
                'work_process.company_name', 
                'work_process.company_address', 
                'work_process.note')
            ->JOIN (DB::RAW('department AS d'), 'd.department_id','=','work_process.department_id')
            ->JOIN (DB::RAW('position AS p'), 'p.position_id','=','work_process.position_id')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','work_process.employee_id')
            ->WHERE ('work_process.work_process_id',$idWP)
            ->get();
        $employeeId =  WorkProcess::query()
            ->select('work_process.employee_id')
            ->WHERE ('work_process.work_process_id',$idWP) ->get();
            if (!empty($req->post())) {
                $editWP = WorkProcess::find($idWP);
                $editWP->department_id = $req->post('Department');
                $editWP->position_id = $req->post('Position');
                $editWP->start_date = $req->post('StartDate');
                $editWP->end_date = $req->post('EndDate');
                $editWP->company_name = $req->post('CompanyName');
                $editWP->company_address = $req->post('CompanyAddress');
                $editWP->note = $req->post('Note');
                $editWP->status = $req->post('status');
                $editWP->save();
                    // var_dump($employeeId);exit;
                    // Cập nhật quá trình công tác xong trở về MH chi tiết nhân viên
                // return \Redirect::route('detailEmployee', $employeeId)->with('message', 'Cập nhật thành công!');
            }

        return view('work_process/work_process_edit',[
            'Position'          => $Position,
            'Department'        => $Department,
            'WPInfor'           => $WPInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

}