<?php

namespace App\Http\Controllers;
use App\Employees;
use App\DataType;
use App\Department;
use App\Position;
use App\ContractType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
class DepartmentController extends Controller
{
    public function ListDepartment(Request $req){
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
        // phân trang 
        $limit = 10;
        $page  = $req->query('page');
        $count_department        = Department::query() ->WHERE ('status', 0) ->get();
        $numberOfRecords = $count_department->count();
        $numberOfPage    = $numberOfRecords > 0 ? ceil($numberOfRecords / $limit) : 1;
        // View
        $departments  = Department::query() ->ORDERBY ('created_at', 'DESC') ->get(); 
       
        // Add
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'departmentCode'        => 'required|unique:department,department_code|min:5,department_code|max:50',
                'departmentName'          => 'required|'
            ],
            [
                'departmentCode.required' => 'Mã phòng ban không được để trống!',
                'departmentCode.min' => 'Mã phòng ban phải lớn hơn 5 kí tự!',
                'departmentCode.mã' => 'Mã phòng ban không được nhiều hơn 50 kí tự!',
                'departmentName.required' => 'Tên phòng ban không được để trống!'
            ]);
            if (!$validator->fails()) {
                $newDe = new Department();
                $newDe->department_code = $req->post('departmentCode');
                $newDe->department_name = $req->post('departmentName');
                $newDe->status = 0;
                $newDe->created_at = Carbon::now(); 
                $newDe->save();
            // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                return redirect('/departments')->with('message', 'Thêm mới thành công!');
            }
    
            $errors = $validator->errors();
        }

        return view('departments/departments',[
            'errors'            => $errors,
            'numberOfRecords'   => $numberOfRecords,
            'page'              => $page,
            'departments'       => $departments,
            'numberOfPage'      => $numberOfPage,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function EditDepartment(Request $req, $idDepartment){
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
        $departments_detail  = Department::query() ->WHERE ('department_id', $idDepartment) ->ORDERBY ('created_at', 'DESC') ->get(); 
        
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'departmentCode'        => 'required|',
                'departmentName'          => 'required|',
            ]);

            if (!$validator->fails()) {
                $editDe = Department::find($idDepartment);
                $editDe->department_code = $req->post('departmentCode');
                $editDe->department_name = $req->post('departmentName');
                $editDe->status = $req->post('Status');
                $editDe->save();
                // cập nhật quá trình lương xong trở về MH danh sách
                return redirect('/departments')->with('message', 'Cập nhật thành công!');
            }

            $errors = $validator->errors();
        }
        return view('departments/edit_department',[
            'errors'            => $errors,
            'departments_detail'=> $departments_detail,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
}
