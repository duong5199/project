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
class PositionsController extends Controller
{
    public function ListPosition(Request $req){
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
        $count_position        = Position::query()
            ->WHERE ('status', 0)
            ->get();
        $numberOfRecords = $count_position->count();
        $numberOfPage    = $numberOfRecords > 0 ? ceil($numberOfRecords / $limit) : 1;
        // View
        $positions  = Position::query() ->ORDERBY ('created_at', 'DESC') ->get(); 
       
        // Add
        if (!empty($req->post())) {
            $newDe = new Position();
            $newDe->position_code = $req->post('positionCode');
            $newDe->position_name = $req->post('positionName');
            $newDe->status = 0;
            $newDe->created_at = Carbon::now(); 
            $newDe->save();
            // thêm mới quá trình lương xong trở về MH chi tiết nhân viên
            return redirect('/positions')->with('message', 'Thêm mới thành công!');
    }

        return view('positions/positions',[
            'numberOfRecords'   => $numberOfRecords,
            'page'              => $page,
            'positions'         => $positions,
            'numberOfPage'      => $numberOfPage,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }

    public function EditPosition(Request $req, $idPositions){
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
        $positions_detail  = Position::query() ->WHERE ('position_id', $idPositions) ->ORDERBY ('created_at', 'DESC') ->get(); 
        
        if (!empty($req->post())) {
            $validator = Validator::make($req->post(), [
                'positionCode'        => 'required|',
                'positionName'          => 'required|',
            ]);

            if (!$validator->fails()) {
                $editPo = Position::find($idPositions);
                $editPo->position_code = $req->post('positionCode');
                $editPo->position_name = $req->post('positionName');
                $editPo->status = $req->post('Status');
                $editPo->save();
                // cập nhật quá trình lương xong trở về MH danh sách
                return redirect('/positions')->with('message', 'Cập nhật thành công!');
            }

            $errors = $validator->errors();
        }
        return view('positions/edit_position',[
            'errors'            => $errors,
            'positions_detail'  => $positions_detail,
            'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
    }
}
