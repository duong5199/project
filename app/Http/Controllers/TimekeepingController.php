<?php

namespace App\Http\Controllers;
use App\User;
use App\Employees;
use App\Timekeeping;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Carbon\Carbon;

class TimekeepingController extends Controller
{
    public function index(Request $req){

        $username = $req->session()->get('username');
        $role = $req->session()->get('role');
		// var_dump($role); exit;
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
        // Thông tin cơ bản
        $employees = Employees::query()
            ->select(
                'employee_code', 
                'fullname', 
                'img',
                'gender', 
                'dob', 
                'phone_number', 
                'email', 
                'province_id',
                'place_of_birth',
                DB::RAW('d1.data_name AS tinhthanh'),
                DB::RAW('p.position_name AS chucvu')
                )
            ->JOIN ('user', 'user.employee_id','=','employees.employee_id')
            ->JOIN (DB::RAW('data_type AS d1'),'employees.province_id','=','d1.data_id')
            ->JOIN (DB::RAW('work_process AS wp'), 'wp.employee_id','=','employees.employee_id')
            ->LEFTJOIN (DB::RAW('position AS p'), 'p.position_id','=','wp.position_id')
            ->WHERE ([
                ['username', $username],
                ['wp.status', 0],
                ['employees.status', 0]
            ])
            ->get();

        // Chi tiết chấm công tháng hiện tại
        // Tổng ngày đi làm
        // $date = Carbon::now()->format('m-Y');
        $present = Timekeeping::query()
            ->select('date')
            ->where([
                [DB::RAW("DATE_FORMAT( date, '%m/%Y' )"), '=', DB::RAW("DATE_FORMAT( NOW( ), '%m/%Y' )")],
                ['status', '=', 0]])
            ->get();
        $total_present = $present->count();

        // Tổng ngày nghỉ có lương 
        $paid_leave = Timekeeping::query()
            ->select('date')
            ->where([
                [DB::RAW("DATE_FORMAT( date, '%m/%Y' )"), '=', DB::RAW("DATE_FORMAT( NOW( ), '%m/%Y' )")],
                ['status', '=', 1]])
            ->get();
        $total_paid_leave = $paid_leave->count(); 

        // Tổng ngày nghỉ phép không lương
        $unpaid_leave = Timekeeping::query()
            ->select('date')
            ->where([
                [DB::RAW("DATE_FORMAT( date, '%m/%Y' )"), '=', DB::RAW("DATE_FORMAT( NOW( ), '%m/%Y' )")],
                ['status', '=', 2]])
            ->get();
        $total_unpaid_leave = $unpaid_leave->count();

        // Tổng ngày nghỉ không phép
        $absent = Timekeeping::query() ->select('date')
            ->where([
                [DB::RAW("DATE_FORMAT( date, '%m/%Y' )"), '=', DB::RAW("DATE_FORMAT( NOW( ), '%m/%Y' )")],
                ['status', '=', 3]])
            ->get(); 
        $total_absent = $absent->count();

        // Chi tiết chấm công tháng trước
        $timekeeping_details = Timekeeping::query() ->get();

        //  lấy thời gian login logout
        $timeCheckin = Timekeeping::query() ->select('time_checkin', 'time_checkout') 
            ->JOIN ('user', 'user.user_id','=','timekeeping_detail.user_id')
            ->WHERE ('user.username', $username)
            ->ORDERBY ('timekeeping_detail.created_at', 'DESC')
            ->LIMIT(1)
            ->get();

        //  lấy id user login
        $user_id      = User::query()
            ->select('user.user_id')  
            ->WHERE ('user.username', $username)
            ->get();


            // print($user_id); exit;
            // CLOCK IN
            if (isset($_POST['clockin'])) {
                // if (!empty($req->post('clockin'))) {
                $timein = new Timekeeping();
                $timein->user_id = $req->post('ID'); 
                $timein->date = Carbon::now()->format('Y-m-d'); 
                $timein->time_checkin = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                $timein->time_checkout = '00:00:00';
                $timein->status = 0;
                $timein->created_at = Carbon::now('Asia/Ho_Chi_Minh'); 
                $timein->save();
                // redirect('http://localhost:8000/Timekeeping');                
                // trở về MH chấm công
                return redirect('/Timekeeping')->with('message', 'Xác nhận CLOCK IN thành công!');               
                exit();
            }
        
        // CLOCK OUT
        // lấy id bản ghi check in mới nhất
        $record_id    = Timekeeping::query()
            ->select('timekeeping_detail.timekeeping_id')
            ->JOIN ('user', 'user.user_id','=','timekeeping_detail.user_id')
            ->WHERE ('user.username', $username)
            ->ORDERBY ('timekeeping_detail.created_at', 'DESC')
            ->take(1)
            ->get();
        
            // if (!empty($req->post('clockout'))) {
            if (isset($_POST['clockout'])) {
                $timeout = Timekeeping::find($req->post('idOut'));
                $timeout->time_checkout = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
                $timeout->save();
                // echo 1; exit;
                // thêm mới quá trình lương xong trở về MH chấm công
                return redirect('/Timekeeping')->with('message', 'Xác nhận CLOCK OUT thành công!');
            }

        // var_dump($timeCheckin); exit;
        return view('timekeeping/timekeeping', [
            'employees'             => $employees,
            'total_present'         => $total_present,
            'total_paid_leave'      => $total_paid_leave,
            'total_unpaid_leave'    => $total_unpaid_leave,
            'total_absent'          => $total_absent,
            'timeCheckin'           => $timeCheckin,
            'user_id'               => $user_id, // id nhân viên login
            'record_id'             => $record_id,  // id bản ghi mới nhất của nhân viên login
            'inforLogin'		    => $inforLogin,
            'username'              => $req->session()->get('username')
        ]);
    }

    public function TimekeepingDetail(Request $req){
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
        $detail = Timekeeping::query()
            ->select('*')
            ->JOIN ('user', 'user.user_id','=','timekeeping_detail.user_id')
            ->where([
                [DB::RAW("DATE_FORMAT( date, '%m/%Y' )"), '=', DB::RAW("DATE_FORMAT( NOW( ), '%m/%Y' )")],
                ['user.username', $username]])
            ->get();
            // $date = Carbon::now()->format('h:i:s A'); printf($date);exit;
            // printf(Carbon::now('Asia/Ho_Chi_Minh'));exit;
        // ADD lý do 

        return view('timekeeping/timekeeping_detail',[
            'detail'                => $detail,
            'inforLogin'		    => $inforLogin,
            'username'              => $req->session()->get('username')
        ]);
    }

}
