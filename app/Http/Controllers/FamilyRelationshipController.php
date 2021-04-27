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
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class FamilyRelationshipController extends Controller
{
    // http://localhost:8000/employee/add_family_relationship
    public function AddFamilyRelationship(Request $req) {
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
        $types = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','family_relationship')->get();
        
        // Lấy id bản ghi vừa tạo
        // SELECT employee_id FROM employees ORDER BY created_at DESC LIMIT 1
        $employeeId = Employees::query()
            ->select('employee_id')
            ->ORDERBY('created_at','DESC')
            ->LIMIT(1)
            ->get();
            // var_dump($employeeId); exit;
        $family_relationship = FamilyRelationship::query()
            ->SELECT('family_relationship.family_relationship_id',
            'data_type.data_name','family_relationship.fullname',
            'family_relationship.dob','family_relationship.job', 
            'family_relationship.place_of_birth', 'family_relationship.permanent_address', 
            'family_relationship.current_address', 'family_relationship.work_address', 
            'family_relationship.phone_number', 'family_relationship.work_phone_number', 
            'family_relationship.note', 'family_relationship.created_at', 
            'family_relationship.created_by', 'family_relationship.updated_at', 
            'family_relationship.updated_by')
            ->JOIN ('data_type','family_relationship.data_id','=','data_type.data_id')
            ->WHERE ('family_relationship.employee_id', $req->post('Id'))
            ->get();
            
        // var_dump($id);exit;
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'Fullname'        => 'required|',
                'Type'            => 'required|',
            ]);

            if (!$validator->fails()) {
                $newFR = new FamilyRelationship();
                $newFR->employee_id = $req->post('Id');
                $newFR->fullname = $req->post('Fullname');
                $newFR->data_id = $req->post('Type');
                $newFR->dob = $req->post('DOB');
                $newFR->place_of_birth = $req->post('PlaceOfBirth');
                $newFR->permanent_address = $req->post('PermanentAddress');
                $newFR->current_address = $req->post('CurrentAddress');
                $newFR->job = $req->post('Job');
                $newFR->work_address = $req->post('WorkAddress');
                $newFR->phone_number = $req->post('PhoneNumber');
                $newFR->work_phone_number = $req->post('WorkPhoneNumber');
                $newFR->note = $req->post('Note');
                $newFR->save();
                //var_dump($newUser);exit;
                return redirect('/employee/add_family_relationship');
            }

            $errors = $validator->errors();
        }
        return view('family_relationship/add_family_relationship',[
            'errors'                    => $errors,
            'types'                     => $types,
            'employeeId'                => $employeeId,
            'family_relationship'       => $family_relationship,
            'inforLogin'		        => $inforLogin,
            'username'                  => $req->session()->get('username')
        ]);
    }

    public function AddFR(Request $req, $idAddFR) {
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
        $types = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','family_relationship')->get();
        $employeeInfor = Employees::query()
            ->select('employee_id', 'employee_code', 'fullname')
            ->where('employee_id', $idAddFR)
            ->get();
        $family_relationship = FamilyRelationship::query()
            ->SELECT('family_relationship.family_relationship_id',
            'data_type.data_name','family_relationship.fullname',
            'family_relationship.dob','family_relationship.job', 
            'family_relationship.place_of_birth', 'family_relationship.permanent_address', 
            'family_relationship.current_address', 'family_relationship.work_address', 
            'family_relationship.phone_number', 'family_relationship.work_phone_number', 
            'family_relationship.note', 'family_relationship.created_at', 
            'family_relationship.created_by', 'family_relationship.updated_at', 
            'family_relationship.updated_by')
            ->JOIN ('data_type','family_relationship.data_id','=','data_type.data_id')
            ->WHERE ('family_relationship.employee_id', $idAddFR)
            ->get();
        // var_dump($family_relationship);exit;
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'Fullname'        => 'required|',
                'Type'            => 'required|',
            ]);

            if (!$validator->fails()) {
                $newFR = new FamilyRelationship();
                $newFR->employee_id = $idAddFR;
                $newFR->fullname = $req->post('Fullname');
                $newFR->data_id = $req->post('Type');
                $newFR->dob = $req->post('DOB');
                $newFR->place_of_birth = $req->post('PlaceOfBirth');
                $newFR->permanent_address = $req->post('PermanentAddress');
                $newFR->current_address = $req->post('CurrentAddress');
                $newFR->job = $req->post('Job');
                $newFR->work_address = $req->post('WorkAddress');
                $newFR->phone_number = $req->post('PhoneNumber');
                $newFR->work_phone_number = $req->post('WorkPhoneNumber');
                $newFR->note = $req->post('Note');
                $newFR->save();
                //var_dump($newUser);exit;
                // thêm mới quá trình công tác xong trở về MH chi tiết nhân viên
                return \Redirect::route('detailEmployee', $idAddFR)->with('message', 'Thêm mới thành công!');
            }

            $errors = $validator->errors();
        }
        return view('family_relationship/addNewRecordsFR',[
            'errors'                => $errors,
            'types'                 => $types,
            'family_relationship'   => $family_relationship,
            'employeeInfor'         => $employeeInfor,
            'inforLogin'		    => $inforLogin,
            'username'              => $req->session()->get('username')
        ]);
    }

    public function EditFR(Request $req, $idEditFR) {
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
        $types = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','family_relationship')->get();
        $FRInfor = FamilyRelationship::query()
            ->SELECT(
            'family_relationship.family_relationship_id', 
            'family_relationship.employee_id',
            DB::RAW('e.fullname AS tennhanvien'), 
            'e.employee_code',
            'data_type.data_name',
            DB::RAW('family_relationship.fullname AS tennguoithan'),
            'family_relationship.data_id',
            'family_relationship.dob',
            'family_relationship.job', 
            'family_relationship.place_of_birth', 
            'family_relationship.permanent_address', 
            'family_relationship.current_address', 
            'family_relationship.work_address', 
            'family_relationship.phone_number', 
            'family_relationship.work_phone_number', 
            'family_relationship.note')
            ->JOIN ('data_type','family_relationship.data_id','=','data_type.data_id')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','family_relationship.employee_id')
            ->WHERE ('family_relationship.family_relationship_id', $idEditFR)
            ->get();
        // var_dump($family_relationship);exit;
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'Fullname'        => 'required|',
                'Type'            => 'required|',
            ]);

            if (!$validator->fails()) {
                $editFR = FamilyRelationship::find($idEditFR);
                $editFR->fullname = $req->post('Fullname');
                $editFR->data_id = $req->post('Type');
                $editFR->dob = $req->post('DOB');
                $editFR->place_of_birth = $req->post('PlaceOfBirth');
                $editFR->permanent_address = $req->post('PermanentAddress');
                $editFR->current_address = $req->post('CurrentAddress');
                $editFR->job = $req->post('Job');
                $editFR->work_address = $req->post('WorkAddress');
                $editFR->phone_number = $req->post('PhoneNumber');
                $editFR->work_phone_number = $req->post('WorkPhoneNumber');
                $editFR->note = $req->post('Note');
                $editFR->save();
                //var_dump($newUser);exit;
                // thêm mới quá trình công tác xong trở về MH chi tiết nhân viên
                // return \Redirect::route('detailEmployee', $idEditFR)->with('message', 'Cập nhật thành công!');
            }

            $errors = $validator->errors();
        }
        return view('family_relationship/family_relationship_edit',[
            'errors'            => $errors,
            'types'             => $types,
            'FRInfor'           => $FRInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
}
