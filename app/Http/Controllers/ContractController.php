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
use App\ContractType;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;
class ContractController extends Controller
{
    // Quản lý hợp đồng
    public function AddContract(Request $req, $idAddContract){

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
        $ContractType = ContractType::query()
            ->select('contract_type_id', 'contract_type_code', 'contract_type_name')
            ->where('status',0)
            ->get();

        $employeeInfor = Employees::query()
            ->select('employee_id', 'employee_code', 'fullname')
            ->where('employee_id', $idAddContract)
            ->get();
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'DecisionNumber'        => 'required|unique:contract,decision_number|min:5,decision_number|max:50',
                    'TypeContract'          => 'required|',
                    'EffectiveDate'          => 'required|',
                    'ExpirationDate'          => 'required|'
                ]);
    
                if (!$validator->fails()) {
                    $newC = new Contract();
                    $newC->employee_id = $idAddContract;
                    $newC->decision_number = $req->post('DecisionNumber');
                    $newC->contract_type_id = $req->post('TypeContract');
                    $newC->effective_date = $req->post('EffectiveDate');
                    $newC->expiration_date = $req->post('ExpirationDate');
                    $newC->description = $req->post('Description');
                    $newC->status = 0;
                    $newC->created_at = Carbon::now(); 
                    $newC->save();
                    // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
                    return \Redirect::route('detailEmployee', $idAddContract)->with('message', 'Thêm mới thành công!');
                }
    
                $errors = $validator->errors();
            }
        return view('contract/add_contract',[
            'errors'            => $errors,
            'employeeInfor'     => $employeeInfor,
            'ContractType'      => $ContractType,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
    
    public function EditContract(Request $req, $idEditContract){
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
        $ContractType = ContractType::query()
            ->select('contract_type_id', 'contract_type_code', 'contract_type_name')
            ->where('status',0)
            ->get();
        $ContractInfor = Contract::query()
            ->select('e.employee_id', 'e.employee_code', 'e.fullname', 
                'contract.contract_id',
                'contract.decision_number', 
                'contract.contract_type_id', 
                'contract.effective_date',
                'contract.expiration_date', 
                'contract.description',
                'contract.status')
            ->JOIN (DB::RAW('employees AS e'), 'e.employee_id','=','contract.employee_id')
            ->JOIN (DB::RAW('contract_type AS ct'), 'ct.contract_type_id','=','contract.contract_type_id')
            ->WHERE ('contract.contract_id',$idEditContract)
            ->get();
        $idDetail = Contract::query()
            ->select('employee_id')
            ->WHERE ('contract.contract_id',$idEditContract)
            ->get();
            // print($idDetail); exit;
            if (!empty($req->post())) {
                $validator = Validator::make($req->post(), [
                    'DecisionNumber'        => 'required|',
                    'TypeContract'          => 'required|',
                    'EffectiveDate'          => 'required|',
                    'ExpirationDate'          => 'required|'
                ]);
    
                if (!$validator->fails()) {
                    $editContract = Contract::find($idEditContract);
                    $editContract->decision_number = $req->post('DecisionNumber');
                    $editContract->contract_type_id = $req->post('TypeContract');
                    $editContract->effective_date = $req->post('EffectiveDate');
                    $editContract->expiration_date = $req->post('ExpirationDate');
                    $editContract->description = $req->post('Description');
                    $editContract->status = $req->post('Status');
                    $editContract->save();
                    // cập nhật quá trình lương xong trở về MH chi tiết nhân viên
                    // return \Redirect::route('detailEmployee', $idDetail)->with('message', 'Cập nhật thành công!');
                }
    
                $errors = $validator->errors();
            }

        return view('contract/contract_edit',[
            'errors'            => $errors,
            'ContractType'      => $ContractType,
            'ContractInfor'     => $ContractInfor,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }


    // Quản lý loại hợp đồng
    public function ListContractType(Request $req){
        $errors = new MessageBag();
        $errorsSearch = new MessageBag();
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
        $count_contract_type        = ContractType::query()
            // ->WHERE ('status', 0)
            ->get();
        $numberOfRecords = $count_contract_type->count();
        $numberOfPage    = $numberOfRecords > 0 ? ceil($numberOfRecords / $limit) : 1;

        // View
        $contractType  = ContractType::query() ->ORDERBY ('created_at', 'DESC') ->get(); 

        // Add AddConType
        // if (!empty($req->post())) {
        if (isset($_POST['AddConType'])) {
            $validator = Validator::make($req->post(), [
                'conTypeCode'        => 'required|',
                'conTypeName'        => 'required|',
                ],
                [
                    'conTypeCode.required' => 'Mã loại hợp đồng không được để trống!',
                    'conTypeName.required' => 'Tên loại hợp đồng không được để trống!'
                ]);

            if (!$validator->fails()) {
                $newDe = new ContractType();
                $newDe->contract_type_code = $req->post('conTypeCode');
                $newDe->contract_type_name = $req->post('conTypeName');
                $newDe->status = 0;
                $newDe->created_at = Carbon::now(); 
                $newDe->save();
                // thêm mới loại hợp đồng xong trở về MH danh sách loại hợp đồng
                return redirect('/contractType')->with('message', 'Thêm mới thành công!');
            }
            $errors = $validator->errors();
        }

        // Search
        $search = $req->input('search');
        $valueSearch = ContractType::query() 
            ->where('contract_type_code','like',  '%' . $search . '%')
            ->orwhere('contract_type_name','like',  '%' . $search . '%')
            // ->ORDERBY ('created_at', 'DESC')
            ->get();
        $numberOfRecordsSearch = $valueSearch->count();
            // if (!empty($search)) {
            if (isset($_POST['search'])) {
                if ($search != '') {
                    if (count($valueSearch) > 0) {
                        // print_r($valueSearch); exit;
                        return view('contract/contract_type', [
                            'valueSearch'       => $valueSearch,
                            'numberOfRecordsSearch' => $numberOfRecordsSearch,
                            'errors'            => $errors,
                            'errorsSearch'      => $errorsSearch,
                            'numberOfRecords'   => $numberOfRecords,
                            'page'              => $page,
                            'numberOfPage'      => $numberOfPage,
                            'inforLogin'		=> $inforLogin,
                            'username'          => $req->session()->get('username')
                        ]);
        //                        return redirect('/search');
                    } else {
                        $errorsSearch->add("", "Không tìm thấy dữ liệu!");
                    }
                } 
                // else {
                //     $errorsSearch->add("", "Bạn phải nhập từ khóa tìm kiếm!");
                // }
            }

        return view('contract/contract_type',[
            'errors'            => $errors,
            'errorsSearch'      => $errorsSearch,
            'numberOfRecords'   => $numberOfRecords,
            'page'              => $page,
            'valueSearch'       => $valueSearch,
            'contractType'      => $contractType,
            'numberOfPage'      => $numberOfPage,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function EditContractType(Request $req, $idConType){
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
        $conType_detail  = ContractType::query() ->WHERE ('contract_type_id', $idConType) ->ORDERBY ('created_at', 'DESC') ->get(); 
        
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'conTypeCode'        => 'required|',
                'conTypeName'          => 'required|',
            ]);

            if (!$validator->fails()) {
                $editConType = ContractType::find($idConType);
                $editConType->contract_type_code = $req->post('conTypeCode');
                $editConType->contract_type_name = $req->post('conTypeName');
                $editConType->status = $req->post('Status');
                $editConType->save();
                // cập nhật quá trình lương xong trở về MH danh sách
                return redirect('/contractType')->with('message', 'Cập nhật thành công!');
            }

            $errors = $validator->errors();
        }
        return view('contract/edit_contract_type',[
            'errors'            => $errors,
            'conType_detail'    => $conType_detail,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
}


