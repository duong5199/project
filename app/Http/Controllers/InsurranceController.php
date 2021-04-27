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
class InsurranceController extends Controller
{
    public function AddInsurrance(Request $req, $idAddIn){
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
            ->where('employee_id', $idAddIn)
            ->get();

            if (!empty($req->post())) {
                    $newIn = new Insurrance();
                    $newIn->employee_id = $idAddIn;
                    $newIn->social_insurance_number = $req->post('SocInNumber');
                    $newIn->date_of_issue_soc = $req->post('dateSoc');
                    $newIn->place_of_issue_soc = $req->post('placeSoc');
                    $newIn->health_insurance_number = $req->post('HealthInNumber');
                    $newIn->date_of_issue_health = $req->post('dateHealth');
                    $newIn->place_of_issue_health = $req->post('placeHealth');
                    $newIn->status = 0;
                    $newIn->created_at = Carbon::now(); 
                    $newIn->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddIn)->with('message', 'Thêm mới thành công!');
            }
        return view('insurrance/add_insurrance',[
            'errors'            => $errors,
            'employeeInfor'     => $employeeInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    
    public function EditInsurrance(Request $req, $idEditIn){
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
        
        $insurranceInfor = Insurrance::query()
            ->select(
                'e.employee_id', 'e.employee_code', 'e.fullname', 
                'insurrance_id', 'social_insurance_number',
                'date_of_issue_soc', 'place_of_issue_soc', 
                'health_insurance_number', 'date_of_issue_health',
                'place_of_issue_health')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','insurrance.employee_id')
            ->where('insurrance_id', $idEditIn)
            ->get();

        if (!empty($req->post())) {
                $editIn = Insurrance::find($idEditIn);
                $editIn->social_insurance_number    = $req->post('SocInNumber');
                $editIn->date_of_issue_soc          = $req->post('dateSoc');
                $editIn->place_of_issue_soc         = $req->post('placeSoc');
                $editIn->health_insurance_number    = $req->post('HealthNumber');
                $editIn->date_of_issue_health       = $req->post('dateHealth');
                $editIn->place_of_issue_health      = $req->post('placeHealth');
                $editIn->status                     = $req->post('Status');
                $editIn->save();
                // cập nhật quá trình lương xong trở về MH chi tiết nhân viên
                // return \Redirect::route('detailEmployee', $idEditSP)->with('message', 'Cập nhật thành công!');
        }

        return view('insurrance/insurrance_edit',[
            'errors'            => $errors,
            'insurranceInfor'   => $insurranceInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

}
