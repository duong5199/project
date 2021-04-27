<?php

use Illuminate\Support\Facades\Route;


// LOGIN 
// Route::get('/', function () {
//     return view('welcome');
// })->middleware('auth_mw');
Route::get(
    '/',
    'LayoutController@index')->middleware('auth_mw');

Route::match(['GET','POST'],
    '/login',
    'LoginController@Login')
    ->middleware('non_auth_mw');

Route::get('/logout','LoginController@Logout');
// =======================================================================================================

// CHỨC NĂNG CHUNG
    //  form chấm công 
    Route::match(['GET','POST'],
        '/Timekeeping',
        'TimekeepingController@index')->middleware('auth_mw');

    //  form chi tiết chấm công 
    Route::match(['GET','POST'],
        '/Timekeeping_Detail',
        'TimekeepingController@TimekeepingDetail')->middleware('auth_mw');

    //  form quản lý danh sách bảng lương 
    Route::match(['GET','POST'],
        '/payroll',
        'PayrollController@Payrolls')->middleware('auth_mw');

    //  form quản lý chi tiết bảng lương 
    Route::match(['GET','POST'],
        '/payroll/detail/{idPayroll?}',
        'PayrollController@PayrollDetail')->middleware('auth_mw');

    // Form danh sách nhân viên
    Route::match(['GET','POST'],
        '/Employees',
        'EmployeesController@Employees')->middleware('auth_mw');
    // Form xem chi tiết nhân viên
    Route::match(['GET','POST'],
        '/employee/detail/{idDetail?}',
        ['as' => 'detailEmployee', 'uses' => 'EmployeesController@EmployeesDetail'])->middleware('auth_mw');
        
// =======================================================================================================

//  CHỨC NĂNG CỦA SUPER_ADMIN
Route::middleware(['auth_mw','admin'])->group(function () {
    // Form thêm nhân viên 
    Route::match(['GET','POST'],
        '/employee/add',
        'EmployeesController@CreateEmployees');

    // Form thêm quan hệ gia đình cho nhân viên đang thêm mới
    Route::match(['GET','POST'],
        '/employee/add_family_relationship',
        'FamilyRelationshipController@AddFamilyRelationship');
    // Form thêm quan hệ gia đình cho nhân viên được chọn
    Route::match(['GET','POST'],
        '/employee/addNewRecordsFR/{idAddFR?}',
        'FamilyRelationshipController@AddFR');

    // Form thêm quá trình công tác cho nhân viên đang thêm mới
    Route::match(['GET','POST'],
        '/employee/add_working_process',
        'WorkingProcessController@AddWorkingProcess');
    // Form thêm quá trình công tác cho nhân viên được chọn
    Route::match(['GET','POST'],
        '/employee/addNewRecords/{idAddWP?}',
        'WorkingProcessController@AddWP');

    // Form thêm quá trình lương
    Route::match(['GET','POST'],
        '/employee/add_salary_process/{idAddSP?}',
        'SalaryProcessController@AddSalaryProcess');

    // Form thêm hợp đồng
    Route::match(['GET','POST'],
        '/employee/add_contract/{idAddContract?}',
        'ContractController@AddContract');

    // Form thêm bảo hiểm
    Route::match(['GET','POST'],
        '/employee/add_insurrance/{idAddIn?}',
        'InsurranceController@AddInsurrance');
    
    // Form thêm khen thưởng
    Route::match(['GET','POST'],
        '/employee/add_praise/{idAddP?}',
        'PraiseDisciplineController@AddPraise');
    // Form thêm kỷ luật
    Route::match(['GET','POST'],
        '/employee/add_discipline/{idAddD?}',
        'PraiseDisciplineController@AddDiscipline');
// =======================================================================================================

    // Form sửa nhân viên 
    // Route::match(['GET','POST'],
    //     '/employee/edit/{id?}',
    //     'EmployeesController@EditEmployees');
    // Xóa nhân viên
    Route::get(
        '/employee/delete/{id?}',
        'EmployeesController@DeleteEmployees');

    // Form sửa quan hệ gia đình
    Route::match(['GET','POST'],
        '/employee/editFR/{idEditFR?}',
        'FamilyRelationshipController@EditFR');

    // Form sửa quá trình công tác
    Route::match(['GET','POST'],
        '/employee/editWP/{idWP?}',
        'WorkingProcessController@EditWP');

    // Form sửa quá trình lương
    Route::match(['GET','POST'],
        '/employee/editSP/{idEditSP?}',
        'SalaryProcessController@EditSP');
    
    // Form sửa hợp đồng
    Route::match(['GET','POST'],
        '/employee/editContract/{idEditContract?}',
        'ContractController@EditContract');

    // Form sửa bảo hiểm
    Route::match(['GET','POST'],
        '/employee/editInsurrance/{idEditIn?}',
        'InsurranceController@EditInsurrance');
    
    // Form sửa khen thưởng
    Route::match(['GET','POST'],
        '/employee/editPraise/{idEditP?}',
        'PraiseDisciplineController@EditPraise');
    // Form sửa kỷ luật
    Route::match(['GET','POST'],
        '/employee/editDiscipline/{idEditD?}',
        'PraiseDisciplineController@EditDiscipline');
// =======================================================================================================

    // Form danh sách tài khoản người dùng
    Route::get(
        '/User',
        'UserController@ListUser');
    // Form thêm mới tài khoản người dùng
    Route::match(['GET','POST'],
        '/User/add_new_acount/{id?}',
        'UserController@AddUser');
    // Form cập nhật tài khoản người dùng
    Route::match(['GET','POST'],
        '/User/edit/{id?}',
        'UserController@EditUser');
    // Khóa tài khoản
    // Route::get(
    //     '/User/close_acount/{id?}',
    //     'UserController@OpenCloseAcount');

    // =======================================================================================================

    // Form danh sách + thêm mới phòng ban
    Route::match(['GET','POST'],
        '/departments',
        'DepartmentController@ListDepartment');
    // Form cập nhật phòng ban
    Route::match(['GET','POST'],
        '/departments/edit/{idDepartment?}',
        'DepartmentController@EditDepartment');
    // =======================================================================================================

    // Form danh sách + thêm mới chức vụ
    Route::match(['GET','POST'],
        '/positions',
        'PositionsController@ListPosition');
    // Form cập nhật chức vụ
    Route::match(['GET','POST'],
        '/positions/edit/{idPositions?}',
        'PositionsController@EditPosition');
    // =======================================================================================================

    // Form danh sách hợp đồng
    Route::match(['GET','POST'],
        '/contractType',
        'ContractController@ListContractType');
    // Form cập nhật chức vụ
    Route::match(['GET','POST'],
        '/contractType/edit/{idConType?}',
        'ContractController@EditContractType');
});