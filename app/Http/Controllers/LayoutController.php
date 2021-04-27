<?php

namespace App\Http\Controllers;
use App\Employees;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LayoutController extends Controller
{
	public function index(Request $req){
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
		// var_dump($inforLogin); exit;
		return view('layouts/default', [
			'inforLogin'		=> $inforLogin,
            'username'          => $req->session()->get('username')
        ]);
	}
}
