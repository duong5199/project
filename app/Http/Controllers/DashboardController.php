<?php

namespace App\Http\Controllers;

use App\Department;
use App\Employee;
use App\Position;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $title_page = 'Trang Quản Trị';

    public function index()
    {
        $total_employee = Employee::all()->count();
        $total_department = Department::all()->count();
        $total_user = User::all()->count();
        $total_position = Position::all()->count();

        return view('dashboard/index', compact('total_employee', 'total_department', 'total_user', 'total_position'));
    }
}
