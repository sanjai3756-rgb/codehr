<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use App\Models\Employee;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::with('employee')->latest()->get();
        return view('payrolls.index', compact('payrolls'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('payrolls.create', compact('employees'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['net_salary'] =
            $request->basic_salary +
            $request->allowance +
            $request->bonus -
            $request->deduction;

        Payroll::create($data);

        return redirect()->route('payrolls.index')
            ->with('success','Payroll Added');
    }
}