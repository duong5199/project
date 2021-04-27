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
use Carbon\Carbon;
class EmployeesController extends Controller
{
    public function Employees(Request $req){
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

        // phân trang 
        $limit = 10;
        $page  = $req->query('page');
        $count_employees         = Employees::query()
            ->LEFTJOIN ('work_process','employees.employee_id','=', 'work_process.employee_id')
            ->WHERE ([['work_process.status', 0],['employees.status', 0]])
            ->get();
        $numberOfRecords = $count_employees->count();
        // var_dump($numberOfRecords); exit; 
        $numberOfPage    = $numberOfRecords > 0 ? ceil($numberOfRecords / $limit) : 1;

        //  Hiển thị
        $employees         = Employees::query()
            ->select('employees.employee_id',
                'employees.employee_code',
                'employees.fullname',
                'employees.email',
                'employees.phone_number',
                'work_process.company_name',
                'work_process.company_address',
                'department.department_name',
                'position.position_name',
                'employees.img', 
                'user.is_active',
                'user.role')
            ->LEFTJOIN ('work_process','employees.employee_id','=', 'work_process.employee_id')
            ->LEFTJOIN ('department', 'work_process.department_id','=','department.department_id')
            ->LEFTJOIN ('position', 'work_process.position_id','=','position.position_id')
            ->LEFTJOIN ('user', 'user.employee_id','=','employees.employee_id')
            ->WHERE ([
                ['work_process.status', 0],
                ['employees.status', 0]
            ])
            ->ORDERBY ('employees.employee_id','DESC')
            ->skip(($page - 1) * $limit)
            ->take($limit)
            ->get();

        // tổng nhân viên làm việc
        $getValue  = Employees::query() -> where('status',0);
        $active    = $getValue->count('employee_id');
        // tổng nhân viên nghỉ  việc
        $getValue1  = Employees::query() -> where('status',1);
        $inactive  = $getValue1->count('employee_id');
        // tổng nhân viên nam làm việc
        $getValue2  = Employees::query() -> where([['status',0], ['gender','male']]);
        $male      = $getValue2->count('employee_id');
        // tổng nhân viên nữ làm việc
        $getValue3  = Employees::query() -> where([['status',0], ['gender','female']]);
        $female    = $getValue3->count('employee_id');
        

        //  Tìm kiếm 

        $errors = new MessageBag();
        $search = $req->input('search');
        $value_search = Employees::query()
            ->select('employees.employee_id',
                'employees.employee_code',
                'employees.fullname',
                'employees.email',
                'employees.phone_number',
                'work_process.company_name',
                'work_process.company_address',
                'department.department_name',
                'position.position_name',
                'employees.img', 
                'user.is_active',
                'user.role')
            ->LEFTJOIN ('work_process','employees.employee_id','=', 'work_process.employee_id')
            ->LEFTJOIN ('department', 'work_process.department_id','=','department.department_id')
            ->LEFTJOIN ('position', 'work_process.position_id','=','position.position_id')
            ->LEFTJOIN ('user', 'user.employee_id','=','employees.employee_id')
            ->WHERE ([
                ['work_process.status', 0],
                ['employees.status', 0],
                ['employees.fullname', 'like',  '%' . $search . '%']])
            ->orwhere([
                ['work_process.status', 0],
                ['employees.status', 0],
                ['employees.employee_code','like',  '%' . $search . '%']])
            ->ORDERBY ('employees.employee_id','DESC')
            ->get();
            if (isset($_POST['search'])) {
                if ($search != '') {
                    if (count($value_search) > 0) {
                        // print($value_search); exit;
                        return view('employees/employees', [
                            'value_search'      => $value_search,
                            'numberOfRecords'   => $numberOfRecords,
                            'page'              => $page,
                            'numberOfPage'      => $numberOfPage,
                            'active'            => $active,
                            'inactive'          => $inactive,
                            'male'              => $male,
                            'female'            => $female,
                            'inforLogin'		=> $inforLogin,
                            'username'          => $req->session()->get('username'),
                            'errors'            => $errors,
                            
                        ]);
                    } else {
                        $errors->add("", "Không tìm thấy dữ liệu!");
                    }
                }
            }
        return view('employees/employees', [
            'value_search'      => $value_search,
            'errors'            => $errors,
            'employees'         => $employees,
            'numberOfRecords'   => $numberOfRecords,
            'page'              => $page,
            'numberOfPage'      => $numberOfPage,
            'active'            => $active,
            'inactive'          => $inactive,
            'male'              => $male,
            'female'            => $female,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function EmployeesDetail(Request $req, $idDetail){
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

        $employeesDetail = Employees::query()
            ->select('employees.employee_id',
                'employees.employee_code',
                'employees.fullname',
                'employees.img',
                'employees.dob',
                'employees.gender',
                'employees.email',
                'employees.phone_number',
                'employees.place_of_birth',
                'employees.home_town', 
                'employees.permanent_address', 
                'employees.current_address',
                'employees.academic_level',
                'employees.foreign_language',
                'employees.date_of_issue', 
                'employees.place_of_issue', 
                'employees.date_union', 
                'employees.place_union',
                'employees.date_party',
                'employees.place_party',
                // 'd1.data_name', 
                DB::RAW('d1.data_name AS tinhthanh'),
                // 'd2.data_name', 
                DB::RAW('d2.data_name AS dantoc'),
                // 'd3.data_name', 
                DB::RAW('d3.data_name AS quoctich'),
                'employees.identity_card_number',
                'employees.get_married', 
                'employees.img',
                'employees.status',
                'employees.religion')
            ->JOIN (DB::RAW('data_type AS d1'),'employees.province_id','=','d1.data_id')
            ->JOIN (DB::RAW('data_type AS d2'),'employees.nation_id','=','d2.data_id')
            ->JOIN (DB::RAW('data_type AS d3'), 'employees.nationality_id','=','d3.data_id')
            ->where('employees.employee_id', $idDetail)
            ->get();
        
        $family_relationship = FamilyRelationship::query()
            ->select('family_relationship.family_relationship_id',
                'data_type.data_name',
                'family_relationship.fullname',
                'family_relationship.dob',
                'family_relationship.job', 
                'family_relationship.place_of_birth', 
                'family_relationship.permanent_address', 
                'family_relationship.current_address', 
                'family_relationship.work_address', 
                'family_relationship.phone_number', 
                'family_relationship.work_phone_number', 
                'family_relationship.note', 
                'family_relationship.created_at', 
                'family_relationship.created_by', 
                'family_relationship.updated_at', 
                'family_relationship.updated_by')
            ->JOIN ('data_type','family_relationship.data_id','=','data_type.data_id')
            ->WHERE ('family_relationship.employee_id',$idDetail)
            ->get();

        $work_process = WorkProcess::query()
            ->select('work_process.work_process_id',
                'p.position_name',
                'd.department_name',
                'work_process.start_date', 
                'work_process.end_date',
                'work_process.company_name', 
                'work_process.company_address', 
                'work_process.note', 
                'work_process.status', 
                'work_process.created_at', 
                'work_process.updated_at', 
                'work_process.created_by', 
                'work_process.updated_by')
            ->JOIN (DB::RAW('department AS d'), 'd.department_id','=','work_process.department_id')
            ->JOIN (DB::RAW('position AS p'), 'p.position_id','=','work_process.position_id')
            ->WHERE ('work_process.employee_id',$idDetail)
            ->ORDERBY ('work_process.created_at','DESC')
            ->get();
        
        $salary_process = SalaryProcess::query()
            ->select('*')
            ->WHERE ('salary_process.employee_id',$idDetail)
            ->ORDERBY ('salary_process.created_at','DESC')
            ->get();

        $contract = Contract::query()
            ->select('contract.contract_id',
                'contract.contract_id',
                'contract.decision_number',
                'contract.employee_id',
                'contract.contract_type_id',
                'contract.effective_date',
                'contract.expiration_date',
                'contract.description',
                'contract.status',
                'ct.contract_type_code',
                'ct.contract_type_name')
            ->WHERE ('contract.employee_id',$idDetail)
            ->JOIN (DB::RAW('contract_type AS ct'), 'ct.contract_type_id','=','contract.contract_type_id')
            ->ORDERBY ('contract.created_at','DESC')
            ->get();

        $insurrance = Insurrance::query()
            ->select('insurrance.insurrance_id',
                'insurrance.social_insurance_number',
                'insurrance.date_of_issue_soc',
                'insurrance.place_of_issue_soc',
                'insurrance.health_insurance_number',
                'insurrance.date_of_issue_health',
                'insurrance.place_of_issue_health',
                'insurrance.status')
            ->WHERE ('insurrance.employee_id',$idDetail)
            ->ORDERBY ('insurrance.created_at', 'DESC')
            ->get();

        $KhenThuong = Praise_discipline::query()
            ->select('*')
            ->WHERE ([
                ['praise_discipline.employee_id',$idDetail],
                ['praise_discipline.type',0]
            ])
            ->ORDERBY ('praise_discipline.created_at', 'DESC')
            ->get();

        $KyLuat = Praise_discipline::query()
            ->select('*')
            ->WHERE ([
                ['praise_discipline.employee_id',$idDetail],
                ['praise_discipline.type',1]
            ])
            ->ORDERBY ('praise_discipline.created_at', 'DESC')
            ->get();


        return view('employees.employee_detail', [
            'employeesDetail'       => $employeesDetail,
            'family_relationship'   => $family_relationship,
            'work_process'          => $work_process,
            'salary_process'        => $salary_process,
            'contract'              => $contract,
            'insurrance'            => $insurrance,
            'khenthuong'            => $KhenThuong,
            'kyluat'                => $KyLuat,
            'inforLogin'		    => $inforLogin,
            'username'              => $req->session()->get('username')

        ]);
    }

    // http://localhost:8000/employee/add
    public function CreateEmployees(Request $req){

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
        $provinces = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','province')->get();
        $nationality = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','nationality')->get();
        $nation = DataType::query()
            ->select('data_id', 'data_name')->where('data_type','=','nation')->get();

        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'EmployeeCode'      => 'required|unique:employees,employee_code|min:5',
                'Fullname'          => 'required|'
            ]);
    
            if (!$validator->fails()) {
                $newEmployee = new Employees();
                $newEmployee->status = 0;
                $newEmployee->employee_code = $req->post('EmployeeCode');
                $newEmployee->fullname = $req->post('Fullname');                
                $newEmployee->gender = $req->post('Gender');
                $newEmployee->dob = $req->post('DOB');                          
                // $newEmployee->get_married = $req->post('GetMarried');
                if(!empty($req->post('GetMarried'))){
                    $newEmployee->get_married = 1;
                }else {
                    $newEmployee->get_married = 0;
                }
                $newEmployee->place_of_birth = $req->post('PlaceOfBirth');      
                $newEmployee->nationality_id = $req->post('Nationality');
                $newEmployee->home_town = $req->post('HomeTown');               
                $newEmployee->permanent_address = $req->post('PermanentAddress');
                $newEmployee->current_address = $req->post('CurrentAddress');   
                $newEmployee->phone_number = $req->post('PhoneNumber');
                $newEmployee->email = $req->post('Email');                      
                $newEmployee->nation_id = $req->post('Nation');
                $newEmployee->religion = $req->post('Religion');                
                $newEmployee->identity_card_number = $req->post('IdentityCardNumber');
                $newEmployee->place_of_issue = $req->post('PlaceOfIssue');      
                $newEmployee->academic_level = $req->post('AcademicLevel');
                $newEmployee->date_union = $req->post('DateUnion');             
                $newEmployee->place_union = $req->post('PlaceUnion');
                $newEmployee->date_party = $req->post('DateParty');             
                $newEmployee->place_party = $req->post('PlaceParty');
                $newEmployee->img = $req->post('Img');    
                $newEmployee->province_id = 62;     // fix cứng giá trị trường mã tỉnh thành không dùng đến
                $newEmployee->created_at = Carbon::now(); 
                $newEmployee->save();
                // var_dump($newEmployee);exit;
                // Sau khi thêm mới thông tin nhân viên -> chuyển đến form thêm mới quan hệ gia đình
                return redirect('/employee/add_family_relationship');
            }
            $errors = $validator->errors();
        }

        return view('employees/employee_add',[
            'errors'            => $errors,
            'provinces'         => $provinces,
            'nationality'       => $nationality,
            'nation'            => $nation,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function EditEmployees(){


        return view('employees/employee_edit');
    }

    public function DeleteEmployees($id) {
        Employees::destroy($id);
        return redirect('/Employees');
    }

}