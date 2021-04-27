<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class PayrollController extends BaseController
{
//http://localhost:8000/payroll
    public function Payrolls()
    {
        
        return view("payroll/list");
    }

    public function PayrollDetail(Request $req, $idPayroll)
    {
        
        return view("payroll/payrollDetail");
    }
}
