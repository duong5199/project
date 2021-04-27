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
class PraiseDisciplineController extends Controller
{
    public function AddPraise(Request $req, $idAddP){
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
            ->where('employee_id', $idAddP)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'PraiseCode'        => 'required|unique:contract,decision_number|min:5,decision_number|max:50',
                    'PraiseName'        => 'required|'
                ]);
    
                if (!$validator->fails()) {
                    $newP = new Praise_discipline();
                    $newP->employee_id = $idAddP;
                    $newP->praise_discipline_code = $req->post('PraiseCode');
                    $newP->praise_discipline_name = $req->post('PraiseName');
                    $newP->praise_discipline_reason = $req->post('PraiseReason');
                    $newP->status = 0;
                    $newP->type = 0;
                    $newP->created_at = Carbon::now(); 
                    $newP->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddP)->with('message', 'Thêm mới thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('praise_discipline/add_praise',[
            'errors'            => $errors,
            'employeeInfor'     => $employeeInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    
    public function EditPraise(Request $req, $idEditP){
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
        $praiseInfor = Praise_discipline::query()
            ->select('e.employee_id', 'e.employee_code', 'e.fullname',
            'praise_discipline_code', 'praise_discipline_name', 'praise_discipline_reason')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','praise_discipline.employee_id')
            ->where('praise_discipline_id', $idEditP)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'PraiseCode'        => 'required|unique:contract,decision_number|min:5,decision_number|max:50',
                    'PraiseName'        => 'required|'
                ]);
    
                if (!$validator->fails()) {
                    $newP = Praise_discipline::find($idEditP);
                    $newP->praise_discipline_code = $req->post('PraiseCode');
                    $newP->praise_discipline_name = $req->post('PraiseName');
                    $newP->praise_discipline_reason = $req->post('PraiseReason');
                    $newP->status = $req->post('Status'); 
                    $newP->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    // return \Redirect::route('detailEmployee', $idAddP)->with('message', 'Cập nhật thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('praise_discipline/praise_edit',[
            'errors'            => $errors,
            'praiseInfor'       => $praiseInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function AddDiscipline(Request $req, $idAddD){
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
            ->where('employee_id', $idAddD)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'DisciplineCode'        => 'required|unique:contract,decision_number|min:5,decision_number|max:50',
                    'DisciplineName'        => 'required|'
                ]);
    
                if (!$validator->fails()) {
                    $newD = new Praise_discipline();
                    $newD->employee_id = $idAddD;
                    $newD->praise_discipline_code = $req->post('DisciplineCode');
                    $newD->praise_discipline_name = $req->post('DisciplineName');
                    $newD->praise_discipline_reason = $req->post('DisciplineReason');
                    $newD->type = 1;
                    $newD->status = 0;
                    $newD->created_at = Carbon::now(); 
                    $newD->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddD)->with('message', 'Thêm mới thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('praise_discipline/add_discpline',[
            'errors'            => $errors,
            'employeeInfor'     => $employeeInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    public function EditDiscipline(Request $req, $idEditD){
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
        
        $disInfor = Praise_discipline::query()
            ->select('e.employee_id', 'e.employee_code', 'e.fullname',
            'praise_discipline_code', 'praise_discipline_name', 'praise_discipline_reason')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','praise_discipline.employee_id')
            ->where('praise_discipline_id', $idEditD)
            ->get();
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'DisciplineCode'        => 'required|unique:contract,decision_number|min:5,decision_number|max:50',
                'DisciplineName'        => 'required|'
            ]);

            if (!$validator->fails()) {
                $newD = Praise_discipline::find($idEditD);
                $newD->praise_discipline_code = $req->post('DisciplineCode');
                $newD->praise_discipline_name = $req->post('DisciplineName');
                $newD->praise_discipline_reason = $req->post('DisciplineReason');
                $newD->status = $req->post('Status'); 
                $newD->save();
                // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                // return \Redirect::route('detailEmployee', $idAddP)->with('message', 'Cập nhật thành công!');
            }

            $errors = $validator->errors();
        }

        return view('praise_discipline/discipline_edit',[
            'errors'            => $errors,
            'disInfor'          => $disInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

}
